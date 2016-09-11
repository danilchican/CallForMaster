@extends('layouts.app')

@section('head')
    <title>ZvoniMasteru.by - Тарифы</title>
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
            <div class="tab-pane fade in active" id="specializations">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h2>Тарифы:</h2>
                    @if(count($tariffs) < 1)
                        <h4>Тарифов нет.</h4>
                    @else
                        <ul>
                            @foreach ($tariffs as $tariff)
                                <div class="col-xs-3">
                                    {{ $tariff->title }}
                                </div>
                            @endforeach

                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection