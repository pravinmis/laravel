@extends('layouts/layout')

@section('content')

@if(Session('fail'))
{{Session('fail')}}
@endif

@if(Session('success'))
{{Session('success')}}
@endif
<body>
    @role('admin')
    <h1>Admin Dashboard</h1>
    @endrole
    @role('user')
     <h1>user Dashboard</h1>
    @endrole
    @role('seller')
      <h1>Seller</h1>
    @endrole
    <span id="notification-count" style="display:none;">0</span>

<ul id="notification-list"></ul>




@foreach($user as $u)

<a href="/chat/{{$u->id}}">{{$u->name}}</a>

@endforeach


</body>
@endsection