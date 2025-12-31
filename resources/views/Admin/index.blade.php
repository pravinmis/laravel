<h2>hello</h2>
@role('employee')
    <h2>Welcome Admin!</h2>
@endrole



@can('create articles')
    <button><a href="/hello">Create Post</a></button>
@endcan
@can('edit articles')
    <button><a href="/hello">Edit Post</a></button>
@endcan
@can('update articles')
    <button><a href="/hello">Update Post</a></button>
@endcan
@can('delete articles')
    <button><a href="/hello">Delete Post</a></button>
@endcan
@can('update articles')
    <button><a href="/hello">Delete Post</a></button>
@endcan
@can('even articles')
    <button><a href="/hello">even articles</a></button>
@endcan
@can('edit employee')
    <button><a href="/hello">even articles</a></button>
@endcan