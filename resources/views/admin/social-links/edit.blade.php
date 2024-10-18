@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-13"> <!-- Set to 13 for a wider form -->
            <div class="card shadow-sm" style="min-height: 400px;"> <!-- Set a minimum height for better fit -->
                <div class="card-header text-center bg-primary text-white">
                    <h5>Update Tautan Media Sosial</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('social-links.update') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="twitter" class="form-label">Twitter</label>
                            <input type="url" name="twitter" class="form-control" id="twitter" value="{{ $socialLinks->twitter }}" required placeholder="Masukkan URL Twitter">
                        </div>
                        <div class="mb-4">
                            <label for="facebook" class="form-label">Facebook</label>
                            <input type="url" name="facebook" class="form-control" id="facebook" value="{{ $socialLinks->facebook }}" required placeholder="Masukkan URL Facebook">
                        </div>
                        <div class="mb-4">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input type="url" name="instagram" class="form-control" id="instagram" value="{{ $socialLinks->instagram }}" required placeholder="Masukkan URL Instagram">
                        </div>
                        <div class="mb-4">
                            <label for="youtube" class="form-label">YouTube</label>
                            <input type="url" name="youtube" class="form-control" id="youtube" value="{{ $socialLinks->youtube }}" required placeholder="Masukkan URL YouTube">
                        </div>
                        <div class="mb-4">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" name="alamat" class="form-control" id="alamat" value="{{ $socialLinks->alamat }}" required placeholder="Masukkan Alamat">
                        </div>
                        <div class="mb-4">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="tel" name="telepon" class="form-control" id="telepon" value="{{ $socialLinks->telepon }}" required placeholder="Masukkan Nomor Telepon">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ $socialLinks->email }}" required placeholder="Masukkan Email">
                        </div>
                        <div class="mb-4">
                            <label for="jam_buka" class="form-label">Jam Buka</label>
                            <input type="text" name="jam_buka" class="form-control" id="jam_buka" value="{{ $socialLinks->jam_buka }}" required placeholder="Masukkan Jam Buka">
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Update Links</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
