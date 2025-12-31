@if(session('message'))
{{session('message')}}
@endif
<form action="{{route('updates',$user->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" value="{{$user->name}}" name="name"><br>
    <input type="text" value="{{$user->email}}" name="email"> <br>
     <input type="text" value="{{$user->password}}" name="password"><br> 
     <select name="course">
<option value="btech"  @if($user->course == "btech" ? "selected" : "") @endif>Btech</option>
<option value="bca" @if($user->course == "bca" ? "selected" : "") @endif>BCA</option>
<option value="mtech" @if($user->course == "mtech" ? "selected" : "") @endif>Mtech</option>
<option value="mca"  @if($user->course == "mca" ? "selected" : "")@endif>MCA</option>

</select>
     <img src="{{asset('public/uploads/'.$user->image)}}"><br>
     <input type="hidden" value="{{$user->image}}" name="image"> 
     <input type="file" value="" name="new_image"> <br>
     <input type="submit" value="save">
</form>