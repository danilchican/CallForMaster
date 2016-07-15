@extends('layouts.app')

@section('head')
    <title>ZvoniMasteru.by - Альбомы</title>
@endsection

@section('css')
    <style>
        #myTab {
            margin-bottom: 15px;
        }
        .panel-heading { overflow: hidden; }
    </style>
@endsection

@section('content')
    <div class="container">
        <!-- Nav tabs -->
        <ul id="myTab" class="nav nav-tabs">
            <li class="active"><a href="#albums" data-toggle="tab">{{ !empty($cname = $company->name) ? $cname : 'Без имени' }}</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="albums">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <button type="button" class="btn btn-primary" id="create-album">Создать альбом</button>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    @foreach($albums as $album)
                        <div class="col-md-3 col-sm-3 col-xs-6 main-catalog-box">
                            <img class="img-circle" data-src="holder.js/140x140" alt="140x140" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDAiIGhlaWdodD0iMTQwIj48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjcwIiB5PSI3MCIgc3R5bGU9ImZpbGw6I2FhYTtmb250LXdlaWdodDpib2xkO2ZvbnQtc2l6ZToxMnB4O2ZvbnQtZmFtaWx5OkFyaWFsLEhlbHZldGljYSxzYW5zLXNlcmlmO2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPjE0MHgxNDA8L3RleHQ+PC9zdmc+" style="width: 140px; height: 140px;">
                            <h4><a href="{{ route('albums.view', ['id' => $album->id]) }}">{{ $album->name }}</a></h4>
                        </div><!-- /.col-lg-4 -->
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12">
            @include('account.albums.create')
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $('document').ready(function() {
            $('#create-album').click(function () {
                $('#create-album-modal').modal('show');
            });

            var _token = $('input[name="_token"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': _token
                }
            });

            $('#create-album-modal').on('click', '#create-btn', function (e) {
                e.preventDefault();

                var modal = "#create-album-modal";
                var form = "#create-album-form";

                var name = $(form + ' input[name="name"]').val();
                var desc = $(form + ' textarea[name="desc"]').val();

                $.ajax({
                    url: "{{ route('albums.create') }}",
                    type: 'POST',
                    dataType: 'json',
                    beforeSend: function() {
                        $('.alert').remove();
                        $('#create-btn').button('loading');
                    },
                    data: {
                        name: name,
                        description: desc
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
                        $(form + ' input[name="name"]').val('');
                        $(form + ' textarea[name="desc"]').val('');
                    }
                })
                .always(function() {
                    $('#create-btn').button('reset');
                });

            });


        });
    </script>
@endsection