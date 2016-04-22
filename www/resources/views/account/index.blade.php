@extends('layouts.app')

@section('head')
    <title>ZvoniMasteru.by - Личный кабинет</title>
@endsection

@section('css')
    <style>
        #myTab {
            margin-bottom: 15px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <!-- Nav tabs -->
        <ul id="myTab" class="nav nav-tabs">
            <li class="active"><a href="#profile" data-toggle="tab">Общие сведения</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="profile">
                <div class="col-md-2 col-sm-3 col-xs-4">
                    <img class="featurette-image img-responsive" data-src="holder.js/300x300/auto" alt="300x300" width="150" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1MDAiIGhlaWdodD0iNTAwIj48cmVjdCB3aWR0aD0iNTAwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjI1MCIgeT0iMjUwIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjMxcHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NTAweDUwMDwvdGV4dD48L3N2Zz4=">
                    <br/>
                    <p><a href="{{ route('settings_index') }}" class="">Настройки аккаунта</a></p>
                    <p><a href="{{ url('/messages') }}" class="">Сообщения</a></p>
                    <p><a href="{{ route('reviews_index') }}" class="">Отзывы <span>(0)</span></a></p>
                </div>
                <div class="col-md-10 col-sm-9 col-xs-8">
                    <p>Владелец: {{ !empty($user->name) ? $user->name : 'Не заполнено' }}</p>
                    {{ !is_null($user->name) ? "Владелец: ".$user->name : '' }}
                    <p>Компания: {{ !empty($cname = $user->company->name) ? $cname : 'Не заполнено' }}</p>
                    <p>Учетная запись №{{ $user->id }}</p>
                    <p>Эл. почта: <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                    <p>Зарегистрирован {{ $user->created_at->diffForHumans() }}</p>
                    <p>Город: {{ !empty($address = $user->company->contacts->address) ? $address : 'Не заполнено' }}</p>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#myTab a').click(function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>
@endsection