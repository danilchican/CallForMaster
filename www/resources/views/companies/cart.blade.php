@extends('layouts.app')

@section('head')
    <title>ZvoniMasteru.by - {{ $company->name }}</title>
@endsection

@section('content')
    <div class="container companies">
        <div class="row">
            <div class="col-md-12">
                <h3>{{ $company->name ? $company->name : 'Без имени'}} <a href="{{ URL::previous() }}" class="btn btn-default">Back</a></h3>
                <img class="featurette-image img-responsive" id="logo" alt="150x150" width="150" src="/{{ $logo_url }}">
                <p>УНП: {{ !is_null($unp = $company->unp_number) ? $unp : 'Не заполнено' }}</p>
                <p>Адрес: {{ !empty($address = $company->contacts->address) ? $address : 'Не заполнено' }}</p>
                <p>Сайт: @if(!empty($website = $company->contacts->website_url)) <a href="{{ $website }}">{{ $website }}</a>
                    @else Не заполнено @endif </p>
                @if(count($phones) > 0)
                    <p>Телефоны:</p>
                    <ul>
                        @foreach($phones as $phone)
                            <li>{{ $phone->number }}</li>
                        @endforeach
                    </ul>
                @endif
                <p>Эл. почта компании: @if(!empty($email = $company->contacts->email)) <a href="mailto:{{ $email }}">{{ $email }}</a>
                    @else Не заполнено @endif </p>

                <h4>Социальные сети:</h4>
                    <ul>
                        <li><a href="{{ $groups->vk_url }}">Группа Вконтакте</a></li>
                        <li><a href="{{ $groups->fb_url }}">Группа Facebook</a></li>
                        <li><a href="{{ $groups->ok_url }}">Группа Одноклассники</a></li>
                    </ul>
                <h4>Описание компании:</h4>
                <p>{{ $company->description }}</p>

                @if(count($reviews) > 0)
                    <h3>Отзывы о компании:</h3>
                    @foreach($reviews as $review)
                        @include('companies.reviews.view', ['review' => $review])
                    @endforeach
                @else
                    <div class="alert alert-info">Отзывов пока еще нет. <strong><a href="#create-review-form">Станьте первым!</a></strong></div>
                @endif

                <div class="col-md-8">
                    <div class="row">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Добавление отзыва</div>
                            <div class="panel-body">
                                @include('companies.reviews.create', ['company' => $company])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container -->
@endsection
