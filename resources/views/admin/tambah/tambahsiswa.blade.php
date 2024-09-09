@extends('layouts.app')

@section('content')
<div class="container ml-40 custom-margin"> <!-- Menambahkan kelas shift-left -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">Daftar Siswa</h1>
        <a href="{{ url('admin-create') }}" class="btn btn-success btn-lg shadow-sm">
            <i class="fas fa-user-plus"></i> Tambah User
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive shadow-sm">
        <table class="table table-hover table-bordered align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $no => $item)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->nis }}</td>
                        <td>{{ $item->plain_password }}</td>
                        <td>
                            <span class="badge 
                                @if($item->role == 'Admin') bg-success
                                @elseif($item->role == 'Siswa') bg-primary
                                @elseif($item->role == 'Guru') bg-info
                                @elseif($item->role == 'Orang Tua') bg-warning
                                @endif">
                                {{ ucfirst($item->role) }}
                            </span>
                        </td>
                        <td class="d-flex justify-content-center">
                            <a href="{{ route('edit', $item->id) }}" class="btn btn-sm btn-warning me-2">
                                <i class="fas fa-edit"></i> Edit
                            </a>&nbsp;&nbsp;
                            <form action="{{ route('delete', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
