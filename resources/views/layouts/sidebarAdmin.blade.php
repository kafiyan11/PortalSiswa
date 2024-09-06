<div class="sidebar collapsed" id="sidebar" onmouseover="expandSidebar()" onmouseout="collapseSidebar()">
    <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Beranda</a>
    <a href="{{ route('admin.profil') }}"><i class="fas fa-user"></i> Profil</a>
    <a href="{{ route('tambah') }}"><i class="fas fa-user"></i> Tambah Akun</a>
    <a href="{{ route('admin.materi') }}"><i class="fas fa-book"></i> Materi Pelajaran</a>
    <a href="{{ route('admin.jadwal') }}"><i class="fas fa-calendar-alt"></i> Jadwal Pelajaran</a>
    {{-- <a href="{{ route('admin.tugas') }}"><i class="fas fa-tasks"></i> Tugas</a> --}}
    <a href="{{ route('scores.index') }}"><i class="fas fa-graduation-cap"></i> Nilai</a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i> Log Out
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>
