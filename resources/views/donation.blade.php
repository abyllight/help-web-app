@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('donation-update', $donation->id) }}" method="post">
                    @csrf
                    <h2 class="mb-3">Редактировать сумму пожертвования</h2>
                    <div class="form-group">
                        <label for="name" class="col-form-label col-form-label-lg">Ф.И.О</label>
                        <input type="text" class="form-control form-control-lg" id="name" name="name"
                               placeholder="Алматы" value="{{ $donation->full_name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1" class="col-form-label col-form-label-lg">
                            Файл
                        </label>
                        <h5 class="card-title">{{ $donation->file_name }}</h5>
                    </div>
                    <div class="form-group">
                        <label for="amount" class="col-form-label col-form-label-lg">Сумма <span style="color: red">*</span></label>
                        <input type="number" class="form-control form-control-lg" id="amount" name="amount"
                               placeholder="1000" required value="{{ $donation->amount }}">
                    </div>
                    <div class="form-group form-check">
                        @if($donation->is_visible)
                            <input type="checkbox" class="form-check-input" id="checked" name="is_visible" checked>
                        @else
                            <input type="checkbox" class="form-check-input" id="checked" name="is_visible">
                        @endif
                        <label class="form-check-label" for="exampleCheck1">Опубликовано</label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
