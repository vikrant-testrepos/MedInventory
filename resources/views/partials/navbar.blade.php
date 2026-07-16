<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">

    <button class="btn btn-outline-secondary d-lg-none mr-3">
        <i class="fas fa-bars"></i>
    </button>

    <form class="form-inline mr-auto w-50">

        <div class="input-group w-100">

            <div class="input-group-prepend">

                <span class="input-group-text bg-white border-right-0">

                    <i class="fas fa-search text-muted"></i>

                </span>

            </div>

            <input
                type="text"
                class="form-control border-left-0"
                placeholder="Search medicines, pharmacies, orders..."
            >

        </div>

    </form>

    <ul class="navbar-nav ml-auto align-items-center">

        <li class="nav-item mr-3">

            <span class="text-muted">

                <i class="far fa-calendar-alt"></i>

                {{ date('d M Y') }}

            </span>

        </li>

        <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle"
               href="#"
               id="navbarDropdown"
               role="button"
               data-toggle="dropdown">

                <i class="fas fa-bell"></i>

                <span class="badge badge-danger">

                    0

                </span>

            </a>

            <div class="dropdown-menu dropdown-menu-right">

                <span class="dropdown-item text-muted">

                    No notifications

                </span>

            </div>

        </li>

        <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle"
               href="#"
               id="userDropdown"
               role="button"
               data-toggle="dropdown">

                <i class="fas fa-user-circle fa-lg"></i>

                {{ Auth::user()->name }}

            </a>

            <div class="dropdown-menu dropdown-menu-right">

                <span class="dropdown-item">

                    <strong>{{ ucfirst(Auth::user()->role) }}</strong>

                </span>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item"
                   href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">

                    Logout

                </a>

            </div>

        </li>

    </ul>

</nav>