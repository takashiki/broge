@extends('adminlte::page')

@section('title', __('admin.article_management'))

@section('content')
    <section class="content-header">
        <h1 class="pull-left">{{ __('admin.article_management') }}</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('admin.article.create') !!}">{{ __('admin.add_new') }}</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('admin.article.table')
            </div>
        </div>
    </div>
@stop
