{{-- resources/views/admin/namamapel/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Card Wrapper -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Daftar Materi Pelajaran</h3>
            <button id="btnTambah" class="btn btn-light">Tambah Materi</button>
        </div>
        <div class="card-body">
            <!-- Tampilkan pesan sukses jika ada -->
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses!</strong> {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- Tabel Daftar Materi -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 10%;">No</th>
                            <th style="width: 60%;">Nama Materi</th>
                            <th style="width: 30%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($materi as $index => $m)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $m->nama_mapel }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info btnEdit mr-2" data-id="{{ $m->id_mapel }}" data-nama="{{ $m->nama_mapel }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form action="{{ route('namamapel.destroy', $m->id_mapel) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus materi ini?')">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada materi pelajaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert untuk Tambah dan Edit Materi -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('btnTambah').addEventListener('click', () => {
        Swal.fire({
            title: "Masukkan Nama Materi",
            input: "text",
            inputAttributes: {
                autocapitalize: "off"
            },
            showCancelButton: true,
            confirmButtonText: "Simpan",
            showLoaderOnConfirm: true,
            preConfirm: async (nama_mapel) => {
                if (!nama_mapel) {
                    Swal.showValidationMessage(`Nama Materi tidak boleh kosong!`);
                    return;
                }

                // Simpan data ke server
                try {
                    const response = await fetch("{{ route('namamapel.store') }}", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF Token Laravel
                        },
                        body: JSON.stringify({ nama_mapel })
                    });

                    if (!response.ok) {
                        const errorData = await response.json();
                        throw new Error(errorData.message || "Error saat menyimpan data");
                    }
                    
                    return await response.json();
                } catch (error) {
                    Swal.showValidationMessage(`Terjadi kesalahan: ${error.message}`);
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: `Materi "${result.value.nama_mapel}" berhasil ditambahkan!`,
                    icon: 'success'
                }).then(() => {
                    location.reload(); // Reload halaman untuk menampilkan data terbaru
                });
            }
        });
    });

    // SweetAlert untuk Edit Materi
    document.querySelectorAll('.btnEdit').forEach(button => {
        button.addEventListener('click', () => {
            const idMapel = button.getAttribute('data-id');
            const namaMapel = button.getAttribute('data-nama');

            Swal.fire({
                title: "Edit Nama Materi",
                input: "text",
                inputValue: namaMapel,
                inputAttributes: {
                    autocapitalize: "off"
                },
                showCancelButton: true,
                confirmButtonText: "Simpan",
                showLoaderOnConfirm: true,
                preConfirm: async (nama_mapel) => {
                    nama_mapel = nama_mapel.trim();
                    if (!nama_mapel) {
                        Swal.showValidationMessage(`Nama Materi tidak boleh kosong!`);
                        return;
                    }

                    try {
                        const response = await fetch(`/namamapel/${idMapel}`, {
                            method: "PUT",
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ nama_mapel })
                        });

                        Swal.fire({
                        title: "Berasil di Update",
                        text: "Berhasil di Perbarui",
                        icon: "success"
                    });

                        return await response.json();
                    } catch (success) {
                        return Swal.showValidationMessage();
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: `Materi "${result.value.nama_mapel}" berhasil diupdate!`,
                        icon: 'success'
                    }).then(() => {
                        location.reload(); // Reload halaman untuk menampilkan data terbaru
                    });
                }
            });
        });
    });
</script>

<!-- Font Awesome untuk Ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endsection
