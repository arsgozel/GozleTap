<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create()
    {
        return view('client.contact.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'message' => 'required|string|max:255',
        ]);

        Contact::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email ?: null,
            'message' => $request->message,
        ]);

        return redirect()->back()
            ->with([
                'success' => 'Message sent!'
            ]);
    }
}
