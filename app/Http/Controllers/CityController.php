<?php

namespace App\Http\Controllers;

use App\City;
use App\Client;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CityController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all()->sortBy('name');

        return view('cities', ['cities' => $cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('city-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:cities'],
        ]);

        $city = new City();
        $city->name = $request['name'];
        $city->description = $request['description'];
        $city->save();

        return redirect('cities')->with(['message' => 'Город добавлен', 'alert' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city = City::find($id);

        return view('city-create', ['city' => $city]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::find($id);

        return view('city-edit', ['city' => $city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', Rule::unique('cities')->ignore($id)],
        ]);

        $city = City::find($id);
        $city->name = $request['name'];
        $city->description = $request['description'];
        $city->save();

        return redirect('cities')->with(['message' => 'Город обновлен', 'alert' => 'alert-success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $clients = Client::where('city_id', $request['id'])->get();

        foreach ($clients as $client){
            $client->city_id = null;
            $client->save();
        }

        $city = City::find($request['id']);
        $city->delete();

        $request->session()->flash('message', 'Город удален!');
        $request->session()->flash('alert', 'alert-success');

        return response()->json(true);
    }
}
