@extends('layouts.app')

@section('head')
    <title>ZvoniMasteru.by</title>
@endsection

@section('css')
    <style>
        .thumbnail .caption {
            overflow: hidden;
        }
    </style>
@endsection

@section('content')
    <div class="container companies">
            <div class="row">
                <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                    @if(count($categories) > 0)
                        @foreach ($categories as $category)
                            <div class="list-group" style="margin-bottom: 0;">
                                <a href="{{ route('categories.show', ['category' => $category->slug]) }}" class="list-group-item">{{ $category->name }}</a>
                            </div>
                        @endforeach
                    @else
                        
                        @foreach ($categories as $category)
                            <div class="list-group" style="margin-bottom: 0;">
                                <a href="{{ route('categories.show', ['category' => $category->slug]) }}" class="list-group-item">{{ $category->name }}</a>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="col-sm-9">
                    @if(count($companies) > 0)
                        <div class="row">
                            @foreach($companies as $company)
                                @include('categories.companies.show', ['company' => $company])
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
                </div>
            </div>
    </div><!-- /.container -->
@endsection