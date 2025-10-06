    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="{{ route('admin.dashboard') }}">
                    <i class="ri-function-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('products.index') }}">
                    <i class="ri-restaurant-fill"></i>
                    <span>Menu</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('categories.index') }}">
                    <i class="ri-arrow-up-circle-line"></i>
                    <span>Kategori</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('checkout.history') }}">
                 <i class="bi bi-clock-fill"></i>
                 {{-- <i class="bi bi-clock-history"></i> --}}
                    <span>Histori</span>
                </a>
            </li>



        </ul>

    </aside>
