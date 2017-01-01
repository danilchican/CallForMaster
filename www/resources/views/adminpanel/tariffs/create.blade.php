@extends('adminpanel.layouts.app')

@section('styles')
        <!-- DataTables -->
<link rel="stylesheet" href="/backend/themes/adminpanel/css/dataTables.bootstrap.css">
<link rel="stylesheet" href="/backend/themes/adminpanel/css/jquery.dataTables.css">
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
                <div class="box box-default create-specialization">
                    <div class="box-header with-border">
                        <i class="fa fa-edit"></i>
                        <h3 class="box-title">{{ $title }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        {!! Form::open(['route' => 'admin.tariffs.store']) !!}
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
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="published"> Published
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success save-button">Save</button>
                        {!! Form::close() !!}
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection