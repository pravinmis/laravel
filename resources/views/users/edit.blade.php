<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
@if(session('message'))
 {{Session('message')}}
@endif

@if(session('error'))
{{$error}}
@endif
<div class="container">
  <h2>Vertical (basic) form</h2>
  
<form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
    @csrf
        @method('PUT')
    <div class="form-group">
      <label for="email">Name:</label>
      <input type="text" class="form-control" id="" placeholder="Enter name" name="name" value="{{$user->name}}">
      @error('name')
     {{$message}}
      @enderror
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{$user->email}}">
      @error('email')
     {{$message}}
      @enderror
    </div>
    
    <div class="form-group">
      <label for="pwd">Mobile:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter moblile no" name="mobile" value="{{$user->mobile}}">
       @error('mobile')
     {{$message}}
      @enderror
    </div>
    
    <div class="form-group">
      <label for="pwd">file:</label>

<img src="{{asset('storage/'.$user->profile_pic)}}" width="50px" height="50px">

      <input type="file" class="form-control" id="file" placeholder="Enter File" name="new_profile_pic">
      <input type="hidden" class="form-control" id="file" placeholder="Enter File" name="profile_pic" value="{{$user->profile_pic}}">

       @error('file')
     {{$message}}
      @enderror
    </div>
    <!-- <div class="checkbox">
      <label><input type="checkbox" name="remember"> Remember me</label>
    </div> -->
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

</body>
</html>
