@can('view', $data)
    <a class="btn btn-xs btn-info" href="{{ route('users.show', $data->id) }}">
        <i class="fa fa-eye"></i>
    </a>
@endcan

@can('update', $data)
    <a class="btn btn-xs btn-primary" href="{{ route('users.edit', $data->id) }}">
        <i class="fa fa-edit"></i>
    </a>
@endcan

@can('view', $data)
    <a href="javascript:void(0)" class="btn btn-xs btn-secondary email-send" data-email={{ $data->email }}>
        <i class="fa fa-envelope"></i>
    </a>
@endcan

@can('delete', $data)
    <a href="javascript:void(0)" class="btn btn-xs btn-danger delete-action">
        <i class="fas fa-trash-alt"></i>
    </a>
    {{ Form::open(['url' => route('users.destroy', $data->id), 'method' => 'delete']) }}
        @csrf
    {{ Form::close() }}
@endcan
