@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard Orang Tua</h1>
    <p>Selamat datang, {{ Auth::user()->name }}!</p>
    <!-- Konten tambahan untuk orang tua -->
</div>
@endsection
