@extends('adminlte::page')

@section('title', 'Quản lý tài khoản')

@section('content_header')
    <h1>Quản lý tài khoản</h1>
@stop

@section('content')
    <form method="GET" action="{{ route('admin.users.index') }}">
        <input type="text" name="search" placeholder="Tìm kiếm theo tên hoặc email" value="{{ request('search') }}">
        <button type="submit">Tìm kiếm</button>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Họ & Tên</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->address }}</td>
                    <td>
                        @php
                            $statusText = '';
                            $statusClass = '';
                    
                            switch ($user->status) {
                                case 0:
                                    $statusText = 'Chờ phê duyệt';
                                    $statusClass = 'badge-warning';
                                    break;
                                case 1:
                                    $statusText = 'Hoạt động';
                                    $statusClass = 'badge-success';
                                    break;
                                case 2:
                                    $statusText = 'Từ chối';
                                    $statusClass = 'badge-secondary';
                                    break;
                                case 3:
                                    $statusText = 'Bị khóa';
                                    $statusClass = 'badge-danger';
                                    break;
                            }
                        @endphp
                    
                        <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                    </td>
                    
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Sửa
                        </a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Xóa
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
@stop
