<div class="sidebar">

    {{-- Logo --}}
    <div class="sidebar-header">

        <h3>

            <i class="fas fa-clinic-medical"></i>

            MedInventory

        </h3>

        <p>

            Administrator Panel

        </p>

    </div>


    {{-- User Profile --}}
    <div class="text-center py-4 border-bottom">

        <div
            style="width:70px;height:70px;
                   background:#2563eb;
                   color:#fff;
                   border-radius:50%;
                   margin:auto;
                   display:flex;
                   align-items:center;
                   justify-content:center;
                   font-size:28px;">

            <i class="fas fa-user"></i>

        </div>

        <h6 class="mt-3 mb-1 text-white">

            {{ Auth::user()->name }}

        </h6>

        <small class="text-light">

            Administrator

        </small>

    </div>


    {{-- Navigation --}}
    <div class="sidebar-menu">

        <a href="{{ route('admin.dashboard') }}"
           class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

            <i class="fas fa-tachometer-alt"></i>

            Dashboard

        </a>


        <a href="{{ route('pharmacies.index') }}"
           class="{{ request()->routeIs('pharmacies.*') ? 'active' : '' }}">

            <i class="fas fa-hospital"></i>

            Pharmacies

        </a>


        <a href="{{ route('categories.index') }}"
           class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">

            <i class="fas fa-th-large"></i>

            Categories

        </a>


        <a href="{{ route('medicines.index') }}"
           class="{{ request()->routeIs('medicines.*') ? 'active' : '' }}">

            <i class="fas fa-pills"></i>

            Medicines

        </a>


        <a href="{{ route('inventory.index') }}"
           class="{{ request()->routeIs('inventory.*') ? 'active' : '' }}">

            <i class="fas fa-boxes"></i>

            Inventory

        </a>

        <a href="{{ route('stock-history.index') }}">

            <i class="fas fa-history"></i>

            Stock History

        </a>


        <a href="{{ route('orders.index') }}"
           class="{{ request()->routeIs('orders.*') ? 'active' : '' }}">

            <i class="fas fa-shopping-cart"></i>

            Orders

        </a>


        <a href="{{ route('reports.index') }}"
           class="{{ request()->routeIs('reports.*') ? 'active' : '' }}">

            <i class="fas fa-chart-line"></i>

            Reports

        </a>

    </div>


    {{-- Footer --}}
    <div class="sidebar-footer">

        <form id="logout-form"
              action="{{ route('logout') }}"
              method="POST">

            @csrf

            <button
                type="submit"
                class="btn btn-danger btn-block">

                <i class="fas fa-sign-out-alt"></i>

                Logout

            </button>

        </form>

        <div class="text-center mt-3">

            <small class="text-muted">

                MedInventory v1.0

            </small>

        </div>

    </div>

</div>