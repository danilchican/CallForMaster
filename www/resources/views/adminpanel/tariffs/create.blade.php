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
        <h1>Companies</h1>
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

        <div class="row">
            <div class="col-xs-12">
                <div class="box no-margin">
                    <div class="box-header">
                        <h3 class="box-title">{{ $title }}</h3>
                        <div class="box-tools">
                            <div class="input-group" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding no-margin">

                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection