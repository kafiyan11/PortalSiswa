<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
    <div class="position-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'orangtua.dashboard' ? 'active' : '' }}" href="{{ route('orangtua.dashboard') }}">
                    <i class="fas fa-home me-2"></i>
                    Beranda
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'orangtua.profiles.show' ? 'active' : '' }}" href="{{ route('orangtua.profiles.show') }}">                    <i class="fas fa-user me-2"></i>
                Profil
                <a class="nav-link {{ Route::currentRouteName() == 'orangtua.BoxNilai' ? 'active' : '' }}" href="{{ route('orangtua.BoxNilai') }}">
                    <i class="fas fa-graduation-cap me-2"></i>
                    Nilai
                </a>
            </li>
                </a>
            </li>
        </ul>
    </div>
  </nav>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('assets/img/LOGO11.png') }}" alt="Logo">
            <div class="portal-info">
                <h1>Portal Siswa</h1>
                <h2>SMKN 1 KAWALI</h2>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto ">
                <li class="nav-item d-lg-none">
                    <a class="nav-link active" href="{{ route('orangtua.dashboard') }}">
                        <i class="fas fa-home me-2"></i>
                        Beranda
                    </a>
                </li>

                <li class="nav-item d-lg-none">
                    <a class="nav-link" href="{{ route('orantua.BoxNilai') }}">
                        <i class="fas fa-graduation-cap me-2"></i>
                        Nilai
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Log Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
