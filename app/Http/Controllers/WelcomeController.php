<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $clients = Client::where('is_visible', true)->get();

        return view('welcome', ['clients' => $clients]);
    }

    public function show($id)
    {
        $client = Client::find($id);

        return view('help', ['client' => $client]);
    }
}
