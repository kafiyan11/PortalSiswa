<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
    <div class="position-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('guru.dashboard') }}">
                    <i class="fas fa-home me-2"></i>
                    Beranda
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('guru.profiles.show') }}">
                    <i class="fas fa-user me-2"></i>
                    Profil
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('guru.materi') }}">
                    <i class="fas fa-book me-2"></i>
                    Materi Pelajaran
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('guru.jadwal') }}">
                    <i class="fas fa-calendar me-2"></i>
                    Jadwal Mengajar
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('guru.tugas.tugas') }}">
                    <i class="fas fa-tasks me-2"></i>
                    Tugas Siswa
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('guru.scores.index') }}">
                    <i class="fas fa-graduation-cap me-2"></i>
                    Nilai Siswa
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('guru.forumdiskusi') }}">
                    <i class="fas fa-comments me-2"></i>
                    Forum Diskusi
                </a>
            </li>
        </ul>
    </div>
  </nav>