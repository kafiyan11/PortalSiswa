
<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
  <div class="position-sticky">
      <ul class="nav flex-column">
          <li class="nav-item">
              <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                  <i class="fas fa-home me-2"></i>
                  Beranda
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.profiles.show') }}">
                  <i class="fas fa-user me-2"></i>
                  Profil
              </a>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="tambahAkunDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fas fa-plus me-2"></i>
                  Tambah Akun
              </a>
              <ul class="dropdown-menu" aria-labelledby="tambahAkunDropdown">
                  <li><a class="dropdown-item" href="{{ route('tambah') }}"><i class="fas fa-user-graduate me-2"></i>Data Siswa</a></li>
                  <li><a class="dropdown-item" href="{{ route('tambahguru') }}"><i class="fas fa-chalkboard-teacher me-2"></i>Data Guru</a></li>
                  <li><a class="dropdown-item" href="{{ route('ortu') }}"><i class="fas fa-user-friends me-2"></i>Data Orang Tua</a></li>
              </ul>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="jadwalDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fas fa-calendar-alt me-2"></i>
                  Jadwal
              </a>
              <ul class="dropdown-menu" aria-labelledby="jadwalDropdown">
                  <li><a class="dropdown-item" href="{{ route('admin.jadwal.index') }}"><i class="fas fa-calendar-alt me-2"></i>Jadwal Pelajaran</a></li>
                  <li><a class="dropdown-item" href="{{ route('admin.jadwalguru.index') }}"><i class="fas fa-chalkboard-teacher me-2"></i>Jadwal Guru</a></li>
              </ul>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.tugas.index') }}">
                  <i class="fas fa-tasks me-2"></i>
                  Tugas
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('namamapel.index') }}">
                  <i class="fas fa-globe me-2"></i>
                  Daftar Pelajaran
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.materi.index') }}">
                  <i class="fas fa-book me-2"></i>
                  Materi Pelajaran
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.scores.index') }}">
                  <i class="fas fa-graduation-cap me-2"></i>
                  Nilai
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('posts.index') }}">
                  <i class="fas fa-comments me-2"></i>
                  Forum Diskusi
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('social-links.index') }}">
                  <i class="fas fa-link me-2"></i>
                  Tautan Sosial
              </a>
          </li>
      </ul>
  </div>
</nav>
