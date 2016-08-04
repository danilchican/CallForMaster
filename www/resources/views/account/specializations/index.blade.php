@extends('layouts.app')

@section('head')
    <title>ZvoniMasteru.by - Альбомы</title>
@endsection

@section('css')
    <style>
        #myTab { margin-bottom: 15px; }
        .panel-heading { overflow: hidden; }
    </style>
@endsection

@section('content')
    <div class="container">
        <!-- Nav tabs -->
        <ul id="myTab" class="nav nav-tabs">
            <li class="active"><a href="#albums" data-toggle="tab">{{ !empty($cname = $company->name) ? $cname : 'Без имени' }}</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="albums">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h2>Виды специальностей:</h2>
                    <ul>
                        @foreach($specializations as $specialization)
                            <li>{{ $specialization->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection