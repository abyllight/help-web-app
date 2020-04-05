@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <img src="{{ asset('user.svg') }}" width="32" class="mb-3">
                <h4 class="card-title">{{ $client->full_name }}</h4>
                <h6 class="card-subtitle mb-2 text-muted">{{ $client->social_status }}</h6>
                <p class="lead">{{ $client->description }}</p>
                <br>
                <img src="{{ asset('home-run.svg') }}" width="32" class="mb-3">
                <h5 class="card-title">{{ $client->city->name }}</h5>
                <p class="lead">{{ $client->address }}</p>
                <h5 class="card-title">{{ $client->phone }}</h5>
                <br>

            </div>
            <div class="col-md-4">
                <div class="card shadow-sm p-3 mb-3 bg-white rounded">
                    <div class="card-body">
                        <img src="{{ asset('credit-card.svg') }}" width="32" class="mb-3">
                        <h5 class="card-title">{{ $client->bank->name }}</h5>
                        <h5 class="card-title">{{ $client->card_number }}</h5>
                        <h5 class="card-title">{{ $client->cardholder_name }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10 mt-2">
                <div class="jumbotron">
                    <h1 class="display-4">Hello, world!</h1>
                    <p class="lead">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    </p>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('whatsapp.svg') }}" alt="whatsapp" width="40">
                                <a href="https://wa.me/77003750708?text=I'm%20interested%20in%20your%20car%20for%20sale">
                                    <h5 class="ml-3 mt-2">+7 (777) 777-77-77</h5>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('telegram.svg') }}" alt="whatsapp" width="40">
                                <a href=https://t.me/abyllight">
                                    <h5 class="ml-3 mt-2">+7 (777) 777-77-77</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

