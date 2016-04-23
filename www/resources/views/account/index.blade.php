@extends('layouts.app')

@section('head')
    <title>ZvoniMasteru.by - Личный кабинет</title>
@endsection

@section('css')
    <style>
        #myTab {
            margin-bottom: 15px;
        }
        .btn-file { position: relative; overflow: hidden; margin-right: 4px; }
        .btn-file input { position: absolute; top: 0; right: 0; margin: 0; opacity: 0; filter: alpha(opacity=0);
            transform: translate(-300px, 0) scale(4); font-size: 23px; direction: ltr; cursor: pointer; }
        /* Fix for IE 7: */
        * + html .btn-file { padding: 2px 15px; margin: 1px 0 0 0; }

        .glyphicon-refresh-animate {
            -animation: spin .7s infinite linear;
            -webkit-animation: spin2 .7s infinite linear;
        }

        @-webkit-keyframes spin2 {
            from { -webkit-transform: rotate(0deg);}
            to { -webkit-transform: rotate(360deg);}
        }

        @keyframes spin {
            from { transform: scale(1) rotate(0deg);}
            to { transform: scale(1) rotate(360deg);}
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <!-- Nav tabs -->
        <ul id="myTab" class="nav nav-tabs">
            <li class="active"><a href="#profile" data-toggle="tab">Общие сведения</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="profile">
                <div id="validation-errors"></div>
                <div class="col-md-2 col-sm-3 col-xs-4">
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
                    <p><a href="{{ route('settings_index') }}" class="">Настройки аккаунта</a></p>
                    <p><a href="" class="">Виды специальностей</a></p>
                    <p><a href="" class="">Фото работ</a></p>
                    <p><a href="{{ url('/messages') }}" class="">Сообщения</a></p>
                    <p><a href="{{ route('reviews_index') }}" class="">Отзывы <span>(0)</span></a></p>
                </div>
                <div class="col-md-10 col-sm-9 col-xs-8">
                    <p>Владелец: {{ !empty($user->name) ? $user->name : 'Не заполнено' }}</p>
                    {{ !is_null($user->name) ? "Владелец: ".$user->name : '' }}
                    <p>Компания: {{ !empty($cname = $user->company->name) ? $cname : 'Не заполнено' }}</p>
                    <p>Учетная запись №{{ $user->id }}</p>
                    <p>Эл. почта: <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                    <p>Зарегистрирован {{ $user->created_at->diffForHumans() }}</p>
                    <p>Город: {{ !empty($address = $user->company->contacts->address) ? $address : 'Не заполнено' }}</p>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {

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