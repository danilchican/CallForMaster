@extends('layouts.app')

@section('head')
    <title>ZvoniMasteru.by - {{ $company->name }}</title>
@endsection

@section('content')
    <div class="container companies">
        <div class="row">
            <div class="col-md-12">
                <h3>{{ $company->name ? $company->name : 'Без имени'}} <a href="{{ URL::previous() }}" class="btn btn-default">Back</a></h3>

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
                            Сделать отображение ошибок
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
