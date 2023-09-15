<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Mail\ContactQuestion;
use Illuminate\Support\Facades\Mail;
class IndexController extends Controller
{
    public function index() : View {
        $products = Product::latest()->take(12)->get();
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
        $mail->subject('Recibiste una consulta de ' . $name);
        $mail->to('cynthiaedithgarske@gmail.com');
        $mail->from($email, $name);
        $mail->replyTo($email, $name);
        if (Mail::send($mail)) {
            return response()->json(['success' => 'Consulta enviada con éxito']);
        }else{
            return response()->json(['error' => 'Error al enviar la consulta']);
        }
    }
}
