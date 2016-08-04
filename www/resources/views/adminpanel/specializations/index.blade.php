@extends('adminpanel.layouts.app')

@section('styles')
        <!-- DataTables -->
<link rel="stylesheet" href="/backend/themes/adminpanel/css/dataTables.bootstrap.css">
<link rel="stylesheet" href="/backend/themes/adminpanel/css/jquery.dataTables.css">
<link rel="stylesheet" href="/backend/themes/adminpanel/css/pace.min.css">
<link rel="stylesheet" href="/backend/themes/adminpanel/css/select2.min.css">
<style>
    .special-item {
        padding: 5px 12px;
        margin: 3px 10px;
        border-radius: 2px;
        border: 1px solid #d2d6de;
    }

    .pull-right { float:right; }
    .pull-right i { cursor: pointer; }

    .specializations-table { padding-bottom:6px!important; }

    h4 { padding: 0 8px; }
</style>
@endsection

@section('content')
        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Specializations</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Specializations</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="callout callout-info">
            <h4>About this page!</h4>
            {!! $about or "<p>This page has been created for manipulation of all specializations. You can create, delete and edit
            any specialization by clicking for buttons.</p>" !!}

        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ $title }}</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding specializations-table">
                        @if(count($specializations) < 1)
                            <h4>Специальностей пока нет.</h4>
                        @else
                            @foreach ($specializations as $special)
                                <div class="special-item">
                                    <input type="hidden" class="special-id" value="{{ $special->id }}">
                                    <b>{{ $special->name }}</b>
                                    <div class="pull-right">
                                        <i class="fa fa-pencil edit-special" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Edit" data-toggle="modal" data-target="#edit-special-modal"></i>
                                        <i class="fa fa-times del-special" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Delete"></i>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
                @include('adminpanel.specializations.create')
            </div>

        </div>

        Edit include

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection

@section('javascripts')
    <script src="/backend/themes/adminpanel/js/jquery.spoiler.min.js"></script>
    <script src="/backend/themes/adminpanel/js/select2.min.js"></script>
    <script>
        $('document').ready(function() {

            $('#edit-cat-modal').modal({
                show : false
            });

            var _token = $('input[name="_token"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': _token
                }
            });

            $('.create-specialization').on('click', '.save-button', function (e) {
                e.preventDefault();

                var name = $('input[name="name"]').val();
                var slug = $('input[name="slug"]').val();
                var desc = $('textarea[name="desc"]').val();

                $.ajax({
                    url: "{{ route('admin.specialization.create') }}",
                    type: 'POST',
                    dataType: 'json',
                    beforeSend: function() {
                        $('.alert').remove();
                        $('.save-button').button('loading');
                    },
                    data: {
                        name: name,
                        slug: slug,
                        desc: desc,
                    },
                    error: function(data)
                    {
                        var errors = data.responseJSON;
                        var errorsHtml = "";
                        $.each( errors, function( key, value ) {
                            errorsHtml += "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>"+ value[0] + "</p></div>"; //showing only the first error.
                        });
                        $('.callout').after(errorsHtml);
                    },
                    success: function(data) {
                        $('.callout').after("<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>" + data.msg + "</p></div>");

                        var input = $('.create-specialization input');
                        $.each(input, function( key, value ) {
                            input.val('');
                        });

                        var haventSpecializations = $('.specializations-table').find('h4');

                        if(haventSpecializations)
                            haventSpecializations.remove();

                        $('.specializations-table ul').append('<li><a href="">' + data.special.name + '</li>');
                    }
                })
                        .always(function() {
                            $('.save-button').button('reset');
                        });

            });


            $('.specializations-table').on('click', '.del-special', function (e) {
                e.preventDefault();

                var id = getSpecializationID(this);
                var content = $(this).closest('.special-item');

                $.ajax({
                    url: "{{ route('admin.specialization.delete') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id,
                    },
                    error: function(data)
                    {
                        var errors = data.responseJSON;
                        var errorsHtml = "";
                        $.each( errors, function( key, value ) {
                            errorsHtml += "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>"+ value[0] + "</p></div>"; //showing only the first error.
                        });
                        content.before(errorsHtml);
                    },
                    success: function(data) {
                        content.remove();

                        var item = $('.specializations-table').find('.special-item');
                        console.log(item);
                        if(item.length == 0) {
                            $('.specializations-table').append('<h4>Специальностей пока нет.</h4>');
                        }
                    }
                });

            });

            function getSpecializationID(obj) {
                return ($(obj).closest('.special-item').find('.special-id').val());
            }

        });
    </script>
@endsection
