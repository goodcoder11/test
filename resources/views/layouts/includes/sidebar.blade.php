<li class="sidebar-item">
    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.dashboard') }}"
       aria-expanded="false">
        <i class="mdi mdi-av-timer"></i>
        <span class="hide-menu">Dashboard</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#"
       onclick="event.preventDefault();document.getElementById('logout-form').submit();"
       aria-expanded="false">
        <i class="mdi mdi-logout"></i>
        <span class="hide-menu">Logout</span>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </a>
</li>
