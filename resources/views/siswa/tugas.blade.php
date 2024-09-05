<!-- resources/views/siswa/tugas.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Data Tugas Siswa</h1>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>Gambar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tugas as $no => $tugasItem)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $tugasItem->nis }}</td>
                            <td>{{ $tugasItem->nama }}</td>
                            <td>{{ $tugasItem->kelas }}</td>
                            <td>{{ $tugasItem->jurusan }}</td>
                            <td>
                                @if ($tugasItem->gambar_tugas)
                                    <img src="{{ asset('gambar_tugas/' . $tugasItem->gambar_tugas) }}" alt="Gambar Tugas" width="100">
                                @else
                                    Tidak ada gambar
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada tugas tersedia</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
