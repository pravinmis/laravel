<form action="{{route('store')}}" method="post" enctype="multipart/form-data">

@csrf
<input type="text" name="name" value=""><br>
<input type="text" name="email"  value=""><br>
<input type="text" name="password" ><br>
<select name="course">
<option value="btech">Btech</option>
<option value="bca">BCA</option>
<option value="mtech">Mtech</option>
<option value="mca">MCA</option>

</select>
<input type="file" name="image"><br>
<input type="submit" value="save">


</form>

