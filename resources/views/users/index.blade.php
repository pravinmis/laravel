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

<div class="container">
  <h2>Bordered Table</h2>
           
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>name</th>
        
        <th>Email</th>

        <th>mobile</th>
        <th > image</th>
        <th>action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($user as $u)
      <tr>
        <td>{{$u->name}}</td>
        <td>{{$u->email}}</td>
        <td>{{$u->mobile}}</td>
      <td></td>
        <td><button><a href="/users/{{$u->id}}/edit">edit</a></button>  <form action="{{ route('users.destroy', $u->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
      </tr>

      @endforeach
      >
    </tbody>
  </table>
</div>

</body>
</html>
