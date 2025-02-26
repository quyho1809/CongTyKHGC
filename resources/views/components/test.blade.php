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
@endsection