@extends('layouts/layout')

@section('content')

@if(Session('fail'))

{{Session('fail')}}

@endif
@if(Session('success'))

{{Session('success')}}

@endif

<body>


 
<h2>seller login</h2>

  <form class="form-inline" action="{{route('seller.login')}}" method="post" enctype="multipart/form-data" >
  <!-- <form id="register_form"> -->
    @csrf
     <div class="form-group">
      <label for="email">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
      @error('name')
<div>{{ $message }}</div>
@enderror
    </div>

    <div class="form-group">
      <label for="email">Email:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
      @error('email')
<div>{{ $message }}</div>
@enderror
    </div>

    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="text" class="form-control" id="password" placeholder="Enter password" name="password">
       @error('password') <span class="text-danger" style="color:red;">{{ $message }}</span> @enderror
    </div>

    <div class="checkbox">
      <label><input type="file" name="image"  id="image" multiple> </label>
      @error('image')
<div>{{ $message }}</div>
@enderror
    </div>

    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

@endsection


</body>
</html>
