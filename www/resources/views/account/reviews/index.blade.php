@extends('layouts.app')

@section('head')
    <title>ZvoniMasteru.by - Отзывы о компании</title>
@endsection

@section('css')

@endsection

@section('content')
    <div class="container">
        <h2>Отзывы о компании</h2>
        @if(count($reviews) > 0)
            <h3>Отзывы о компании:</h3>
            @foreach($reviews as $review)
                @include('companies.reviews.view', ['review' => $review])
            @endforeach
        @else
            <div class="alert alert-info">Отзывов пока еще нет. <strong><a href="#create-review-form">Станьте первым!</a></strong></div>
        @endif
    </div>
@endsection

@section('scripts')

@endsection