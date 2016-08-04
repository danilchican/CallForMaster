@extends('adminpanel.layouts.app')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="/backend/themes/adminpanel/css/dataTables.bootstrap.css">
<link rel="stylesheet" href="/backend/themes/adminpanel/css/jquery.dataTables.css">
<link rel="stylesheet" href="/backend/themes/adminpanel/css/pace.min.css">
<link rel="stylesheet" href="/backend/themes/adminpanel/css/select2.min.css">
<style>
    .category {
        padding: 5px 12px;
        margin: 3px 10px;
        border-radius: 2px;
        cursor: pointer;
        border: 1px solid #d2d6de;
    }
    .pull-right {
        float:right;
    }
    .categories-table {
        padding-bottom:6px!important;
    }
    h4 {
        padding: 0 8px;
    }

</style>
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
            <div class="col-xs-12 col-sm-8 col-md-8">
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
                        @if(count($categories) < 1)
                            <h4>Категорий пока нет.</h4>
                        @else
                            @foreach ($categories as $category)
                                @include('adminpanel.categories.category', ['category' => $category, 'dep' => '-'])
                            @endforeach
                        @endif
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
                @include('adminpanel.categories.create', ['parent' => $parents])
            </div>

        </div>

        @include('adminpanel.categories.edit')

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection

@section('javascripts')
    <script src="/backend/themes/adminpanel/js/jquery.spoiler.min.js"></script>
    <script src="/backend/themes/adminpanel/js/select2.min.js"></script>
    <script>
        $('document').ready(function() {

            $(".spoiler").spoiler();

            $(".parent-select").select2({
                placeholder: "Выберите категорию...",
                allowClear: true
            });

            $('#edit-cat-modal').modal({
                show : false
            });

            var _token = $('input[name="_token"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': _token
                }
            });

            $('.create-category').on('click', '.save-button', function (e) {
                e.preventDefault();

                var name = $('input[name="name"]').val();
                var slug = $('input[name="slug"]').val();
                var desc = $('textarea[name="desc"]').val();
                var parent = $('select[name="parent"]').val();

                $.ajax({
                    url: "{{ route('category.create') }}",
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
                        var errors = data.responseJSON;
                        var errorsHtml = "";
                        $.each( errors, function( key, value ) {
                            errorsHtml += "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>"+ value[0] + "</p></div>"; //showing only the first error.
                        });
                        $('.callout').after(errorsHtml);
                    },
                    success: function(data) {
                        $('.callout').after("<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>" + data.msg + "</p></div>");

                        var input = $('.create-category input');
                        $.each(input, function( key, value ) {
                            input.val('');
                        });

                        $('.create-category textarea').val('');

                        var haventCategories = $('.categories-table').find('h4');

                        if(haventCategories)
                            haventCategories.remove();

                        var content = "<div class='pull-right'><i class='fa fa-pencil edit-cat' aria-hidden='true'" +
                        "data-toggle='tooltip' data-placement='top' title='Edit' data-toggle='modal' data-target='#edit-cat-modal'></i>" +
                                " <i class='fa fa-times del-cat' aria-hidden='true' data-toggle='tooltip' data-placement='top' title='Delete'></i></div>";
                        $('.categories-table').append("<div class='spoiler category' data-spoiler-link='" + data.id + "'><b>" + name + "</b>" + content + "</div>");

                    }
                })
                    .always(function() {
                        $('.save-button').button('reset');
                    });

            });

            $('#edit-cat-modal').on('click', '#update-btn', function (e) {
                e.preventDefault();

                var modal = "#edit-cat-modal";
                var form = "#edit-category-form";

                var id = $(form + ' input.cat-id').val();
                var name = $(form + ' input#cat-name-edit').val();
                var slug = $(form + ' input#cat-slug-edit').val();
                var desc = $(form + ' textarea#desc-edit').val();
                var parent = $(form + ' select[name="parent"]').val();

                $.ajax({
                    url: "{{ route('category.update') }}",
                    type: 'POST',
                    dataType: 'json',
                    beforeSend: function() {
                        $('.alert').remove();
                        $('#update-btn').button('loading');
                    },
                    data: {
                        id: id,
                        name: name,
                        slug: slug,
                        desc: desc,
                        parent_id: parent
                    },
                    error: function(data)
                    {
                        var errors = data.responseJSON;
                        var errorsHtml = "";
                        if(data.success != undefined) {
                            errorsHtml += "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>" + errors.msg + "</p></div>"; //showing only the first error.
                        } else {
                            $.each(errors, function (key, value) {
                                errorsHtml += "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>" + value[0] + "</p></div>"; //showing only the first error.
                            });
                        }
                        $(modal + ' .box-body').before(errorsHtml);
                    },
                    success: function(data) {
                        $(modal + ' .box-body').before("<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>" + data.msg + "</p></div>");

                    }
                })
                        .always(function() {
                            $('#update-btn').button('reset');
                        });

            });

            $('.categories-table').on('click', '.del-cat', function (e) {
                e.preventDefault();

                var id = getCategoryID(this);
                var parent = $(this).closest('.category');
                var content = $(this).find('.spoiler-content[data-spoiler-link="'+ id +'"]');

                $.ajax({
                    url: "{{ route('category.delete') }}",
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
                        parent.before(errorsHtml);
                    },
                    success: function(data) {
                        content.remove();
                        parent.remove();

                        var item = $('.categories-table').find('.category');
                        console.log(item);
                        if(item.length == 0) {
                            $('.categories-table').append('<h4>Категорий пока нет.</h4>');
                        }
                    }
                });

            });

            $('.categories-table').on('click', '.edit-cat', function (e) {
                e.preventDefault();

                if(setDataToModal(this)) {
                    var modal = "#edit-cat-modal";
                    var form = "#edit-category-form";
                    var input = $(form + ' input');

                    $.each(input, function(key, value) {
                        input.val('');
                    });

                    $(modal + ' textarea').val('');

                    $('#edit-cat-modal').modal('show');
                } else
                    alert('Oops. Что-то пошло не так...');
            });

            function getCategoryID(obj) {
                return ($(obj).closest('.category').attr('data-spoiler-link'));
            }

            function setDataToModal(obj) {
                var id = getCategoryID(obj);

                $.ajax({
                    url: "{{ route('category.edit') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id,
                    },
                    error: function(data)
                    {
                        console.log(data);
                        var errors = data.responseJSON;
                        alert(errors.msg);
                        return false;
                    },
                    success: function(data) {
                        var editForm = $('#edit-category-form');

                        editForm.find('#cat-name-edit').val(data.name);
                        editForm.find('#cat-slug-edit').val(data.slug);
                        editForm.find('textarea[name="desc"]').val(data.desc);
                        editForm.find('input[name="id"]').val(id);
                    }
                })

                return true;
            }

        });
    </script>
@endsection
