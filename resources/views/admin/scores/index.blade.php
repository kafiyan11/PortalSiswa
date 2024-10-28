@extends('layouts.app')

@section('content')
<head>
    <title>Nilai Siswa | Portal Siswa</title>

    <!-- Library SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Library Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    
    <!-- Library Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        .btn-custom {
            margin-right: 5px;
        }
        .search-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>

<div class="container mt-4" style="max-width: 1000px;">
    <h2 class="text-center">Nilai Siswa</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <!-- Pencarian dan Tombol Tambah Nilai -->
            <div class="d-flex justify-content-between align-items-center mb-3 search-container">
                <form action="" method="GET" class="input-group" style="max-width: 400px;">
                    <input type="text" name="cari" class="form-control search-input" placeholder="Cari siswa..." value="{{ request()->get('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary search-btn" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                <a href="{{ route('admin.scores.create') }}" class="btn btn-success btn-custom">
                    <i class="fas fa-plus"></i> Tambah Nilai
                </a>
            </div>

            <!-- Notifikasi SweetAlert2 -->
            @if(session('success'))
                <script>
                    Swal.fire({
                        title: "Kerja Bagus!",
                        text: "{{ session('success') }}",
                        icon: "success"
                    });
                </script>
            @endif

            <!-- Tabel Nilai Siswa -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Mata Pelajaran</th>
                            <th>UH</th>
                            <th>UTS</th>
                            <th>UAS</th>
                            <th>Total Nilai</th>
                            <th>Rata-rata</th>
                            <th>Peringkat</th>
                            <th style="width: 150px;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($scores as $score)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $score->nama }}</td>
                            <td>{{ $score->nis }}</td>
                            <td>{{ optional($score->mapel)->nama_mapel ?? '' }}</td>
                            <td>{{ $score->daily_test_score }}</td>
                            <td>{{ $score->midterm_test_score }}</td>
                            <td>{{ $score->final_test_score }}</td>
                            <td>{{ $score->total_score }}</td>
                            <td>{{ number_format($score->average_score, 2) }}</td>
                            <td>{{ $score->rank }}</td>
                            <td class="text-center">
                                <div class="d-inline-flex align-items-center">
                                    <a href="{{ route('admin.scores.edit', $score->id) }}" class="btn btn-warning btn-sm mr-1 btn-custom">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm btn-custom" onclick="confirmDelete('{{ $score->id }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $score->id }}" action="{{ route('admin.scores.destroy', $score->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {{ $scores->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Nilai Rata-Rata Siswa -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="text-center">Grafik Nilai Rata-Rata Siswa</h5>
            <canvas id="averageScoreChart"></canvas>
        </div>
    </div>
</div>

<script>
    // Fungsi konfirmasi hapus dengan SweetAlert2
    function confirmDelete(id) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data ini akan dihapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    // Inisialisasi Chart.js untuk Grafik Nilai Rata-Rata Siswa dalam bentuk garis
    document.addEventListener("DOMContentLoaded", function () {
        const labels = {!! json_encode($scores->pluck('nama')->toArray()) !!}; // Nama siswa
        const data = {!! json_encode($scores->pluck('average_score')->toArray()) !!}; // Nilai rata-rata siswa

        const ctx = document.getElementById('averageScoreChart').getContext('2d');
        new Chart(ctx, {
            type: 'line', // Jenis grafik (line chart)
            data: {
                labels: labels,
                datasets: [{
                    label: 'Nilai Rata-Rata',
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    fill: true, // Isi di bawah garis
                    tension: 0.4 // Memberikan efek lengkung pada garis
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Nilai'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });
    });
</script>
@endsection
