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
        
        try {
            Mail::to('cynthiaedithgarske@gmail.com')->send($mail);
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
