@extends('layouts.app')

@section('content')
<!-- Tambahkan link ke Bootstrap Icons CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Tautan Media Sosial Kami</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
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
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-twitter text-primary me-3" style="font-size: 1.5rem;"></i>
                                            <span>Twitter</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if($socialLinks->twitter)
                                            <span class="text-muted">{{ $socialLinks->twitter }}</span>
                                        @else
                                            <span class="text-muted">Tidak tersedia</span>
                                        @endif
                                    </td>
                                </tr>
                                <!-- Facebook -->
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-facebook text-primary me-3" style="font-size: 1.5rem;"></i>
                                            <span>Facebook</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if($socialLinks->facebook)
                                            <span class="text-muted">{{ $socialLinks->facebook }}</span>
                                        @else
                                            <span class="text-muted">Tidak tersedia</span>
                                        @endif
                                    </td>
                                </tr>
                                <!-- Instagram -->
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-instagram text-danger me-3" style="font-size: 1.5rem;"></i>
                                            <span>Instagram</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if($socialLinks->instagram)
                                            <span class="text-muted">{{ $socialLinks->instagram }}</span>
                                        @else
                                            <span class="text-muted">Tidak tersedia</span>
                                        @endif
                                    </td>
                                </tr>
                                <!-- YouTube -->
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-youtube text-danger me-3" style="font-size: 1.5rem;"></i>
                                            <span>YouTube</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if($socialLinks->youtube)
                                            <span class="text-muted">{{ $socialLinks->youtube }}</span>
                                        @else
                                            <span class="text-muted">Tidak tersedia</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-end mt-3">
                        <a href="{{ route('social-links.edit') }}" class="btn btn-primary btn-sm px-3">
                            <i class="bi bi-pencil-square me-1"></i>Edit Tautan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .table tr:hover {
        background-color: #f8f9fa;
        transition: background-color 0.3s ease;
    }
    
    .card {
        transition: box-shadow 0.3s ease;
    }
    
    .card:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
</style>
@endsection