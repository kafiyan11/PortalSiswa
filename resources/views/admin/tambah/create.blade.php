@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Data</h1>
    <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
                <div class="mb-3">
            <label for="nis" class="form-label">NIS</label>
            <input type="text" class="form-control" id="nis" name="nis" required>
        </div>
        <div class="mb-3">
            <label for="class" class="form-label">Password</label>
            <input type="text" class="form-control" id="class" name="password" required>
        </div>
        <div class="mb-3">
            <label for="major" class="form-label">Role</label>
            <input type="text" class="form-control" id="role" name="role" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
