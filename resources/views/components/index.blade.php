@extends('layouts.template')

@section('title','Page Home')
    

@section('content')

    <div class="text-center d-flex justify-content-center align-items-center text-warning" style="height: 80vh">
        <h2>Ho Ngoc Qui</h2>
    </div>


    <img src="{{asset('image/hinh_1.jpg')}}" alt="">\
    
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/pagehome.css')}}">
@endsection