@extends('layouts.template')

@section('title','Trang Test')

@section('css')
    <link rel="stylesheet" href="{{asset('css/test.css')}}">
    
@endsection

@section('content')
    
    <h3 class="text-center mt-5">
        Name
    </h3>

    <p>======= Goi ======</p>

    <h3>{{$name_1}}</h3>


    <p>{{$user->Name}}</p>


    <form action="/URL" method="post">
        @csrf
        <label for="">Ten Dang Nhap</label>
        <input name="tendangnhap" type="text">

        <label for="">Mat Khau</label>
        <input name="password" type="text">

      <button type="submit">Gui</button>
    
    </form>
@endsection