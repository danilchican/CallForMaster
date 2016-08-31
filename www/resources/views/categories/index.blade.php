@extends('layouts.app')

@section('head')
    <title>ZvoniMasteru.by</title>
@endsection

@section('content')
    <div class="container companies">
        @if(count($categories) > 0)
            <div class="row">
                @foreach ($categories as $category)
                    <div class="category">
                        <b><a href="{{ route('categories.show', ['category' => $parent, 'subcategory' => $category->slug]) }}">{{ $category->name }}</a></b>
                    </div>
                @endforeach
            </div><!-- /.row -->
        @else
            <h4>Подкатегорий в данной категории нет.</h4>
        @endif
    </div><!-- /.container -->
@endsection
