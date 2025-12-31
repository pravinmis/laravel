@extends('layouts/layout')
@section('title','home page')
@section('content')

@if(Session('message'))

{{ Session('message') }}

@endif

<table>
<tr>
    <th></th>
    <th></th>
</tr>
<tr>
    <td></td>
    <td><button type="button" data-id="{{}}">delete</button></td>
</tr>
</table>
<script>
    let a = [1,2,3];
   
    console.log(a[3]);

   </script>

@endsection