@extends('layouts.app')

@section('head')
    <title>ZvoniMasteru.by - Настройки аккаунта</title>
@endsection

@section('css')
    <style>
        #myTab {
            margin-bottom: 15px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <!-- Nav tabs -->
        <ul id="myTab" class="nav nav-tabs">
            <li class="active"><a href="#settings" data-toggle="tab">Общие настройки</a></li>
            <li><a href="#contacts" data-toggle="tab">Контактные данные</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">

            <div class="tab-pane fade in active" id="settings">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-default main-settings">
                        <div class="panel-heading">
                            <h3 class="panel-title">Основные</h3>
                        </div>
                        <div class="panel-body">
                            {!! Form::open(array('id' => 'main-form')) !!}
                            <div class="form-group">
                                <label for="username">Контактное лицо</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Введите контактное лицо" value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                                <label for="company-name">Название компании</label>
                                <input type="text" class="form-control" id="company-name" name="company-name" placeholder="Введите название компании" value="{{ $user->company->name }}">
                            </div>
                            <div class="form-group">
                                <label for="unp-number">УНП</label>
                                <input type="number" class="form-control" id="unp-number" name="unp-number" placeholder="Введите номер УНП" value="{{ $user->company->unp_number }}">
                            </div>
                            <div class="form-group">
                                <label for="company-description">Описание компании</label>
                                <textarea class="form-control" rows="5" name="company-description">{{ $user->company->description }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-success save-button">Сохранить</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-default socials-settings">
                        <div class="panel-heading">
                            <h3 class="panel-title">Социальные сети</h3>
                        </div>
                        <div class="panel-body">
                            {!! Form::open(array('id' => 'socials-form')) !!}
                            <div class="form-group">
                                <label for="company-vk-group">Группа Вконтакте</label>
                                <input type="text" class="form-control" name="vk_url" id="vk-group" placeholder="http://vk.com/" value="{{ $user->company->contacts->groups->vk_url }}">
                            </div>
                            <div class="form-group">
                                <label for="company-fb-group">Группа Facebook</label>
                                <input type="text" class="form-control" name="fb_url" id="fb-group" placeholder="http://facebook.com/" value="{{ $user->company->contacts->groups->fb_url }}">
                            </div>
                            <div class="form-group">
                                <label for="company-ok-group">Группа Одноклассники</label>
                                <input type="text" class="form-control" name="ok-group" id="ok-group" placeholder="http://odnoklassniki.ru/" value="{{ $user->company->contacts->groups->ok_url  }}">
                            </div>
                            <button type="submit" class="btn btn-success save-button">Сохранить</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade in" id="contacts">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-default contacts-settings">
                        <div class="panel-heading">
                            <h3 class="panel-title">Контактные данные</h3>
                        </div>
                        <div class="panel-body">
                            {!! Form::open(array('id' => 'contacts-form')) !!}
                            <div class="form-group">
                                <label for="company-address">Адрес</label>
                                <input type="text" class="form-control" name="address" placeholder="Адрес вашей компании" value="{{ $user->company->contacts->address }}">
                            </div>
                            <div class="form-group">
                                <label for="website">Сайт: </label>
                                <input type="text" class="form-control" name="website" placeholder="Имя вашего сайта" value="{{ $user->company->contacts->website_url }}">
                            </div>
                            <div class="form-group">
                                <label for="company-email">Email компании</label>
                                <input type="text" class="form-control" name="email" value="{{ $user->company->contacts->email }}">
                            </div>
                            <div class="form-group">
                                <label for="company-skype">Skype</label>
                                <input type="text" class="form-control" name="company-skype" value="{{ $user->company->contacts->skype }}">
                            </div>
                            <div class="form-group">
                                <label for="company-viber">Viber</label>
                                <input type="text" class="form-control" name="company-viber" value="{{ $user->company->contacts->viber }}">
                            </div>
                            <div class="form-group">
                                <label for="company-icq">ICQ</label>
                                <input type="text" class="form-control" name="company-icq" value="{{ $user->company->contacts->icq }}">
                            </div>
                            <button type="submit" class="btn btn-success save-button">Сохранить</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-default contacts-phones">
                        <div class="panel-heading">
                            <h3 class="panel-title">Телефоны</h3>
                        </div>
                        <div class="panel-body">
                            1 основной. 2 дополнительных.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
<script>
    $('document').ready(function() {
        $('#myTab a').click(function (e) {
            e.preventDefault()
            $(this).tab('show')
        })

        $('.save-button').click(function (e) {
            e.preventDefault();

            switch(form_id = $(this).closest('form').attr('id')) {
                case "main-form":
                        SendRequestMainSettings("#" + form_id);
                    break;
                case "contacts-form":
                        SendRequestContactsSettings("#" + form_id);
                    break;
                case "socials-form":
                        SendRequestSocialsSettings("#" + form_id);
                    break;
            }

        });

        function SendRequestMainSettings(form_id) {
            var username = $(form_id).find('input[name="username"]').val();
            var company_name = $(form_id).find('input[name="company-name"]').val();
            var unp_number = $(form_id).find('input[name="unp-number"]').val();
            var description = $(form_id).find('textarea[name="company-description"]').val();

            var _token = $(form_id).find('input[name="_token"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': _token
                }
            });

            $.ajax({
                url: "{{ route('update_main_settings') }}",
                type: 'POST',
                dataType: 'json',
                beforeSend: function() {
                    $('.alert').remove();
                    $(form_id).find('.save-button').button('loading');
                },
                data: {
                    company : {
                        name: company_name,
                        unp_number: unp_number,
                        description: description
                    },
                    user : {
                        name: username,
                    },
                },
                error: function(data)
                {
                    console.log(data);
                    var errors = data.responseJSON;
                    var errorsHtml = " ";
                    $.each( errors, function( key, value ) {
                        errorsHtml += "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>"+ value[0] + "</p></div>"; //showing only the first error.
                    });
                    $('.main-settings').before(errorsHtml);
                },
                success: function(data) {
                    console.log(data);
                    var success = data.responseJSON;
                    $('.main-settings').before("<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>" + data.msg + "</p></div>");
                }
            })
            .always(function() {
                $('.save-button').button('reset');
            });
        }

        function SendRequestContactsSettings(form_id) {
            var address = $(form_id).find('input[name="address"]').val();
            var website = $(form_id).find('input[name="website"]').val();
            var email = $(form_id).find('input[name="email"]').val();
            var skype = $(form_id).find('input[name="company-skype"]').val();
            var viber = $(form_id).find('input[name="company-viber"]').val();
            var icq = $(form_id).find('input[name="company-icq"]').val();

            var _token = $(form_id).find('input[name="_token"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': _token
                }
            });

            $.ajax({
                url: "{{ route('update_contacts') }}",
                type: 'POST',
                dataType: 'json',
                beforeSend: function() {
                    $('.alert').remove();
                    $(form_id).find('.save-button').button('loading');
                },
                data: {
                    address: address,
                    website_url: website,
                    email: email,
                    skype: skype,
                    viber: viber,
                    icq: icq
                },
                error: function(data)
                {
                    console.log(data);
                    var errors = data.responseJSON;
                    var errorsHtml = " ";
                    $.each( errors, function( key, value ) {
                        errorsHtml += "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>"+ value[0] + "</p></div>"; //showing only the first error.
                    });
                    $('.contacts-settings').before(errorsHtml);
                },
                success: function(data) {
                    console.log(data);
                    var success = data.responseJSON;
                    $('.contacts-settings').before("<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>" + data.msg + "</p></div>");
                }
            })
            .always(function() {
                $('.save-button').button('reset');
            });
        }

        function SendRequestSocialsSettings(form_id) {
            var vk = $(form_id).find('input[name="vk_url"]').val();
            var fb = $(form_id).find('input[name="fb_url"]').val();
            var ok = $(form_id).find('input[name="ok-group"]').val();

            var _token = $(form_id).find('input[name="_token"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': _token
                }
            });

            $.ajax({
                url: "{{ route('update_socials') }}",
                type: 'POST',
                dataType: 'json',
                beforeSend: function() {
                    $('.alert').remove();
                    $(form_id).find('.save-button').button('loading');
                },
                data: {vk_url: vk, fb_url: fb, ok_url: ok},
                error: function(data)
                {
                    console.log(data);
                    var errors = data.responseJSON;
                    var errorsHtml = " ";
                    $.each( errors, function( key, value ) {
                        errorsHtml += "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>"+ value[0] + "</p></div>"; //showing only the first error.
                    });
                    $('.socials-settings').before(errorsHtml);
                },
                success: function(data) {
                    console.log(data);
                    var success = data.responseJSON;
                    $('.socials-settings').before("<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>" + data.msg + "</p></div>");
                }
            })
            .always(function() {
                    $('.save-button').button('reset');
            });
        }
    });
</script>
@endsection