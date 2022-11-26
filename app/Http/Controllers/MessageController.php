<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSubmitted;
use App\Models\Message;
use App\Rules\NoHtml;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function create()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', new NoHtml],
            'email' => ['required', 'email', new NoHtml],
            'message' => ['required', 'string', new NoHtml],
            'g-recaptcha-response' => ['required', new Recaptcha],
        ]);

        $message = Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        Mail::to('chris@nurserypeople.com')
            ->send(new ContactFormSubmitted($message));

        // redirect to contact form with message
        return redirect()->back()->with('flash', 'Message is sent! We will get back to you soon!');
    }
}
