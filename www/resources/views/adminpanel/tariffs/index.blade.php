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
            <li class="active">Tariffs</li>
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

        <div class="col-xs-12" style="margin-bottom: 15px;">
            <div class="row">
                <div class="col-xs-2">
                    <div class="row">
                        <a href="{{ route('admin.tariffs.create') }}">
                            <button type="button" class="btn btn-block btn-primary">New tariff</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box no-margin">
                    <div class="box-header">
                        <h3 class="box-title">{{ $title }}</h3>
                        @if(count($tariffs) > 0)
                            <div class="box-tools">
                                <div class="input-group" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div><!-- /.box-header -->
                        <div class="box-body table-responsive @if(count($tariffs) > 0) no-padding no-margin @endif">
                            @if(count($tariffs) > 0)
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Top</th>
                                    <th>Created at</th>
                                    <th>Published</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tariffs as $tariff)
                                    <tr>
                                        <td>{{ $tariff->id }}.</td>
                                        <td><a href="/adminpanel/tariffs/view/{{ $tariff->id }}" data-toggle="tooltip" data-original-title="View Tariff">{{ $tariff->title }}</a></td>
                                        <td>TOP {{ $tariff->top }}</td>
                                        <td>{{ $tariff->created_at->format('m.d.Y H:i') }}</td>
                                        <td>
                                            @if($tariff->published)
                                                <span class="label label-success">Published</span>
                                            @else
                                                <span class="label label-danger">Not published</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.tariffs.edit', $tariff->id) }}">
                                                    <button type="button" class="btn btn-info btn-xs">Edit</button>
                                                </a>
                                                {!! Form::open(['route' => ['admin.tariffs.destroy', $tariff->id], 'method' => 'delete', null, 'style' => 'display: inline;']) !!}
                                                    <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @else
                                <h4>Тарифов пока нет.</h4>
                            @endif
                        </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">
            <div class="col-sm-6">
                {!! $tariffs->links() !!}
            </div><!-- /.col -->
        </div><!-- /.row -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection