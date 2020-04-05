<?php

namespace App\Http\Controllers;

use App\Bank;
use App\City;
use App\Client;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function list()
    {
        $clients = Client::all()->sortByDesc('is_visible');

        return view('list', ['clients' => $clients]);
    }

    public function create()
    {
        $banks = Bank::all()->sortBy('name');
        $cities = City::all()->sortBy('name');
        return view('create', ['banks' => $banks, 'cities' => $cities]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullName' => 'required|string|max:255',
            'city' => 'required|not_in:0',
            'description' => 'required',
        ]);

        $client = new Client();
        $client->full_name = $request['fullName'];
        $client->social_status = $request['status'];
        $client->city_id = $request['city'];
        $client->phone = $request['phone'];
        $client->address = $request['address'];
        $client->description = $request['description'];
        $client->bank_id = $request['bank'];
        $client->card_number = $request['cardNumber'];
        $client->cardholder_name = $request['cardholderName'];
        $client->save();

        return redirect('list')->with(['message' => 'Успешно сохранено', 'alert' => 'alert-success']);
    }

    public function edit($id){

        $banks = Bank::all()->sortBy('name');
        $cities = City::all()->sortBy('name');
        $client = Client::find($id);

        return view('edit', ['banks' => $banks, 'cities' => $cities, 'client' => $client]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fullName' => 'required|string|max:255',
            'city' => 'required|not_in:0',
            'description' => 'required',
        ]);
        $checked = false;
        if ($request['is_visible']) {
            $checked = true;
        }

        $client = Client::find($id);
        $client->full_name = $request['fullName'];
        $client->social_status = $request['status'];
        $client->city_id = $request['city'];
        $client->phone = $request['phone'];
        $client->address = $request['address'];
        $client->description = $request['description'];
        $client->bank_id = $request['bank'];
        $client->card_number = $request['cardNumber'];
        $client->cardholder_name = $request['cardholderName'];
        $client->is_visible = $checked;
        $client->save();

        return redirect('list')->with(['message' => 'Успешно обнавлено', 'alert' => 'alert-success']);
    }
}
