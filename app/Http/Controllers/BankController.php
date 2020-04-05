<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BankController extends Controller
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $banks = Bank::all()->sortBy('name');
        return view('banks', ['banks' => $banks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('bank-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:banks'],
        ]);

        $bank = new Bank();
        $bank->name = $request['name'];
        $bank->description = $request['description'];
        $bank->save();

        return redirect('banks')->with(['message' => 'Банк добавлен', 'alert' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $bank = Bank::find($id);

        return view('bank-create', ['bank' => $bank]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $bank = Bank::find($id);

        return view('bank-edit', ['bank' => $bank]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', Rule::unique('banks')->ignore($id)],
        ]);

        $bank = Bank::find($id);
        $bank->name = $request['name'];
        $bank->description = $request['description'];
        $bank->save();

        return redirect('banks')->with(['message' => 'Банк обновлен', 'alert' => 'alert-success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $clients = Client::where('bank_id', $request['id'])->get();

        foreach ($clients as $client){
            $client->bank_id = null;
            $client->save();
        }

        $bank = Bank::find($request['id']);

        $bank->delete();

        $request->session()->flash('message', 'Банк удален!');
        $request->session()->flash('alert', 'alert-success');

        return response()->json(true);
    }
}
