@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(session()->has('message'))
                    <div class="alert {{session('alert') ?? 'alert-info'}}">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('message') }}
                    </div>
                @endif
                <div class="form-inline">
                    <div class="form-group">
                        <h3>Список нуждающихся</h3>
                    </div>
                    <div class="form-group mx-sm-3">
                        <a class="btn btn-primary" href="{{ route('create') }}" role="button">Добавить</a>
                    </div>
                </div>
                <hr>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ф.И.О</th>
                        <th scope="col">Город</th>
                        <th scope="col">Сумма</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Дата создания</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clients as $key => $client)
                        <tr class="@if($client->is_visible == true) table-success @else table-active @endif">
                            <td scope="row">{{ $key+1 }}</td>
                            <td>{{ $client->full_name }}</td>
                            <td>{{ $client->city->name }}</td>
                            <td>{{ $client->getTotal() }}тг.</td>
                            <td>@if($client->is_visible) Опубликовано @else Отключено @endif</td>
                            <td>{{ $client->created_at }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('edit', $client->id) }}" role="button">
                                    Редактировать
                                </a>
                                <a class="btn btn-primary btn-sm" href="{{ route('donation', $client->id) }}" role="button">
                                    Donations
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

