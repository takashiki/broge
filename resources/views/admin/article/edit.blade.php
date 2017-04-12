@extends('adminlte::page')

@section('title', __('admin.article_update'))

@section('content')
    <section class="content-header">
        <h1>
            {{ __('admin.article_update') }}
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::model($article, ['route' => ['admin.article.update', $article->id], 'method' => 'patch']) !!}

                    @include('admin.article.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection