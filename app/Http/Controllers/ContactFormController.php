<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function create()
    {
        return view('contacts/create');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required | min:3',
            'email' => 'required | email',
            'message' => 'required',
        ]);
        //dd(request()->all());

        //then Send an Email:
        Mail::to('test@test.com')->send(new ContactFormMail($data)); 

        //instead of WITH below we can use flash
        //session()->flash('message', 'Thank you for your message !'); // this one even better for me
        //redirect
        return redirect('/contacts')->with('message', 'Thank You for your message! We\'ll be in touch');
    }
}
