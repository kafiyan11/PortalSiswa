

<div class="sidebar collapsed" id="sidebar" onmouseover="expandSidebar()" onmouseout="collapseSidebar()">
    <a href="{{ route('guru.dashboard') }}"><i class="fas fa-home"></i> Beranda</a>
    <a href="{{ route('ortu.nilai') }}"><i class="fas fa-graduation-cap"></i> Nilai</a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i> Log Out
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>
