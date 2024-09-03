@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Siswa</h1>
    <a href="{{ url('admin-create') }}" class="btn btn-primary">Tambah User</a>

    @if(session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>NIS</th>
                <th>Password</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $no=>$item)
                <tr>
                    <td>{{ $no +1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->nis }}</td>
                    <td>{{ $item->plain_password }}</td>
                    <td>{{ $item->role }}</td>
                    <td class="d-flex">
                        <a href="{{ route('edit', $item->id) }}" class="btn btn-primary btn-sm">edit</a>
                        <form action="{{ route('delete', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" style="margin-left: 10px;">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection