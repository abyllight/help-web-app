@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session()->has('message'))
            <div class="alert {{session('alert') ?? 'alert-info'}}">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('store') }}" method="post">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2 class="mb-3">1. Личная информация</h2>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputFullName" class="col-form-label col-form-label-lg">Ф.И.О <span style="color: red">*</span></label>
                            <input type="text" class="form-control form-control-lg"
                                   id="inputFullName" name="fullName"
                                   placeholder="Иванов Иван"
                                   required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputStatus" class="col-form-label col-form-label-lg">Статус (Не обязательно)</label>
                            <input type="text" class="form-control form-control-lg" id="inputStatus" name="status"
                                   placeholder="Мать троих детей">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCity" class="col-form-label col-form-label-lg">Город <span style="color: red">*</span></label>
                            <select id="inputCity" class="form-control form-control-lg @error('city') is-invalid @enderror" name="city" required>
                                <option selected value="0">Не выбрано</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPhone" class="col-form-label col-form-label-lg">Мобильный телефон (Не обязательно)</label>
                            <input type="text" class="form-control form-control-lg" id="inputPhone" name="phone"
                                   placeholder="+7 (000) 000-00-00" data-mask="00/00/0000">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputAddress" class="col-form-label col-form-label-lg">Адрес (Не обязательно)</label>
                        <input type="text" class="form-control form-control-lg" id="inputAddress" name="address"
                               placeholder="Укажите улицу и номер дома">
                    </div>

                    <div class="form-group">
                        <label for="inputDescription" class="col-form-label col-form-label-lg">Описание <span style="color: red">*</span></label>
                        <textarea class="form-control form-control-lg" id="inputDescription" name="description" rows="5"
                                  placeholder="" required></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <h2 class="mb-3">2. Банковская карта</h2>
                        <div class="form-group">
                            <label for="inputBank" class="col-form-label col-form-label-lg">Выберите банк (Не обязательно)</label>
                            <select id="inputBank" class="form-control form-control-lg" name="bank">
                                <option selected>Не выбрано</option>
                                @foreach($banks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputCardNumber" class="col-form-label col-form-label-lg">Номер карты (Не обязательно)</label>
                            <input type="text" class="form-control form-control-lg" id="inputCardNumber" name="cardNumber"
                                   placeholder="0000 0000 0000 0000">
                        </div>


                    <div class="form-group">
                        <label for="inputCardholderName" class="col-form-label col-form-label-lg">Имя на карте (Не обязательно)</label>
                        <input type="text" class="form-control form-control-lg" id="inputCardholderName" name="cardholderName"
                               placeholder="Иванов Иван">
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary btn-lg">Добавить</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script type="text/javascript">
        $( document ).ready(function($) {
            $('#inputPhone').mask('+7 (999) 999-99-99');

            $('#inputCardNumber').mask('9999 9999 9999 9999');
        });
    </script>
@endsection
