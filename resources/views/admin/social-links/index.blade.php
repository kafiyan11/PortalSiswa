<!-- resources/views/social-links/index.blade.php -->

@extends('layouts.app') <!-- Pastikan Anda memiliki layout utama -->

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Card untuk Social Links -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Tautan Media Sosial Kami</h4>
                    <a href="{{ route('social-links.edit') }}" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-pencil-square"></i> Edit Tautan
                    </a>
                </div>
                <div class="card-body">
                    <!-- Table untuk Menampilkan Tautan Media Sosial -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Platform</th>
                                    <th scope="col">Tautan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Twitter -->
                                <tr>
                                    <td>
                                        <i class="bi bi-twitter" style="color: #1DA1F2;"></i> Twitter
                                    </td>
                                    <td>
                                        @if($socialLinks->twitter)
                                            <a href="{{ $socialLinks->twitter }}" target="_blank">{{ $socialLinks->twitter }}</a>
                                        @else
                                            <span class="text-muted">Tidak tersedia</span>
                                        @endif
                                    </td>

                                </tr>
                                <!-- Facebook -->
                                <tr>
                                    <td>
                                        <i class="bi bi-facebook" style="color: #1877F2;"></i> Facebook
                                    </td>
                                    <td>
                                        @if($socialLinks->facebook)
                                            <a href="{{ $socialLinks->facebook }}" target="_blank">{{ $socialLinks->facebook }}</a>
                                        @else
                                            <span class="text-muted">Tidak tersedia</span>
                                        @endif
                                    </td>

                                </tr>
                                <!-- Instagram -->
                                <tr>
                                    <td>
                                        <i class="bi bi-instagram" style="color: #E1306C;"></i> Instagram
                                    </td>
                                    <td>
                                        @if($socialLinks->instagram)
                                            <a href="{{ $socialLinks->instagram }}" target="_blank">{{ $socialLinks->instagram }}</a>
                                        @else
                                            <span class="text-muted">Tidak tersedia</span>
                                        @endif
                                    </td>

                                </tr>
                                <!-- YouTube -->
                                <tr>
                                    <td>
                                        <i class="bi bi-youtube" style="color: #FF0000;"></i> YouTube
                                    </td>
                                    <td>
                                        @if($socialLinks->youtube)
                                            <a href="{{ $socialLinks->youtube }}" target="_blank">{{ $socialLinks->youtube }}</a>
                                        @else
                                            <span class="text-muted">Tidak tersedia</span>
                                        @endif
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
