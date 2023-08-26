<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactAdminMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;


class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }
    
    function sendMail(ContactRequest $request)
    {
        $validated= $request->validated();
        // // メール送信処理
        // メール送信完了後、完了画面へリダイレクト
        Mail::to('blue.passion625@gmail.com')->send(new ContactAdminMail($validated));
        return redirect()->route('contact.complete');
    }

    public function complete()
    {
        return view('contact.complete');
    }
}
