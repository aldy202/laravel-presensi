<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        @if (Auth::user()->role === 'admin')
            <div class="sidebar-brand">
                <a href="index.html">Admin DAMANSI</a>
            </div>
        @elseif(Auth::user()->role === 'karyawan')
            <div class="sidebar-brand">
                <a href="index.html">Karyawan DAMANSI</a>
            </div>
        @elseif(Auth::user()->role === 'leader')
            <div class="sidebar-brand">
                <a href="index.html">Leader DAMANSI</a>
            </div>
        @endif

        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                <a href="{{ url('/dashboard') }}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
            </li>
            @if (Auth::user()->role === 'admin')
                <li class="{{ Request::is('users') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class="nav-link"><i
                            class="fas fa-user"></i><span>Users</span></a>
                </li>
                <li class="{{ Request::is('history-all') ? 'active' : '' }}">
                    <a href="{{ route('presensi.historyAll') }}" class="nav-link"><i
                            class="fas fa-columns"></i><span>Presensi-History-All</span></a>
                </li>
                <li class="{{ Request::is('time-shift') ? 'active' : '' }}">
                    <a href="{{ route('timeshifts.index') }}" class="nav-link"><i
                            class="fas fa-columns"></i><span>Time-Shift</span></a>
                </li>
            @elseif (Auth::user()->role === 'karyawan')
                <li class="{{ Request::is('presensi') ? 'active' : '' }}">
                    <a href="{{ route('presensi.index') }}" class="nav-link"><i
                            class="fas fa-user"></i><span>Presensi</span></a>
                </li>
                <li class="{{ Request::is('history-presensi') ? 'active' : '' }}">
                    <a href="{{ route('presensi.history') }}" class="nav-link"><i
                            class="fas fa-th-large"></i><span>Presensi-History</span></a>
                </li>
            @elseif (Auth::user()->role === 'leader')
                <li class="{{ Request::is('presensi') ? 'active' : '' }}">
                    <a href="{{ route('presensi.index') }}" class="nav-link"><i
                            class="fas fa-user"></i><span>Presensi</span></a>
                </li>
                <li class="{{ Request::is('history-presensi') ? 'active' : '' }}">
                    <a href="{{ route('presensi.history') }}" class="nav-link"><i
                            class="fas fa-th-large"></i><span>Presensi-History</span></a>
                </li>
                <li class="{{ Request::is('history-all') ? 'active' : '' }}">
                    <a href="{{ route('presensi.historyAll') }}" class="nav-link"><i
                            class="fas fa-columns"></i><span>Presensi-History-All</span></a>
                </li>
            @endif
        </ul>
    </aside>
</div>
