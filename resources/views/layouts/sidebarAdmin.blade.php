<div class="sidebar collapsed" id="sidebar" onmouseover="expandSidebar()" onmouseout="collapseSidebar()">
    <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Beranda</a>
    <a href="{{ route('admin.profile.index') }}"><i class="fas fa-user"></i> Profil</a>
  
    <!-- Dropdown for 'Tambah Akun' -->
    <div class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#tambahAkunDropdown" aria-expanded="false" aria-controls="tambahAkunDropdown">
        <i class="fas fa-plus"></i> Tambah Akun
      </a>
      <div class="collapse" id="tambahAkunDropdown">
        <a class="dropdown-item" href="{{ route('tambah') }}"><i class="fas fa-user-graduate"></i>Data Siswa</a>
        <a class="dropdown-item" href="{{ route('tambahguru') }}"><i class="fas fa-chalkboard-teacher"></i>Data Guru</a>
        <a class="dropdown-item" href="{{ route('ortu') }}"><i class="fas fa-user-friends"></i>Data Orang Tua</a>
      </div>
    </div>
  
    <div class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#jadwalDropdown" aria-expanded="false" aria-controls="jadwalDropdown">
        <i class="fas fa-calendar-alt"></i> Jadwal
      </a>
      <div class="collapse" id="jadwalDropdown">
        <a class="dropdown-item" href="{{ route('admin.jadwal.index') }}"><i class="fas fa-calendar-alt"></i> Jadwal Pelajaran</a>
        <a class="dropdown-item" href="{{ route('admin.jadwalguru.index') }}"><i class="fas fa-chalkboard-teacher"></i> Jadwal Guru</a>
      </div>
    </div>
    
    <a href="{{ route('admin.tugas.index') }}"><i class="fas fa-tasks"></i> Tugas</a>
    <a href="{{ route('admin.materi.index') }}"><i class="fas fa-book"></i> Materi Pelajaran</a>

    <a href="{{ route('scores.index') }}"><i class="fas fa-graduation-cap"></i> Nilai</a>
    <a href="{{ route('posts.index') }}"><i class="fas fa-comments"></i> Forum Diskusi</a>
    <a href="{{ route('admin.scores.index') }}"><i class="fas fa-graduation-cap"></i> Nilai</a>
    <a href="{{ route('post.index') }}"><i class="fas fa-comments"></i> Forum Diskusi</a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      <i class="fas fa-sign-out-alt"></i> Log Out
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
      @csrf
    </form>
  </div>