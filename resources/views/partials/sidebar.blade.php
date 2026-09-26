<style>

.sidebar{

    width:250px;

    background:#1e293b;

    color:#fff;

    position:fixed;

    top:0;

    left:0;

    bottom:0;

    overflow-y:auto;

    z-index:1000;

}

.sidebar-header{

    padding:20px;

    text-align:center;

    background:#0f172a;

    border-bottom:1px solid rgba(255,255,255,.1);

}

.sidebar-header h3{

    margin:0;

    font-size:22px;

    font-weight:bold;

}

.sidebar-header p{

    margin:5px 0 0;

    color:#cbd5e1;

    font-size:13px;

}

.sidebar-menu{

    list-style:none;

    padding:15px 0;

    margin:0;

}

.sidebar-menu li{

    margin:4px 0;

}

.sidebar-menu a{

    display:block;

    color:#cbd5e1;

    padding:12px 22px;

    text-decoration:none;

    transition:.3s;

}

.sidebar-menu a:hover{

    background:#334155;

    color:#fff;

}

.sidebar-menu i{

    width:25px;

}

.sidebar-title{

    color:#94a3b8;

    font-size:11px;

    text-transform:uppercase;

    padding:15px 22px 8px;

    letter-spacing:1px;

}

.logout{

    color:#ffb4b4 !important;

}

@media(max-width:991px){

.sidebar{

    position:relative;

    width:100%;

    height:auto;

}

}

</style>

<div class="sidebar">

    <div class="sidebar-header">

        <h3>
            <i class="fas fa-clinic-medical"></i>
            MedInventory
        </h3>

        <p>{{ Auth::user()->name }}</p>

    </div>

    <ul class="sidebar-menu">

        @if(Auth::user()->role == 'admin')

            <div class="sidebar-title">
                Administration
            </div>

            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-home"></i>
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('categories.index') }}">
                    <i class="fas fa-tags"></i>
                    Categories
                </a>
            </li>

            <li>
                <a href="{{ route('medicines.index') }}">
                    <i class="fas fa-pills"></i>
                    Medicines
                </a>
            </li>

            <li>
                <a href="{{ route('inventory.index') }}">
                    <i class="fas fa-boxes"></i>
                    Inventory
                </a>
            </li>

            <li>
                <a href="{{ route('orders.index') }}">
                    <i class="fas fa-shopping-cart"></i>
                    Orders
                </a>
            </li>

            <li>
                <a href="{{ route('pharmacies.index') }}">
                    <i class="fas fa-clinic-medical"></i>
                    Pharmacies
                </a>
            </li>

            <li>
                <a href="{{ route('reports.index') }}">
                    <i class="fas fa-chart-bar"></i>
                    Reports
                </a>
            </li>

        @elseif(Auth::user()->role == 'pharmacy')

            <div class="sidebar-title">
                Pharmacy
            </div>

            <li>
                <a href="{{ route('pharmacy.dashboard') }}">
                    <i class="fas fa-home"></i>
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('pharmacy.medicines.index') }}">
                    <i class="fas fa-pills"></i>
                    My Medicines
                </a>
            </li>

            <li>
                <a href="{{ route('pharmacy.inventory.index') }}">
                    <i class="fas fa-boxes"></i>
                    Inventory
                </a>
            </li>

            <li>
                <a href="{{ route('pharmacy.orders.index') }}">
                    <i class="fas fa-shopping-cart"></i>
                    Orders
                </a>
            </li>

            <li>
                <a href="{{ route('pharmacy.profile') }}">
                    <i class="fas fa-user"></i>
                    Pharmacy Profile
                </a>
            </li>

        @else

            <div class="sidebar-title">
                Patient
            </div>

            <li>
                <a href="{{ route('patient.dashboard') }}">
                    <i class="fas fa-home"></i>
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('medicine.search') }}">
                    <i class="fas fa-search"></i>
                    Search Medicines
                </a>
            </li>

            <li>
                <a href="{{ route('patient.orders.index') }}">
                    <i class="fas fa-shopping-cart"></i>
                    My Orders
                </a>
            </li>

        @endif

        <hr style="background:rgba(255,255,255,.1);">

        <li>

            <a class="logout"
               href="{{ route('logout') }}"
               onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">

                <i class="fas fa-sign-out-alt"></i>

                Logout

            </a>

            <form id="logout-form"
                  action="{{ route('logout') }}"
                  method="POST"
                  style="display:none;">

                @csrf

            </form>

        </li>

    </ul>

</div>