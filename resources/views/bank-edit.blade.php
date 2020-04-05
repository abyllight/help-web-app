@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('bank-update', $bank->id) }}" method="post">
                    @csrf
                    <h2 class="mb-3">Редактировать город</h2>
                    <div class="form-group">
                        <label for="name" class="col-form-label col-form-label-lg">Название <span style="color: red">*</span></label>
                        <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" id="name" name="name"
                               placeholder="Алматы" required value="{{ $bank->name }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputDescription" class="col-form-label col-form-label-lg">Описание (Не обязательно)</label>
                        <textarea class="form-control form-control-lg" id="inputDescription" name="description" rows="3"
                                  placeholder="">{{ $bank->description }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
