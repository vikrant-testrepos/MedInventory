<div class="sidebar">

    <div class="sidebar-header">

        <h3>

            <i class="fas fa-clinic-medical"></i>

            MedInventory

        </h3>

        <small>

            Pharmacy Panel

        </small>

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

            <a href="#">

                <i class="fas fa-chart-line"></i>

                Reports

            </a>

        </li>


        <li>

            <a href="#">

                <i class="fas fa-clinic-medical"></i>

                My Pharmacy

            </a>

        </li>


        <li>

            <a href="#">

                <i class="fas fa-user-circle"></i>

                Profile

            </a>

        </li>


        <hr>


        <li>

            <a href="{{ route('logout') }}"
               onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">

                <i class="fas fa-sign-out-alt text-danger"></i>

                Logout

            </a>

        </li>

    </ul>


    <form id="logout-form"
          action="{{ route('logout') }}"
          method="POST"
          style="display:none;">

        @csrf

    </form>

</div>