@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard Siswa</h1>
    <p>Selamat datang, {{ Auth::user()->name }}!</p>
    <!-- Konten tambahan untuk siswa -->
</div>
@endsection
