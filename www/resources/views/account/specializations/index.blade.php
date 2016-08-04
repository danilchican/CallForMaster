@extends('layouts.app')

@section('head')
    <title>ZvoniMasteru.by - Альбомы</title>
@endsection

@section('css')
    <style>
        #myTab { margin-bottom: 15px; }
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
            <div class="tab-pane fade in active" id="specializations">
                {!! Form::open(array('id' => 'selection-specials-form')) !!}
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h2>Виды специальностей:</h2>
                    @if(count($specializations) < 1)
                        <h4>Специальностей пока нет.</h4>
                    @else
                    <ul>
                        @foreach ($specializations->chunk(3) as $specialization)
                            <div class="col-xs-4">
                                @foreach ($specialization as $special)
                                    <li>
                                        {{ Form::checkbox('specializations[]', $special->id, $special->companies->contains($company->id) ? true : false) }}
                                        {{ $special->name }}
                                    </li>
                                @endforeach
                            </div>
                        @endforeach

                    </ul>
                    @endif
                </div>
                @if(count($specializations) > 1)
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <br/>
                    <button type="button" class="btn btn-primary" id="save-specials">Сохранить изменения</button>
                </div>
                @endif
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('document').ready(function() {

            var _token = $('input[name="_token"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': _token
                }
            });

            $('#specializations').on('click', '#save-specials', function (e) {
                e.preventDefault();

                var specials = [];

                $('input:checkbox[name="specializations[]"]:checked').each(function(){
                    specials.push($(this).val());
                });

                $.ajax({
                    url: "{{ route('update.specials') }}",
                    type: 'POST',
                    dataType: 'json',
                    beforeSend: function() {
                        $('.alert').remove();
                        $('#save-specials').button('loading');
                    },
                    data: {
                        specials: specials
                    },
                    error: function(data)
                    {
                        var errors = data.responseJSON;
                        var errorsHtml = "";
                        $.each( errors, function( key, value ) {
                            errorsHtml += "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>"+ value[0] + "</p></div>"; //showing only the first error.
                        });
                        $('#specializations').before(errorsHtml);
                    },
                    success: function(data) {
                        $('#specializations').before("<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p>" + data.msg + "</p></div>");
                    }
                })
                        .always(function() {
                            $('#save-specials').button('reset');
                        });

            });

        });
    </script>
@endsection