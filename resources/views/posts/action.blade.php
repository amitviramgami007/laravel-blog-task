@if(auth()->user()->role == "Admin")
<a class="btn btn-xs btn-info" href="{{ route('posts.show', $id) }}">
    <i class="fa fa-eye"></i>
</a>
@endif

<a class="btn btn-xs btn-primary" href="{{ route('posts.edit', $id) }}">
    <i class="fa fa-edit"></i>
</a>

<a href="#" class="btn btn-xs btn-danger delete-action">
    <i class="fas fa-trash-alt"></i>
</a>
{{ Form::open(['url' => route('posts.destroy', $id), 'method' => 'delete']) }}
    @csrf
{{ Form::close() }}
