<?php

namespace App\Http\Controllers;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    function index()
    {
     return view('mail');
    }
   public function send(Request $request)
   {
     $this->validate($request, [
         'name'     =>  'required',
         'email'  =>  'required|email',
         'message' =>  'required'
        ]);
        
      $data = array(
           'name'      =>  $request->input('name'),
           'message'   =>   $request->input('message')
       );

       $email = $request->input('email');

     Mail::to($email)->send(new SendMail($data));

     return back()->with('success', 'Enviado exitosamente!');

   }
}

?>