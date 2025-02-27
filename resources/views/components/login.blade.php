@extends('layouts.template')

@section('content')
    
<form action="{{ route('login') }}" method="post">
    @csrf
    <label for="">Ten Dang Nhap</label>
    <input name="login"type="text">

    <label for="">Mat Khau</label>
    <input name="password" type="password">

    <label for="">Email</label>
    <input name="email" type="email" >
    
    <button type="submit">Send</button>
   

</form>

@endsection