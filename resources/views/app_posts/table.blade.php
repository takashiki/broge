<table class="table table-responsive" id="appPosts-table">
    <thead>
        <th>Title</th>
        <th>{{ __('models/article.title') }}</th>
        <th>{{ __('models/article.time') }}</th>
        <th colspan="3"></th>
    </thead>
    <tbody>
    @foreach($appPosts as $appPosts)
        <tr>
            <td>{!! $appPosts->title !!}</td>
            <td>
                {!! Form::open(['route' => ['appPosts.destroy', $appPosts->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('appPosts.show', [$appPosts->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('appPosts.edit', [$appPosts->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>