@extends('layouts.app')

@section('head')
    <title>ZvoniMasteru.by - Личный кабинет</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="/backend/themes/default/css/lightbox/lightbox.css">
<style>
    #myTab {
        margin-bottom: 15px;
    }
    .btn-file { position: relative; overflow: hidden; margin-right: 4px; }
    .btn-file input { position: absolute; top: 0; right: 0; margin: 0; opacity: 0; filter: alpha(opacity=0);
        transform: translate(-300px, 0) scale(4); font-size: 23px; direction: ltr; cursor: pointer; }
    /* Fix for IE 7: */
    * + html .btn-file { padding: 2px 15px; margin: 1px 0 0 0; }
    .panel-heading { overflow: hidden; }

    #album-images {
        margin: 0;
        padding: 0;
    }

    #album-images li {
        margin: 0;
        padding: 0;
        list-style: none;
        float: left;
        padding-right: 10px;
    }

    #album-images img {
        width: 240px;
        height: 160px;
        border: 2px solid black;
        margin-bottom: 10px;
    }
</style>
@endsection

@section('content')
    <div class="container">
        <!-- Nav tabs -->
        <ul id="myTab" class="nav nav-tabs">
            <li class="active"><a href="#profile" data-toggle="tab">{{ !empty($cname = $company->name) ? $cname : 'Без имени' }}</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="profile">
                <div id="validation-errors"></div>
                <div class="col-md-2 col-sm-3 col-xs-12">
                    <div class="control-group" style="margin-bottom: 5px;">
                        <div class="controls clearfix">
                            <span class="btn btn-success btn-file">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <i class="icon-plus"></i>
                                <span class="upload-logo-text">Изменить логотип</span>
                                <input type="file" name="logo" id="upload-image" enctype="multipart/form-data"/>
                            </span>
                        </div>
                    </div>
                    <img class="featurette-image img-responsive" id="logo" alt="150x150" width="150" src="{{ $logo_url }}">
                    <br />
                    <p><a href="{{ route('settings_index') }}">Настройки аккаунта</a></p>
                    <p><a href="{{ route('work.types.index') }}">Виды работ</a></p>
                    <p><a href="{{ route('account.specializations.index') }}">Виды специальностей</a></p>
                    <p><a href="{{ route('albums.index') }}">Фото работ ({{ $countPhotos }})</a></p>
                    <p><a href="{{ route('reviews_index') }}">Отзывы <span>({{ $countReviews  }})</span></a></p>
                    <p><a href="{{ route('rise.index') }}">Продвижение в ТОП</a></p>
                </div>
                <div class="col-md-10 col-sm-9 col-xs-12">
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
                    <p>Ваш e-mail: <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                    <p>Эл. почта компании: @if(!empty($email = $company->contacts->email)) <a href="mailto:{{ $email }}">{{ $email }}</a>
                        @else Не заполнено @endif </p>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">Фотографии</h3>
                            <div class="panel-tools pull-right"><a href="{{ route('albums.index') }}">Загрузить фотографии</a></div>
                        </div>
                        <div class="panel-body">
                            @if( $countPhotos > 0 )
                            <ul id="album-images">
                                @foreach($photos as $photo)
                                    <li>
                                        <a data-lightbox="roadtrip" href="{{ $photo->image_url }}">
                                            <img alt="{{ $photo->title }}" src="/{{ $photo->image_url }}" style="width: 140px; height: 140px;">
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            @else
                                Фотографий нет
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script type="text/javascript" src="/backend/themes/default/js/lightbox/lightbox-plus-jquery.min.js"></script>
<script>
$(document).ready(function() {
    jQuery.noConflict();
    $(document).on('change', 'input[name="logo"]', function() {

        var input = $("#upload-image");
        var data = new FormData();
        data.append('logo', input.prop('files')[0]);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('upload_logo') }}",
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            beforeSend: function() {
                $('.btn-file').button('loading');
            },
            success: function(response){
                if(response.success) {
                    $('#logo').attr('src', response.logo_url);
                } else {
                    if(response.message == undefined) {
                        alert(response.errors.logo);
                        $('.btn-file').button('reset');
                        return;
                    }
                    alert(response.message);
                }
                $('.btn-file').button('reset');
            }
        });
    });

});
</script>
@endsection