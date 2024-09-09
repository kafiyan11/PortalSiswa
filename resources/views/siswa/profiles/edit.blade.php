@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Profile</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('profiles.update', Auth::user()->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" readonly>
                </div>

                <div class="form-group">
                    <label for="nis">NIS</label>
                    <input type="text" name="nis" class="form-control" value="{{ Auth::user()->nis }}" readonly>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="{{ Auth::user()->alamat }}">
                </div>

                <div class="form-group">
                    <label for="nohp">No HP</label>
                    <input type="text" name="nohp" class="form-control" value="{{ Auth::user()->nohp }}">
                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>
</div>
@endsection
