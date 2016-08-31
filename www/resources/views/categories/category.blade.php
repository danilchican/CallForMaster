@extends('layouts.app')

@section('head')
    <title>ZvoniMasteru.by</title>
@endsection

@section('content')
    <div class="container companies">
        @if(count($companies) > 0)
            <div class="row">
                @foreach($companies as $company)
                    <div class="col-md-12 col-sm-12 col-xs-12 company-box">
                        <h4><a href="{{ route('companies.cart', $company->id) }}">{{ $company->name ? $company->name : 'Без имени' }}</a></h4>
                    </div><!-- /.col-lg-4 -->
                @endforeach
            </div><!-- /.row -->

            <div class="row">
                <div class="col-sm-6">
                    {!! $companies->links() !!}
                </div><!-- /.col -->
            </div><!-- /.row -->
        @else
            <h4>Компаний в данной категории еще нет.</h4>
        @endif
    </div><!-- /.container -->
@endsection