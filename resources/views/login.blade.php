@extends('layouts/layout')

@section('content')

@if(Session('errs'))

{{Session('errs')}}

@endif

<body>
 <input type="text" class="form-control" id="search" placeholder="" name="search">

 <div id="hello"></div>
 <div id="pagin"></div>
<div class="container">
  <h2>Inline form</h2>


   <!-- <input type="button" id="btns" class="btn btn-default">Login</button> -->
  <button type="button" id="btns" class="btn btn-default">Login</button>
<input type="text" id="test">


  <form class="form-inline" action="{{route('login')}}" method="post" enctype="multipart/form-data" >
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




<script>
function fetchUsers(search = '') {
    $.ajax({
        url: "{{ route('homes') }}",
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        data: { search: search },
        success: function(response) {

            let user = response.user;   // important
            let limit = 2;

            function renderPage(pageNo = 1) {
                let offset = (pageNo - 1) * limit;

                let html = `<table border="1">
                    <tr><th>Name</th><th>Email</th></tr>`;

                if (user.length > 0) {

                    for (let i = offset; i < offset + limit && i < user.length; i++) {
                        html += `<tr><td>${user[i].name}</td><td>${user[i].email}</td></tr>`;
                    }

                } else {
                    html += `<tr><td colspan="2">No records found</td></tr>`;
                }

                html += `</table>`;
                document.getElementById('hello').innerHTML = html;

                // Pagination buttons
                let totalPages = Math.ceil(user.length / limit);
                let pageBtns = "";

                for (let p = 1; p <= totalPages; p++) {
                   // pageBtns += "<button class='pagination-btn' data-id='" + p + "'>"+ p +"</button>";
                  
                    pageBtns += `<button class="pagination-btn" data-id="${p}">${p}</button>`;
                }

                document.getElementById('pagin').innerHTML = pageBtns;
            }

            // default load page 1
            renderPage(1);

            // Pagination button click event (delegation)
            document.getElementById('pagin').addEventListener('click', function(e) {
                if (e.target.classList.contains('pagination-btn')) {
                    let pageNo = e.target.getAttribute('data-id');
                    renderPage(pageNo);
                }
            });
        },

        error: function(xhr) {
            console.log("Error:", xhr.responseText);
        }
    });
}

// Page load → all users
document.addEventListener('DOMContentLoaded', function() {
    fetchUsers();
});

// Search input
document.addEventListener('input', function () {
    let search = document.getElementById('search').value;
    fetchUsers(search);
});
</script>

</body>
</html>
