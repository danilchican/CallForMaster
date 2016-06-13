@extends('adminpanel.layouts.app')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="/backend/themes/adminpanel/css/dataTables.bootstrap.css">
<link rel="stylesheet" href="/backend/themes/adminpanel/css/jquery.dataTables.css">
<link rel="stylesheet" href="/backend/themes/adminpanel/css/pace.min.css">
<link rel="stylesheet" href="/backend/themes/adminpanel/css/select2.min.css">
@endsection

@section('content')
        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Categories</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Categories</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="callout callout-info">
            <h4>About this page!</h4>
            {!! $about or "<p>This page has been created for manipulation of all categories. You can create, delete and edit
            any category by clicking for buttons.</p>" !!}

        </div>

        <div class="row">
            <div class="col-xs-8">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">All Categories</h3>
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
                    <div class="box-body table-responsive no-padding categories-table">
                        <table class="table table-hover">
                            <tbody><tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Description</th>
                            </tr>
                            @foreach ($categories as $category)
                                @include('adminpanel.categories.category', ['category' => $category, 'dep' => '-'])
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="box box-default create-category">
                    <div class="box-header with-border">
                        <i class="fa fa-edit"></i>

                        <h3 class="box-title">Add Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        {!! Form::open(array('id' => 'create-category-form')) !!}
                        <div class="form-group">
                            <label for="name">Название категории</label>
                            <input type="text" class="form-control" id="category-name" name="name" placeholder="Введите название категории">
                        </div>
                        <div class="form-group">
                            <label for="slug">Ссылка</label>
                            <input type="text" class="form-control" id="category-slug" name="slug">
                        </div>
                        <div class="form-group">
                            <label for="parent">Дочерняя категория</label>
                            <select name="parent" class="form-control select2 select2-hidden-accessible parent-select" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option></option>
                                @foreach($parents as $parent)
                                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="desc">Описание категории</label>
                            <textarea class="form-control" rows="5" name="desc"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success save-button">Сохранить</button>
                        {!! Form::close() !!}
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection

@section('javascripts')
    <script src="/backend/themes/adminpanel/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".parent-select").select2({
                placeholder: "Выберите категорию...",
                allowClear: true
            });
        });
    </script>
     <script>
        $('document').ready(function() {

            var _token = $('input[name="_token"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': _token
                }
            });

            $('.save-button').click(function (e) {
                e.preventDefault();

                var name = $('input[name="name"]').val();
                var slug = $('input[name="slug"]').val();
                var desc = $('textarea[name="desc"]').val();
                var parent = $('select[name="parent"]').val();

                $.ajax({
                    url: "{{ route('category_new_post') }}",
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
                        parent_id: parent
                    },
                    error: function(data)
                    {
                        console.log(data);
                        var errors = data.responseJSON;
                        var errorsHtml = "";
                        $.each( errors, function( key, value ) {
                            errorsHtml += "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>"+ value[0] + "</p></div>"; //showing only the first error.
                        });
                        $('.callout').after(errorsHtml);
                    },
                    success: function(data) {
                        console.log(data);
                        var success = data.responseJSON;
                        $('.callout').after("<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>" + data.msg + "</p></div>");

                        var input = $('.create-category input');
                        $.each(input, function( key, value ) {
                            input.val('');
                        });
                    }
                })
                        .always(function() {
                            $('.save-button').button('reset');
                        });

            });
        });
    </script>
@endsection
