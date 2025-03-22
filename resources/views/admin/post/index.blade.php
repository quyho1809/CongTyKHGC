@extends('adminlte::page')

@section('title', 'Danh sách bài viết')

@section('content_header')
    <h1>Danh sách bài viết</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Danh sách bài viết</h3>
        </div>
        <div class="card-body">
            <table id="posts-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Mô tả</th>
                        <th>Người tạo</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('adminlte_js')
    <script>
        $(document).ready(function () {
            $('#posts-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.posts.index') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title' },
                    { data: 'description', name: 'description' },
                    { data: 'user', name: 'user' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });

            $(document).on('click', '.delete-post', function () {
                var postId = $(this).data('id');
                if (confirm('Bạn có chắc muốn xóa bài viết này?')) {
                    $.ajax({
                        url: "/admin/posts/" + postId,
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            alert(response.message);
                            $('#posts-table').DataTable().ajax.reload();
                        }
                    });
                }
            });
        });
    </script>
@stop
