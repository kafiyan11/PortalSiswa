<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
    <div class="position-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('siswa.dashboard') }}">
                    <i class="fas fa-home me-2"></i>
                    Beranda
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('siswa.profiles.profil') }}">
                    <i class="fas fa-user me-2"></i>
                    Profil
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('siswa.jadwal') }}">
                    <i class="fas fa-calendar-alt me-2"></i>
                    Jadwal Pelajaran
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('siswa.tugas') }}">
                    <i class="fas fa-tasks me-2"></i>
                    Tugas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('siswa.coba') }}">
                    <i class="fas fa-book me-2"></i>
                    Materi Pelajaran
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('siswa.wujud') }}">
                    <i class="fas fa-graduation-cap me-2"></i>
                    Nilai 
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('siswa.forumdiskusi') }}">
                    <i class="fas fa-comments me-2"></i>
                    Forum Diskusi
                </a>
            </li>
        </ul>
    </div>
  </nav>
