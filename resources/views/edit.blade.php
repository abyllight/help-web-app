@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session()->has('message'))
            <div class="alert {{session('alert') ?? 'alert-info'}}">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('update', $client->id) }}" method="post">
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
                                   value="{{ $client->full_name }}"
                                   required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputStatus" class="col-form-label col-form-label-lg">Статус (Не обязательно)</label>
                            <input type="text" class="form-control form-control-lg" id="inputStatus" name="status"
                                   placeholder="Мать троих детей"
                                   value="{{ $client->social_status }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCity" class="col-form-label col-form-label-lg">Город <span style="color: red">*</span></label>
                            <select id="inputCity" class="form-control form-control-lg @error('city') is-invalid @enderror" name="city" required>
                                <option value="0">Не выбрано</option>
                                @foreach($cities as $city)
                                    @if($client->city_id == $city->id)
                                        <option selected value="{{ $city->id }}">{{ $city->name }}</option>
                                    @else
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endif
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
                                   placeholder="+7 (000) 000-00-00"
                                   value="{{ $client->phone }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputAddress" class="col-form-label col-form-label-lg">Адрес (Не обязательно)</label>
                        <input type="text" class="form-control form-control-lg" id="inputAddress" name="address"
                               placeholder="Укажите улицу и номер дома"
                               value="{{ $client->address }}">
                    </div>

                    <div class="form-group">
                        <label for="inputDescription" class="col-form-label col-form-label-lg">Описание <span style="color: red">*</span></label>
                        <textarea class="form-control form-control-lg" id="inputDescription" name="description" rows="5"
                                  placeholder="" required>{{ $client->description }}</textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <h2 class="mb-3">2. Банковская карта</h2>
                        <div class="form-group">
                            <label for="inputBank" class="col-form-label col-form-label-lg">Выберите банк (Не обязательно)</label>
                            <select id="inputBank" class="form-control form-control-lg" name="bank">
                                <option value="0">Не выбрано</option>
                                @foreach($banks as $bank)
                                    @if($client->bank_id == $bank->id)
                                        <option selected value="{{ $bank->id }}">{{ $bank->name }}</option>
                                    @else
                                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputCardNumber" class="col-form-label col-form-label-lg">Номер карты (Не обязательно)</label>
                            <input type="text" class="form-control form-control-lg" id="inputCardNumber" name="cardNumber"
                                   placeholder="0000 0000 0000 0000"
                                   value="{{ $client->card_number }}">
                        </div>


                    <div class="form-group">
                        <label for="inputCardholderName" class="col-form-label col-form-label-lg">Имя на карте (Не обязательно)</label>
                        <input type="text" class="form-control form-control-lg" id="inputCardholderName" name="cardholderName"
                               placeholder="Иванов Иван"
                               value="{{ $client->cardholder_name }}">
                    </div>
                    <hr>
                    <h2 class="mb-3">3. Статус</h2>
                    <div class="form-group form-check">
                        @if($client->is_visible)
                            <input type="checkbox" class="form-check-input" id="checked" name="is_visible" checked>
                        @else
                            <input type="checkbox" class="form-check-input" id="checked" name="is_visible">
                        @endif
                        <label class="form-check-label" for="exampleCheck1">Опубликовано</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">Сохранить</button>
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
