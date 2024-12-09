<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail;
class PurchaseController extends Controller
{
    public function purchaseMail(Request $request){
        $data = $request->all();
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $message = $data['mensaje'];
        $mail = new ContactQuestion($name, $email, $phone, $message);
        
        try {
            Mail::to('
            ')->send($mail);
            return response()->json(['success' => 'Consulta enviada con éxito']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al enviar la consulta ' . $e->getMessage()]);
        }

    }
}
