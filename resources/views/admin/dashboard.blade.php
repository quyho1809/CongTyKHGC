@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
    <h1>Quản lý hệ thống</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Quản lý bài viết</a>
        </div>
        <div class="col-lg-6">
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Quản lý tài khoản</a>
        </div>
    </div>
@stop