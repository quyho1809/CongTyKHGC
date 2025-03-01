@extends('layouts.template')

@section('content')
<form action="{{ route('logon') }}" method="post">
    @csrf

    <label for="">Email</label>
    <input name="email" type="email" required>

    <label for="">Password</label>
    <input name="password" type="password" required>

 
    
    <button type="submit">Log in</button>
   
    @if(session('error'))
    <div class="alert alert-danger">
        <script>
            alert("{{section('error')}}")
        </script>    
    </div>
@endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
@endsection
