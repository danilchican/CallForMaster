@extends('layouts.app')

@section('head')
    <title>ZvoniMasteru.by - {{ $company->name }}</title>
@endsection

@section('content')
    <div class="container companies">
        <div class="row">
           <h3>{{ $company->name ? $company->name : 'Без имени'}}</h3>
            <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
        </div><!-- /.row -->
    </div><!-- /.container -->
@endsection
