@extends('adminlte::page')

@section('title', __('admin.article_create'))

@section('content')
    <section class="content-header">
        <h1>
            {{ __('admin.article_create') }}
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'admin.article.store']) !!}

                        @include('admin.article.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
