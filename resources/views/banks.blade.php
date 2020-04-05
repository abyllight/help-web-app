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
                        <h3>Список банков</h3>
                    </div>
                    <div class="form-group mx-sm-3">
                        <a class="btn btn-primary" href="{{ route('bank-create') }}" role="button">Добавить</a>
                    </div>
                </div>
                <hr>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Название</th>
                        <th scope="col">Описание</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($banks as $key => $bank)
                        <tr>
                            <td scope="row">{{ $key+1 }}</td>
                            <td>{{ $bank->name }}</td>
                            <td>{{ $bank->description }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('bank-edit', $bank->id) }}" role="button">Редактировать</a>
                                <button type="button" class="btn btn-danger btn-sm d" id="{{ $bank->id }}">Удалить</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $( document ).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".d").on('click', function () {
                var x = confirm("Вы уверены?");
                if(x){
                    $.ajax({
                        type: "POST",
                        url: '{{ route('bank-destroy') }}',
                        data: {
                            id: this.id
                        },
                        success: function (data) {
                            location.reload();
                        },
                        error: function (data) {
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                }
            });
        });
    </script>
@endsection

