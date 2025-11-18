<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Mail\ContactQuestion;
use Illuminate\Support\Facades\Mail;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index() : View {
        // Order by closest future date from departureDates relationship
        $today = now()->format('Y-m-d');
        $products = Product::where('product_activate', 1)
            ->with(['departureDates' => function($query) use ($today) {
                $query->where('date', '>=', $today)
                      ->orderBy('date', 'asc');
            }])
            ->get()
            ->sortBy(function($product) use ($today) {
                $nextDate = $product->departureDates->first();
                // Products with future dates first, ordered by closest date
                if ($nextDate) {
                    return $nextDate->date;
                }
                // Products without future dates go to the end, ordered by created_at desc
                return '9999-99-99';
            })
            ->take(12)
            ->values();
            
        return view('index', [
            'products' => $products
        ]);
    }
    public function mail(Request $request){
        $data = $request->all();
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $message = $data['mensaje'];
        $mail = new ContactQuestion($name, $email, $phone, $message);
        
        try {
            Mail::to('cynthiagarsketurismo@gmail.com')->send($mail);
            return response()->json(['success' => 'Consulta enviada con éxito']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al enviar la consulta ' . $e->getMessage()]);
        }

    }
    public function changePassword(){
        $admin = Admin::find(1);
        $admin->password = Hash::make('123456');

        $admin->save();
    }
}
