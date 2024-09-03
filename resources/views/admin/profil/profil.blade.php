@extends('layouts.app')

@section('content')
<div class="container">
    <div class="profile-card">
        <div class="profile-header">
            <div class="profile-pic"></div>
            <h1 class="profile-title">Profil</h1>
        </div>
        <div class="tabs">
            <div class="tab-button active" onclick="showTab('view')">Lihat Profil</div>
            <div class="tab-button" onclick="showTab('edit')">Edit Profil</div>
        </div>
        <div id="view" class="profile-body">
            <div class="profile-info">
                <input type="text" id="viewName" disabled value="{{ $user->name }}">
                <input type="text" id="viewNip" disabled value="{{ $user->nip }}">
            </div>
            <input type="text" id="viewGuru" class="full-width" disabled value="{{ $user->guru }}">
            <input type="text" id="viewEmail" class="full-width" disabled value="{{ $user->email }}">
            <input type="text" id="viewTelepon" class="full-width" disabled value="{{ $user->telepon }}">
        </div>
        <div id="edit" class="profile-body hidden">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')
                <div class="profile-info">
                    <input type="text" id="editName" name="name" placeholder="Nama" value="{{ $user->name }}">
                    <input type="text" id="editNip" name="nip" placeholder="NIP" value="{{ $user->nip }}">
                </div>
                <input type="text" id="editGuru" name="guru" placeholder="Guru" class="full-width" value="{{ $user->guru }}">
                <input type="email" id="editEmail" name="email" placeholder="Email" class="full-width" value="{{ $user->email }}">
                <input type="text" id="editTelepon" name="telepon" placeholder="Telepon" class="full-width" value="{{ $user->telepon }}">
                <button type="submit" class="save-button">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>

<script>
    function showTab(tab) {
        document.getElementById('view').classList.add('hidden');
        document.getElementById('edit').classList.add('hidden');
        document.getElementById(tab).classList.remove('hidden');
    }
</script>
@endsection
