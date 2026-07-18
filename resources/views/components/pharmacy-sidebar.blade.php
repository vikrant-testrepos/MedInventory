<div class="sidebar">

    <div class="sidebar-header">
        <h3>
            <i class="fas fa-clinic-medical"></i>
            MedInventory
        </h3>
        <small>Pharmacy Panel</small>
    </div>

    <ul class="sidebar-menu">

        <li>
            <a href="{{ route('pharmacy.dashboard') }}"
               class="{{ request()->routeIs('pharmacy.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a href="{{ route('pharmacy.medicines.index') }}"
               class="{{ request()->routeIs('pharmacy.medicines.*') ? 'active' : '' }}">
                <i class="fas fa-pills"></i>
                Medicines
            </a>
        </li>

        <li>
            <a href="{{ route('pharmacy.inventory.index') }}"
               class="{{ request()->routeIs('pharmacy.inventory.*') ? 'active' : '' }}">
                <i class="fas fa-boxes"></i>
                Inventory
            </a>
        </li>

        <li>
            <a href="{{ route('pharmacy.orders.index') }}"
               class="{{ request()->routeIs('pharmacy.orders.*') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart"></i>
                Orders
            </a>
        </li>

        <li>
            <a href="{{ route('pharmacy.reports.index') }}"
               class="{{ request()->routeIs('pharmacy.reports.*') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i>
                Reports
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fas fa-store"></i>
                My Pharmacy
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fas fa-user-circle"></i>
                Profile
            </a>
        </li>

    </ul>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger btn-block">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </button>
        </form>
    </div>

</div>