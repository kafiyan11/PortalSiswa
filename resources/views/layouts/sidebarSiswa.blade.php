<div class="sidebar collapsed" id="sidebar" onmouseover="expandSidebar()" onmouseout="collapseSidebar()">
    <a href="{{ route('siswa.dashboard') }}"><i class="fas fa-home"></i> Beranda</a>
    <a href="{{ route('siswa.profiles.profil') }}"><i class="fas fa-user"></i> Profil</a>
    <a href="{{ route('siswa.materi') }}"><i class="fas fa-book"></i> Materi Pelajaran</a>
    <a href="{{ route('siswa.jadwal') }}"><i class="fas fa-calendar-alt"></i> Jadwal Pelajaran</a>
    <a href="{{ route('siswa.tugas') }}"><i class="fas fa-tasks"></i> Tugas</a>
    <a href="{{ route('siswa.nilai') }}"><i class="fas fa-graduation-cap"></i> Nilai</a>
    <a href="{{ route('siswa.forumdiskusi') }}"><i class="fas fa-comments"></i> Forum Diskusi</a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i> Log Out
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>
