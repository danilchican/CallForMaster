@extends('adminpanel.layouts.app')

@section('styles')
        <!-- DataTables -->
<link rel="stylesheet" href="/backend/themes/adminpanel/css/dataTables.bootstrap.css">
<link rel="stylesheet" href="/backend/themes/adminpanel/css/jquery.dataTables.css">
<link rel="stylesheet" href="/backend/themes/adminpanel/css/pace.min.css">
<link rel="stylesheet" href="/backend/themes/adminpanel/css/select2.min.css">
<style>
    .select2-container--default
    .select2-selection--multiple
    .select2-selection__choice {
        color: #000;
    }
</style>
@endsection

@section('content')
        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Tariffs</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Tariffs</li>
            <li class="active">Create tariff</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="callout callout-info">
            <h4>About this page!</h4>
            {!! $about or "<p>This page has been created for control of all tariffs. You can create, delete and edit
            any tariff by clicking on buttons.</p>" !!}
        </div>
        <div class="col-xs-12">
            <div class="row">
                {!! Form::open(['route' => 'admin.tariffs.store']) !!}
                <div class="box box-primary create-tariff">
                    <div class="box-header with-border">
                        <i class="fa fa-edit"></i>
                        <h3 class="box-title">{{ $title }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-6" style="padding-left:0;">
                                    <div class="form-group">
                                        <label for="name">Название тарифа</label>
                                        <input type="text" class="form-control" name="title" placeholder="Введите название тарифа">
                                    </div>
                                </div>
                                <div class="col-xs-6" style="padding-right:0;">
                                    <div class="form-group">
                                        <label for="slug">Топ</label>
                                        <input type="number" value="0" min="0" class="form-control" name="top">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-6" style="padding-left:0;">
                                    <div class="form-group">
                                        <label for="desc">Для кого</label>
                                        <input type="text" class="form-control" name="whom" placeholder="Для малого бизнеса">
                                    </div>
                                </div>
                                <div class="col-xs-6" style="padding-right:0;">
                                    <div class="form-group">
                                        <label for="desc">Доп. услуга</label>
                                        <input type="text" class="form-control" name="additional_service" placeholder="Наполнение карточки">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>

                <div class="col-xs-6">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Prices</h3>
                        </div>
                        <div class="box-body">
                            <div id="prices">
                                <div class="col-xs-12 price-item">
                                    <div class="row">
                                        <div class="col-xs-6" style="padding-left:0;">
                                            <label for="desc">Price <i class="fa fa-fw fa-remove remove-price-btn"></i></label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" step="any" value="0" name="prices[]">
                                                <span class="input-group-addon">руб.</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-6" style="padding-right:0;">
                                            <div class="form-group">
                                                <label for="desc">Time</label>
                                                <input type="text" class="form-control" name="ranges[]" placeholder="1 месяц">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="row">
                                    <button type="button" id="add-new-price-btn" style="text-align: left;" class="btn btn-block btn-success">
                                        <i class="fa fa-fw fa-plus"></i> Add more
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Services</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <select name="services[]" multiple="multiple" class="form-control select2 select2-hidden-accessible services-select" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="row">
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    {{ Form::checkbox('published', 1, true) }} Published
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary save-button">Save</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection

@section('javascripts')
    <script src="/backend/themes/adminpanel/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".services-select").select2({
                placeholder: "Выберите услуги...",
                allowClear: true
            });

            var add_price_btn = $('#add-new-price-btn');
            var prices_block = $('#prices');
            var new_price_block   = '';

            new_price_block = '<div class=\"col-xs-12 price-item\">'
                    + '<div class=\"row\">'
                    + '<div class=\"col-xs-6\" style=\"padding-left:0;\">'
                    + '<label for=\"desc\">Price <i class=\"fa fa-fw fa-remove remove-price-btn\"></i></label>'
                    + '<div class=\"input-group\">'
                    + '<input type=\"number\" class=\"form-control\" step=\"any\" value=\"0\" name=\"prices[]\">'
                    + '<span class=\"input-group-addon\">руб.</span>'
                    + '</div></div>'
                    + '<div class=\"col-xs-6\" style=\"padding-right:0;\">'
                    + '<div class=\"form-group\">'
                    + '<label for=\"desc\">Time</label>'
                    + '<input type=\"text\" class=\"form-control\" name=\"ranges[]\" placeholder=\"1 месяц\">'
                    + '</div></div></div></div>';

            add_price_btn.on('click', function () {
                prices_block.append(new_price_block);
            });

            $('.content').on("click", ".remove-price-btn",  function () {
                this.closest('.price-item').remove();
            });

        });
    </script>
@endsection