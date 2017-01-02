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
        <h1>Prices & Services</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Prices & Services</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="callout callout-info">
            <h4>About this page!</h4>
            {!! $about or "<p>This page has been created for control of all Prices & Services. You can create, delete and edit
            any Price or Service by clicking on buttons.</p>" !!}
        </div>

        <div class="col-xs-12" style="margin-bottom: 15px;">
            <div class="row">
                <div class="col-xs-2">
                    <div class="row">
                        <a href="{{ route('admin.tariffs.create') }}">
                            <button type="button" class="btn btn-block btn-primary">New Service</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <div class="box no-margin">
                    <div class="box-header">
                        <h3 class="box-title">{{ $title_service }}</h3>
                    </div><!-- /.box-header -->
                        <div class="box-body table-responsive @if(count($services) > 0) no-padding no-margin @endif">
                            @if(count($services) > 0)
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($services as $service)
                                <tr>
                                    <td>{{ $service->id }}.</td>
                                    <td>{{ $service->title }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="">
                                                <button type="button" class="btn btn-info btn-xs">Edit</button>
                                            </a>
                                            {!! Form::open(['url' => '/', 'method' => 'delete', null, 'style' => 'display: inline;']) !!}
                                                <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                                            {!! Form::close() !!}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @else
                                <h4>Услуг пока нет.</h4>
                            @endif
                        </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">
            <div class="col-sm-6">
                {!! $services->links() !!}
            </div><!-- /.col -->
        </div><!-- /.row -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection