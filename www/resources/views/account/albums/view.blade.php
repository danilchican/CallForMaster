@extends('layouts.app')

@section('head')
    <title>ZvoniMasteru.by - Альбомы</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="/backend/themes/default/css/lightbox/lightbox.css">
    <link rel="stylesheet" type="text/css" href="/backend/themes/default/css/dropzone/dropzone.min.css">
    <style>
        #myTab { margin-bottom: 15px; }
        .panel-heading { overflow: hidden; }
        .del-photo { cursor: pointer; }
        #album-images { margin: 0; padding: 0; }

        #album-images li {
            margin: 0;
            padding: 0;
            list-style: none;
            float: left;
            padding-right: 10px;
        }

        #album-images img {
            width: 240px;
            height: 160px;
            border: 2px solid black;
            margin-bottom: 10px;
        }
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
                    <h2>{{ $album->title }}</h2>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul id="album-images">
                            @if(count($album->photos) > 0)
                                @foreach($album->photos as $photo)
                                    <li class="photo-item">
                                        <div class="col-md-3 col-sm-3 col-xs-6 photo-box">
                                            <i class="fa fa-times del-photo" photo-id="{{ $photo->id }}"></i>
                                            <a data-lightbox="roadtrip" href="/{{ $photo->image_url }}">
                                                <img alt="{{ $photo->title }}" src="/{{ $photo->image_url }}" style="width: 140px; height: 140px;">
                                            </a>
                                        </div><!-- /.col-lg-4 -->
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open(['url' => 'photo/upload', 'class' => 'dropzone', 'id' => 'addImages']) !!}
                        {!! Form::input('hidden', 'album_id', $album->id) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="/backend/themes/default/js/dropzone/dropzone.js"></script>
    <script type="text/javascript" src="/backend/themes/default/js/dropzone/dropzone-check.js"></script>
    <script type="text/javascript" src="/backend/themes/default/js/lightbox/lightbox-plus-jquery.min.js"></script>

    <script>
        $('document').ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                }
            });

            $('.photo-item').on('click', '.del-photo', function (e) {
                var parent = $(this).closest('li');
                var id = $(this).attr('photo-id');

                $.ajax({
                    url: "{{ route('photo.delete') }}",
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
                        alert(data.message);
                        parent.remove();
                    }
                });
            });

        });
    </script>
@endsection