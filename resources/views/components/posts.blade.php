@extends('layouts.template')

@section('content')
    <h2>Danh sách bài viết của bạn</h2>
    <a href="{{ route('show.create.post') }}" class="btn btn-primary">Tạo mới bài viết</a>

    <!-- Form xóa tất cả bài viết -->
    <form action="{{ route('posts.destroy.all') }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa tất cả bài viết không?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            <i class="fa fa-trash"></i> Xóa tất cả
        </button>
    </form>

    <!-- Flash Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Tiêu đề</th>
                <th>Mô tả</th>
                <th>Ngày đăng</th>
                <th>Trạng thái</th>
                <th>Ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->description }}</td>
                    <td>{{ $post->publish_date }}</td>
                    <td>{{ $post->status == 1 ? 'Đã cập nhật' : 'Chờ duyệt' }}</td>
                    <td><img src="{{ $post->thumbnail }}" alt="Thumbnail" width="100"></td>
                    <td>
                        <!-- Nút Edit -->
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i>
                        </a>

                        <!-- Nút Show -->
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info btn-sm">
                            <i class="fa fa-eye"></i>
                        </a>

                        <!-- Nút Delete -->
                        <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $post->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $posts->links() }}

    <!-- Modal Xóa Bài Viết -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa bài viết này không?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let deleteModal = document.getElementById("deleteModal");
        let deleteForm = document.getElementById("deleteForm");

        document.querySelectorAll(".btn-delete").forEach(button => {
            button.addEventListener("click", function () {
                let postId = this.getAttribute("data-id");
                deleteForm.action = `/posts/${postId}`; // Cập nhật action của form
            });
        });
    });
</script>
@endsection
