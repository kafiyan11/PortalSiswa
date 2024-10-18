<head>
    <title>Materi Pelajaran | Portal Siswa</title>
</head>@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-body p-4">
                    <!-- Flex Container for Title and Search Form -->
                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                        <h1 class="mb-3 mb-md-0">Materi Pelajaran</h1>
                        <!-- Formulir Pencarian -->
                        <form action="{{ route('siswa.lihatmateri', $id_mapel ?? '') }}" method="GET" class="ms-md-3" style="max-width: 400px; width: 100%;">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari materi berdasarkan judul..." value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                            </div>
                        </form>
                    </div>
                    <hr>

                    @if($materi->isEmpty())
                        @if(request('search'))
                            <!-- Pesan jika pencarian tidak menemukan hasil -->
                            <div class="alert alert-warning text-center mb-0 border">
                                <i class="fas fa-exclamation-triangle fa-2x mb-3 text-warning"></i>
                                <p class="mb-0 text-warning">Materi Tidak Ditemukan.</p>
                            </div>
                        @else
                            <!-- Pesan jika tidak ada materi sama sekali -->
                            <div class="alert alert-light text-center mb-0 border">
                                <i class="fas fa-book-open fa-2x mb-3 text-muted"></i>
                                <p class="mb-0 text-muted">Belum ada materi untuk kelas ini.</p>
                            </div>
                        @endif
                    @else                        
                        <div class="table-responsive">
                            <table class="table table-hover align-middle table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">No</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col" class="text-center">Materi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($materi as $index => $item)
                                        <tr>
                                            <!-- Menyesuaikan nomor urut dengan paginasi -->
                                            <th scope="row" class="text-center">{{ $materi->firstItem() + $index }}</th>
                                            <td>{{ $item->judul }}</td>
                                            <td class="text-center">
                                                @if($item->tipe == 'gambar')
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ asset('storage/' . $item->gambar) }}" target="_blank" class="btn btn-outline-dark btn-sm">
                                                            <i class="fas fa-eye me-1"></i> Lihat
                                                        </a>
                                                        <a href="{{ asset('storage/' . $item->gambar) }}" download class="btn btn-outline-dark btn-sm">
                                                            <i class="fas fa-download me-1"></i> Unduh
                                                        </a>
                                                    </div>
                                                @else
                                                    <a href="{{ $item->link_youtube }}" target="_blank" class="btn btn-outline-dark btn-sm">
                                                        <i class="fab fa-youtube me-1"></i> Tonton Video
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Tautan Paginasi -->
                        <div class=" justify-content-start mt-4">
                            <p class="text-muted mb-3">Menampilkan {{ $materi->count() }} dari {{ $materi->total() }} materi.</p>
                            {{ $materi->appends(['search' => request('search')])->links() }}
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('siswa.coba') }}" class="btn btn-dark">
                                <i class="fas fa-arrow-left me-2"></i> Kembali
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Helvetica Neue', Arial, sans-serif;
        color: #333;
    }

    .card {
        transition: box-shadow 0.3s ease, transform 0.2s ease;
        border: none;
        background-color: #fff;
        padding: 0;
    }

    .card:hover {
        box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.05);
        transform: translateY(-5px);
    }

    .table {
        margin-bottom: 0;
    }

    .table th, .table td {
        padding: 1rem;
        border-color: #f0f0f0;
    }

    .table thead th {
        border-top: none;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        color: #666;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.05);
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.1);
    }

    .btn-sm {
        padding: 0.4rem 0.8rem;
        font-size: 0.875rem;
        border-radius: 0.25rem;
        transition: all 0.2s ease;
    }

    .btn-sm:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .alert-light {
        background-color: #f8f9fa;
        border-color: #e9ecef;
    }

    .alert-warning {
        background-color: #fff3cd;
        border-color: #ffeeba;
    }

    .btn-group .btn {
        border-radius: 0;
    }

    .btn-group .btn:first-child {
        border-top-left-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
    }

    .btn-group .btn:last-child {
        border-top-right-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const table = document.querySelector('.table');
        if (table) {
            table.querySelectorAll('tbody tr').forEach((row, index) => {
                row.style.transition = `opacity 0.3s ease ${index * 0.05}s, transform 0.3s ease ${index * 0.05}s`;
                row.style.opacity = '0';
                row.style.transform = 'translateY(10px)';
                setTimeout(() => {
                    row.style.opacity = '1';
                    row.style.transform = 'translateY(0)';
                }, 100);
            });
        }
    });
</script>
@endpush
