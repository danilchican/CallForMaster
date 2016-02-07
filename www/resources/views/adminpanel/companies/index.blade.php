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
            <li class="active">Companies</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="callout callout-info">
            <h4>About this page!</h4>

            <p>This page has been created for manipulation of all registered companies. You can create, delete and edit
            any company by clicking for buttons.</p>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">All Registered Companies</h3>
                        <div class="box-tools">
                            <div class="input-group" style="width: 250px;">
                                <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Registration Date</th>
                                    <th>Published</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($companies as $company)
                                <tr>
                                    <td>{{ $company->id }}.</td>
                                    <td><a href="/adminpanel/companies/view/{{ $company->id }}" data-toggle="tooltip" data-original-title="View Company">{!! $company->name == '' ? 'No name' : $company->name !!}</a></td>
                                    <td>{{ $company->user->created_at }}</td> <!-- Registration date -->
                                    <td>
                                        @if($company->status)
                                            <span class="label label-success">Approved</span>
                                        @else
                                            <span class="label label-danger">Delivered</span>
                                        @endif
                                    </td> <!-- Published status -->
                                    <td>
                                        {!! empty($company->description) ? 'Company has no description yet...' : $company->description !!}
                                    </td> <!-- Description -->
                                    <td>
                                        <div class="btn-group">
                                            <a href="/adminpanel/companies/edit/{{ $company->id }}"><button type="button" class="btn btn-info btn-xs">Edit</button></a>
                                            <a href="/adminpanel/companies/delete/{{ $company->id }}"><button type="button" class="btn btn-danger btn-xs">Delete</button></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="col-sm-6">{!! $companies->links() !!}</div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection