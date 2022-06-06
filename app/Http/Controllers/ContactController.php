<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function validation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:600'],
            ]);

        if($validator->fails()) {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->errors()
            ]);
        } else {
            return response()->json([
                'status'=>200,
                'message'=> 'Contacto validado',
            ]);
        }
    }

    public function send(Request $request)
    {
        Mail::to(env('MAIL_FROM_ADDRESS', 'ejemplo@correo.com'))->send(new ContactMail());

        return view('main.contact-success')->with([
            'link' => '/inboxes',
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
    }

    public function success()
    {
        return view('main.contact-success');
    }
}
