<!-- resources/views/materi/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Materi</h1>
    
    <!-- Tombol Edit Materi -->
    <button id="btnEdit" class="btn btn-primary">Edit Materi</button>

    <!-- SweetAlert untuk Edit Materi -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('btnEdit').addEventListener('click', () => {
            Swal.fire({
                title: "Edit Nama Materi",
                input: "text",
                inputValue: "{{ $materi->nama_mapel }}", // Pre-fill dengan data materi yang ada
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
                        const response = await fetch("{{ route('namamapel.update', $materi->id_mapel) }}", {
                            method: "PUT", // Pastikan metode ini sesuai dengan route
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ nama_mapel })
                        });
                        Swal.fire({
                        title: "Berasil di Update",
                        text: "Berhasil di Hapus",
                        icon: "success"
                        });

                        return await response.json();
                    } catch (error) {
                        return Swal.showValidationMessage(`Terjadi kesalahan: ${errorData.message}`);
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
             })//.then((result) => {
            //     if (result.isConfirmed) {
            //         Swal.fire({
            //             title: `Materi "${result.value.nama_mapel}" berhasil diupdate!`,
            //             icon: 'success',
            //             confirmButtonText: 'OK'
            //         }).then(() => {
            //             window.location.href = "{{ route('namamapel.index') }}"; // Redirect ke daftar materi
            //         });
            //     }
            // });
        });
    </script>
</div>
@endsection
