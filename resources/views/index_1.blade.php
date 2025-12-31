@if(session('message'))
{{session('message')}}
@endif


<table>
<tr>
    <td>name</td>
    <td>email</td>
    <td>password</td>
    <td>Image</td>
    <td>Action</td>
</tr>

    @foreach($user as $u)
    <tr>
    <td>{{$u->name}}</td><br>
    <td>{{$u->email}}</td><br>
    <td>{{$u->password}}</td><br>
    <td><img src="{{asset('uploads/'.$u->image)}}" width="60px" height="60px"></td><br>
     <td><button><a href="edit/{{$u->id}}">update</a></button></td>
     </tr>
    @endforeach


</table>