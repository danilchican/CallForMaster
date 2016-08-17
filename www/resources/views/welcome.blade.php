@extends('layouts.app')

@section('head')
    <title>ZvoniMasteru.by - Каталог специалистов сферы услуг</title>
@endsection

@section('content')
    <div class="container" style="margin-bottom:20px;">
        <div class="col-lg-12">
            <div class="input-group">
                <input type="text" class="form-control">
                  <span class="input-group-btn">
                      <button type="submit" class="btn btn-default">Найти</button>
                  </span>
            </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
    </div><!-- /.container -->

    <div class="container main-catalog">
        <div class="row">
            @foreach($categories as $category)
                <div class="col-md-3 col-sm-3 col-xs-6 main-catalog-box">
                    <img class="img-circle" data-src="holder.js/140x140" alt="140x140" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDAiIGhlaWdodD0iMTQwIj48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjcwIiB5PSI3MCIgc3R5bGU9ImZpbGw6I2FhYTtmb250LXdlaWdodDpib2xkO2ZvbnQtc2l6ZToxMnB4O2ZvbnQtZmFtaWx5OkFyaWFsLEhlbHZldGljYSxzYW5zLXNlcmlmO2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPjE0MHgxNDA8L3RleHQ+PC9zdmc+" style="width: 140px; height: 140px;">
                    <h4><a href="/categories/{{ $category->slug }}">{{ $category->name }}</a></h4>
                </div><!-- /.col-lg-4 -->
            @endforeach
        </div><!-- /.row -->

    </div><!-- /.main-catalog -->

@endsection
