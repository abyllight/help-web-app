<?php

namespace App\Http\Controllers;

use App\Client;
use App\Donation;
use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class DonationController extends Controller
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

    public function index($id)
    {
        $client = Client::find($id);

        return view('donations', ['client' => $client]);
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);
        if ($request['file']){
            $donation = new Donation();
            $donation->client_id = $id;
            $donation->full_name = $request['name'];
            $donation->uuid = Uuid::uuid4();
            $donation->file_name = uniqid().'_'.$request->file('file')->getClientOriginalName();
            $donation->amount = $request['amount'];
            $request->file('file')->storeAs('files', $donation->file_name);
            $donation->save();
            return redirect()->back()->with(['message' => 'Успешно добавлено', 'alert' => 'alert-success']);
        }else{
            return redirect()->back()->with(['message' => 'Произошла ошибка', 'alert' => 'alert-danger']);
        }
    }

    public function download($uuid)
    {
        $donation = Donation::where('uuid',$uuid)->firstOrFail();
        return Storage::download('/files/'.$donation->file_name);
    }

    public function edit($id)
    {
        $donation = Donation::find($id);
        return view('donation', ['donation' => $donation]);
    }

    public function update(Request $request, $id)
    {
        $checked = false;
        if ($request['is_visible']) {
            $checked = true;
        }

        $donation = Donation::find($id);
        $donation->amount = $request['amount'];
        $donation->is_visible = $checked;
        $donation->save();

        return redirect('/list/'.$donation->client->id.'/donations')->with(['message' => 'Успешно обнавлено', 'alert' => 'alert-success']);
    }
}
