@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard Guru</h1>
    <p>Selamat datang, {{ Auth::user()->name }}!</p>
    <!-- Konten tambahan untuk guru -->
</div>
@endsection
