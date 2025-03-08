@extends('layouts.template')

@section('content')

<form action="{{ route('create.post') }}" method="POST">
    @csrf
    <label for="title" class="form-label">Title</label>
    <input type="text" name="title" class="form-control">

    <label for="description" class="form-label">Description</label>
    <input type="text" class="form-control" name="description">

    <label for="content" class="form-label">Content</label>
    <textarea id="content" name="content"></textarea>

    <label for="publish_date" class="form-label">Publish Date</label>
    <input type="datetime-local" name="publish_date" class="form-control">

    <button type="submit" class="btn btn-primary">Create</button>


</form>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
    $(document).ready(function() {
        $('#content').summernote({
            height: 300,  // Chiều cao của editor
            placeholder: 'Nhập nội dung bài viết...',
            tabsize: 2
        });
    });
</script>



@endsection