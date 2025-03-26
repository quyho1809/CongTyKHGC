@extends('adminlte::page')

@section('title', 'Chỉnh sửa tài khoản')

@section('content_header')
    <h1>Chỉnh sửa tài khoản</h1>
@stop

@section('content')
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Họ</label>
        <input type="text" name="first_name" value="{{ $user->first_name }}" maxlength="30">

        <label>Tên</label>
        <input type="text" name="last_name" value="{{ $user->last_name }}" maxlength="20">

        <label>Địa chỉ</label>
        <input type="text" name="address" value="{{ $user->address }}" maxlength="200">

        <label>Trạng thái</label>
        <select name="status">
            <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Chờ phê duyệt</option>
            <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Hoạt động</option>
            <option value="2" {{ $user->status == 2 ? 'selected' : '' }}>Từ chối</option>
            <option value="3" {{ $user->status == 3 ? 'selected' : '' }}>Bị khóa</option>
        </select>
        

        <button type="submit">Lưu</button>
    </form>
@stop
