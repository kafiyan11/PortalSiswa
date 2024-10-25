@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-primary">Edit Data Orang Tua</h1>
    
    <!-- Alert Section -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Terjadi kesalahan:
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card p-4 shadow-sm">
        <form action="{{ route('update.ortu', $parent->id) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Nama Orang Tua -->
            <div class="mb-3">
                <label for="name" class="form-label">Nama Orang Tua</label>
                <input 
                    type="text" 
                    class="form-control @error('name') is-invalid @enderror" 
                    id="name" 
                    name="name" 
                    placeholder="Masukkan nama orang tua" 
                    value="{{ old('name', $parent->name) }}" 
                    required
                >
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- NIS -->
            <div class="mb-3">
                <label for="nis" class="form-label">NIS</label>
                <input 
                    type="text" 
                    class="form-control @error('nis') is-invalid @enderror" 
                    id="nis" 
                    name="nis" 
                    placeholder="Masukkan NIS orang tua" 
                    value="{{ old('nis', $parent->nis) }}" 
                    required
                >
                @error('nis')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Password (Opsional) -->
            <div class="mb-3">
                <label for="password" class="form-label">Password (Opsional)</label>
                <input 
                    type="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    id="password" 
                    name="password" 
                    placeholder="Masukkan password baru jika ingin mengganti"
                >
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Konfirmasi Password (Opsional) -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input 
                    type="password" 
                    class="form-control @error('password_confirmation') is-invalid @enderror" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    placeholder="Konfirmasi password baru jika ingin mengganti"
                >
                @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Dropdown Siswa -->
            <div class="mb-3">
                <label for="students" class="form-label">Siswa Terkait</label>
                <select 
                    class="form-select @error('students') is-invalid @enderror" 
                    id="students" 
                    name="students[]" 
                    multiple
                >
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" {{ in_array($student->id, old('students', $assignedStudents ?? [])) ? 'selected' : '' }}>
                            {{ $student->name }} ({{ $student->nis }})
                        </option>
                    @endforeach
                </select>
                @error('students')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <small class="form-text text-muted">Hold down the Ctrl (Windows) or Command (Mac) button to select multiple options.</small>
            </div>

            <!-- Tombol Submit dan Kembali -->
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('ortu') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
