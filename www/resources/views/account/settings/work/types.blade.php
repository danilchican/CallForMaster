@extends('layouts.app')

@section('head')
    <title>ZvoniMasteru.by - Виды работ</title>
@endsection

@section('css')
    <style>
        #myTab { margin-bottom: 15px; }
        .save-block { margin: 15px 0; }
        .panel-heading { overflow: hidden; }

        .del-album { cursor: pointer; }

        .category {
            padding: 5px 12px;
            margin: 3px 10px 3px 0;
            border-radius: 2px;
            cursor: pointer;
            border: 1px solid #d2d6de;
        }
        .spoiler-active + .spoiler-content-visible  {
            padding: 5px 12px;
            margin: 5px 10px 10px 20px;
            border-radius: 2px;
            border: 1px solid #d2d6de;
            display: block;
        }
        .spoiler-content {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <!-- Nav tabs -->
        <ul id="myTab" class="nav nav-tabs">
            <li class="active"><a href="#categories" data-toggle="tab">{{ !empty($cname = Auth::user()->company->name) ? $cname : 'Без имени' }}</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="categories">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        @if(count($categories) < 1)
                            <h4>Категорий пока нет.</h4>
                        @else
                            @foreach ($categories as $category)
                                <div class="@if($count = $category->getDescendantCount() > 0)spoiler @endif category" data-spoiler-link="{{ $category->id }}">
                                    <b><input type="checkbox"> {{ $category->name }}</b>
                                    @if($count > 0)
                                        <div class="pull-right">
                                            <i class="fa fa-plus left-ico" aria-hidden="true"></i>
                                        </div>
                                    @endif
                                </div>
                                @if($count > 0)
                                    <div class="spoiler-content" data-spoiler-link="{{ $category->id }}">
                                        @foreach ($category->children as $category)
                                            <div class="row">
                                                <div class="category-item col-md-12">
                                                    <input type="checkbox" name="cat-id" value="{{ $category->id }}"> {{  $category->name }}
                                                    @if($count > 0)
                                                        <div class="row">
                                                            <div class="category-item col-md-12">
                                                                @foreach ($category->children as $category)
                                                                    <div class="category-item col-md-12">
                                                                        <input type="checkbox" name="cat-id" value="{{ $category->id }}"> {{  $category->name }}
                                                                        @if($count > 0)
                                                                            <div class="row">
                                                                                <div class="category-item col-md-12">
                                                                                    @foreach ($category->children as $child)
                                                                                        @include('account.settings.work.typeview', ['category' => $child, 'dep' => $dep.'-'])
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 save-block">
                        <button type="submit" class="btn btn-success save-button">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/backend/themes/adminpanel/js/jquery.spoiler.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".spoiler").spoiler();
        });
    </script>
@endsection