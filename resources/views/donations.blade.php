@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session()->has('message'))
            <div class="alert {{session('alert') ?? 'alert-info'}}">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-8">
                <h3>
                    <small class="text-muted">Список пожертвований для</small>
                    <br>
                    {{ $client->full_name }}
                </h3>
                <h5>Итого: {{ $client->getTotal() }}тг.</h5>
                <hr>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Сумма</th>
                        <th scope="col">Файл</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Дата</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($client->donations as $key => $donation)
                        <tr class="@if($donation->is_visible == true) table-success @else table-active @endif">
                            <td scope="row">{{ $key+1 }}</td>
                            <td>{{ $donation->full_name }}</td>
                            <td>{{ $donation->amount }}</td>
                            <td>
                                <a href="{{ route('download', $donation->uuid) }}" target="_blank">
                                    {{ Str::limit($donation->file_name,5) }}
                                </a>
                            </td>
                            <td>@if($donation->is_visible) On @else Off @endif</td>
                            <td>{{ $donation->created_at }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('donation-edit', $donation->id) }}" role="button">
                                    Ред.
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <form action="{{ route('donation-store', $client->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h4 class="mb-3">Добавить пожертвование</h4>
                    <div class="form-group">
                        <label for="name" class="col-form-label col-form-label-lg">Ф.И.О (Не обязательно)</label>
                        <input type="text" class="form-control form-control-lg" id="name" name="name"
                               placeholder="Иванов Иван">
                    </div>
                    <div class="form-group">
                        <label for="amount" class="col-form-label col-form-label-lg">Сумма <span style="color: red">*</span></label>
                        <input type="number" class="form-control form-control-lg" id="amount" name="amount"
                               placeholder="1000" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1" class="col-form-label col-form-label-lg">
                            Прикрепите файл <span style="color: red">*</span>
                        </label>
                        <input type="file" class="form-control-file form-control-lg @error('file') is-invalid @enderror" id="exampleFormControlFile1" name="file" required>
                        <small id="passwordHelpBlock" class="form-text text-muted">
                            Формат файла: pdf, jpeg, jpg, png. Не более 2мб
                        </small>
                        @error('file')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">Добавить</button>
                </form>
            </div>
        </div>
    </div>
@endsection


