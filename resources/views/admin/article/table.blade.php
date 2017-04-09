<table class="table table-responsive" id="article-table">
    <thead>
    <th>{{ __('models/article.title') }}</th>
    <th>{{ __('models/article.time') }}</th>
    <th colspan="2"></th>
    </thead>
    <tbody>
    @foreach($articles as $article)
        <tr>
            <td>{!! $article->title !!}</td>
            <td>{!! $article->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.article.destroy', $article->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.article.edit', [$article->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>