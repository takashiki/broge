<!-- Title Field -->
<div class="form-group col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

@include('editor::head')
<div class="form-group col-sm-12 editor">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'content-editor']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('tags', 'Tags:') !!}
    {!! Form::text('tags', null, ['class' => 'form-control', 'id' => 'article-tags']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.article.index') !!}" class="btn btn-default">Cancel</a>
</div>

@push('js')
<script src="https://cdn.bootcss.com/selectize.js/0.12.4/js/standalone/selectize.min.js"></script>
<link href="https://cdn.bootcss.com/selectize.js/0.12.4/css/selectize.bootstrap3.min.css" rel="stylesheet">
<script>
  $(function() {
    $('#article-tags').selectize({
        create: true
    });
  });
</script>
@endpush