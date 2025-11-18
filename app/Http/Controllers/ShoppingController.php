<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Facturacion;
use App\Models\Shopping;
use App\Jobs\SendPurchaseEmail;

class ShoppingController extends Controller
{
    private $response_messages = [
        'pending' => 'Tu pago está pendiente',
        'approved' => 'Tu pago fue procesado exitosamente',
        'failure' => 'Tu pago no pudo ser procesado',
    ];

    private $titles = [
        'pending' => '¡Tu pago está pendiente!',
        'approved' => '¡Gracias por tu compra!',
        'failure' => '¡Hubo un problema con tu pago!',
    ];

    public function index($id) : View
    {
        $products = new Product;
        $product = $products->with('departureDates')->find($id);
        
        return view('checkout', [
            'product' => $product
        ]);
    }
    
    private function responseArray($status, $shopping)
    {
        return [
            'title' => $this->titles[$status],
            'message' => $this->response_messages[$status],
            'status' => $status,
            'code' => $shopping->code
        ];
    }

    public function success($purchase, Request $request): View
    {
        $shopping = Shopping::where("code", $purchase)->first();
        if (!$shopping) {
            abort(404, 'Compra no encontrada');
        }

        if ($shopping->purchases()->where("payment_status", 'approved')->exists()) {
            return view('payment', $this->responseArray('approved', $shopping));
        }

        $paymentData = $request->all();

        $purchaseC = new Purchase();
        $purchaseC->purchase_code = $shopping->id;
        $purchaseC->user_id = $shopping->user_id;
        $purchaseC->payment_status = 'approved';
        $purchaseC->payment_method = $shopping->payment_method;
        $purchaseC->total_price = $shopping->total_price;

        // Guardar datos adicionales de MercadoPago
        $purchaseC->payment_id = $paymentData['payment_id'] ?? null;
        $purchaseC->preference_id = $paymentData['preference_id'] ?? null; // ✅ Guardar ID de preferencia
        $purchaseC->status = $paymentData['status'] ?? 'approved';
        $purchaseC->payer_email = $paymentData['payer']['email'] ?? null;
        $purchaseC->transaction_amount = $paymentData['transaction_amount'] ?? null;
        $purchaseC->installments = $paymentData['installments'] ?? null;
        $purchaseC->save();

        $shopping->update(['payment_status' => 'approved']);

        $mailing_info = Facturacion::where("purchase_id", $shopping->id)->first();
        $product = Product::find($shopping->product_id);

        if ($mailing_info && $product) {
            SendPurchaseEmail::dispatch(
                $mailing_info->nombre,
                $shopping->code,
                $shopping->created_at->format('d-m-Y'),
                $shopping->total_price,
                'success',
                $mailing_info->email,
                [
                    'billingName' => $mailing_info->nombre,
                    'billingAddress' => $mailing_info->direccion,
                    'billingCity' => $mailing_info->ciudad,
                    'billingCountry' => $mailing_info->pais,
                    'productName' => $product->name,
                    'productQuantity' => $shopping->quantity,
                    'productPrice' => $product->price,
                    'passengers' => $shopping->passengers
                ]
            )->onQueue('emails');
        }

        return view('payment', $this->responseArray('approved', $shopping));
    }

    public function failure($purchase, Request $request): View
    {
        $shopping = Shopping::where("code", $purchase)->first();
        if (!$shopping) {
            abort(404, 'Compra no encontrada');
        }

        $paymentData = $request->all();

        $shopping->update(['payment_status' => 'failure']);

        $purchaseC = new Purchase();
        $purchaseC->purchase_code = $shopping->id;
        $purchaseC->user_id = $shopping->user_id;
        $purchaseC->payment_status = 'failure';
        $purchaseC->payment_id = $paymentData['payment_id'] ?? null;
        $purchaseC->preference_id = $paymentData['preference_id'] ?? null; // ✅ Guardar ID de preferencia
        $purchaseC->status = $paymentData['status'] ?? 'failure';
        $purchaseC->payer_email = $paymentData['payer']['email'] ?? null;
        $purchaseC->save();

        $mailing_info = Facturacion::where("purchase_id", $shopping->id)->first();

        if ($mailing_info) {
            SendPurchaseEmail::dispatch(
                $mailing_info->nombre,
                $shopping->code,
                $shopping->created_at->format('d-m-Y'),
                $shopping->total_price,
                'failed',
                $mailing_info->email
            )->onQueue('emails');
        }

        return view('payment', $this->responseArray('failure', $shopping));
    }

    public function pending($purchase, Request $request): View
    {
        $shopping = Shopping::where("code", $purchase)->first();
        if (!$shopping) {
            abort(404, 'Compra no encontrada');
        }

        $paymentData = $request->all();

        $shopping->update(['payment_status' => 'pending']);

        $purchaseC = new Purchase();
        $purchaseC->purchase_code = $shopping->id;
        $purchaseC->user_id = $shopping->user_id;
        $purchaseC->payment_status = 'pending';
        $purchaseC->payment_id = $paymentData['payment_id'] ?? null;
        $purchaseC->preference_id = $paymentData['preference_id'] ?? null; // ✅ Guardar ID de preferencia
        $purchaseC->status = $paymentData['status'] ?? 'pending';
        $purchaseC->payer_email = $paymentData['payer']['email'] ?? null;
        $purchaseC->save();

        $mailing_info = Facturacion::where("purchase_id", $shopping->id)->first();
        $product = Product::find($shopping->product_id);

        if ($mailing_info && $product) {
            SendPurchaseEmail::dispatch(
                $mailing_info->nombre,
                $shopping->code,
                $shopping->created_at->format('d-m-Y'),
                $shopping->total_price,
                'pending',
                $mailing_info->email,
                [
                    'billingName' => $mailing_info->nombre,
                    'billingAddress' => $mailing_info->direccion,
                    'billingCity' => $mailing_info->ciudad,
                    'billingCountry' => $mailing_info->pais,
                    'productName' => $product->name,
                    'productQuantity' => $shopping->quantity,
                    'productPrice' => $product->price,
                    'passengers' => $shopping->passengers
                ]
            )->onQueue('emails');
        }

        return view('payment', $this->responseArray('pending', $shopping));
    }
}
