<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Index - Savora Bootstrap Template</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <link href={{ asset('template/assets/vendor/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
    <link href={{ asset('template/assets/vendor/bootstrap-icons/bootstrap-icons.css') }} rel="stylesheet">
    <link href={{ asset('template/assets/vendor/boxicons/css/boxicons.min.css') }} rel="stylesheet">
    <link href={{ asset('template/assets/vendor/quill/quill.snow.css') }} rel="stylesheet">
    <link href={{ asset('template/assets/vendor/quill/quill.bubble.css') }} rel="stylesheet">
    <link href={{ asset('template/assets/vendor/remixicon/remixicon.css') }} rel="stylesheet">
    <link href={{ asset('template/assets/vendor/simple-datatables/style.css') }} rel="stylesheet">

    <link href={{ asset('template/assets/css/style.css') }} rel="stylesheet">

    <link href="{{ asset('Savora/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('Savora/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Bitter:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link href="{{ asset('Savora/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Savora/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('Savora/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('Savora/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

    <link href="{{ asset('Savora/assets/css/main.css') }}" rel="stylesheet">
</head>

<body class="index-page">
    <header id="header" class="header fixed-top d-flex align-items-center">
            <div class="container d-flex align-items-center">


                <a href="#" class="logo d-flex align-items-center text-decoration-none">
                    <h1 class="sitename mb-0">Cafe</h1>
                </a>

                <nav id="navmenu" class="navmenu d-flex align-items-center ms-2">

                    <button class="btn border-0 bg-transparent toggle-sidebar-btn">
                        <i class="bi bi-list fs-2"></i>
                    </button>

                </nav>
            </div>

            <div class="d-none d-sm-block ">
                @if (Route::has('login'))
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn-getstarted border-0">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
    </header>

    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link collapsed" href="users-profile.html">
                    <i class="bi bi-person"></i>
                    <span>Login</span>
                </a>
            </li>
        </ul>

    </aside>

    <main id="main" class="main">
        <section id="menu" class="menu section">
            <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="menu-filters">
                            <ul class="nav nav-pills justify-content-center" id="menuTabs" role="tablist">
                                @foreach ($categories as $category)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                            id="menu-{{ $category->id }}-tab" data-bs-toggle="pill"
                                            data-bs-target="#menu-{{ $category->id }}" type="button" role="tab">
                                            <i class="bi bi-list me-2"></i>{{ $category->kategori }}
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="menuTabContent">
                    @foreach ($categories as $category)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                            id="menu-{{ $category->id }}" role="tabpanel">
                            <div class="overflow-auto" style="white-space: nowrap;">
                                <div class="d-flex flex-nowrap">
                                    @foreach ($category->products->chunk(4) as $chunk)
                                        <div class="flex-shrink-0"
                                            style="flex: 0 0 100%; max-width: 100%; white-space: normal;">
                                            <div class="row">
                                                @foreach ($chunk as $product)
                                                    <div class="col-12 col-md-5 mt-4">
                                                        <div class="menu-item m-2 h-100">
                                                            <div class="menu-item-image">
                                                                @if ($product->foto)
                                                                    <img src="{{ asset('storage/' . $product->foto) }}"
                                                                        class="img-fluid w-100"
                                                                        alt="{{ $product->nama }}">
                                                                @endif
                                                                <div class="special-badge">
                                                                    {{ $product->stok > 0 ? 'Tersedia' : 'Habis' }}
                                                                </div>
                                                            </div>
                                                            <div class="menu-item-content">
                                                                <h4 class="mb-1">{{ $product->nama }}</h4>
                                                                <p class="mb-2">
                                                                    {{ \Illuminate\Support\Str::limit($product->deskripsi, 80, '...') }}
                                                                </p>
                                                                <div
                                                                    class="menu-item-footer d-flex justify-content-between align-items-center">
                                                                    <span class="price">Rp
                                                                        {{ number_format($product->harga, 0, ',', '.') }}</span>
                                                                    <button class="btn btn-sm btn-primary add-to-cart"
                                                                        data-id="{{ $product->id }}"
                                                                        data-nama="{{ $product->nama }}"
                                                                        data-harga="{{ $product->harga }}">
                                                                        + Tambah
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-5">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-dark text-white fw-bold">
                            Pesanan
                        </div>

                        <div class="card-body" id="cart-items">
                            <p class="text-muted mb-0 text-center">Belum ada pesanan.</p>
                        </div>

                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Total:</strong>
                                <span class="text-success fw-bold">Rp <span id="cart-total">0</span></span>
                            </div>
                            {{-- <form id="checkout-cart-form" action="{{ route('checkout.form') }}" method="GET">
                                @csrf
                                <input type="hidden" name="cart" id="cart-data">
                                <button type="submit" class="btn btn-success btn-sm px-3">Pesan</button>
                            </form> --}}
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#checkoutModal">
                                Pesan Sekarang
                            </button>


                            <div class="modal fade" id="checkoutModal" tabindex="-1"
                                aria-labelledby="checkoutModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header  text-white">
                                            <h5 class="modal-title" id="checkoutModalLabel">Data Pembeli</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('checkout.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="cart" id="cart-hidden">

                                                <div class="mb-2">
                                                    <label for="customer_name" class="form-label">Nama Pemesan</label>
                                                    <input type="text" name="customer_name" class="form-control"
                                                        required>
                                                </div>

                                                <div class="mb-2">
                                                    <label for="table_number" class="form-label">No Meja</label>
                                                    <input type="text" name="table_number" class="form-control">
                                                </div>

                                                <div class="mb-2">
                                                    <label for="total_paid" class="form-label">Total Bayar</label>
                                                    <input type="number" name="total_paid" class="form-control"
                                                        required>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-success">Bayar</button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </section>
    </main>

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>


</body>



<script>
    document.querySelector('#checkoutModal form').addEventListener('submit', function(e) {
        if (cart.length === 0) {
            e.preventDefault();
            alert("Keranjang masih kosong!");
            return;
        }
        document.getElementById('cart-hidden').value = JSON.stringify(cart);
    });




    let cart = [];
    let total = 0;

    document.addEventListener('click', function(e) {
        // tombol tambah dari product
        if (e.target.classList.contains('add-to-cart')) {
            let id = e.target.dataset.id;
            let nama = e.target.dataset.nama;
            let harga = parseInt(e.target.dataset.harga);

            let item = cart.find(p => p.id == id);
            if (item) {
                item.qty++;
            } else {
                cart.push({
                    id,
                    nama,
                    harga,
                    qty: 1
                });
            }

            updateCart();
        }

        // tombol tambah qty di cart
        if (e.target.classList.contains('btn-plus')) {
            let id = e.target.dataset.id;
            let item = cart.find(p => p.id == id);
            if (item) {
                item.qty++;
                updateCart();
            }
        }

        // tombol kurang qty di cart
        if (e.target.classList.contains('btn-minus')) {
            let id = e.target.dataset.id;
            let item = cart.find(p => p.id == id);
            if (item) {
                item.qty--;
                if (item.qty <= 0) {
                    cart = cart.filter(p => p.id != id);
                }
                updateCart();
            }
        }

        // tombol hapus item
        if (e.target.classList.contains('btn-remove')) {
            let id = e.target.dataset.id;
            cart = cart.filter(p => p.id != id);
            updateCart();
        }
    });

    function updateCart() {
        let cartItems = document.getElementById('cart-items');
        let cartTotal = document.getElementById('cart-total');

        if (cart.length === 0) {
            cartItems.innerHTML = `<p class="text-muted mb-0 text-center">Belum ada pesanan.</p>`;
            cartTotal.innerText = 0;
            return;
        }

        let html = `<ul class="list-group">`;
        total = 0;
        cart.forEach(item => {
            let subtotal = item.qty * item.harga;
            total += subtotal;
            html += `
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>${item.nama}</strong>
                    <div class="d-flex align-items-center gap-1 mt-1">
                        <button class="btn btn-sm btn-outline-secondary btn-minus" data-id="${item.id}">–</button>
                        <span class="mx-1">${item.qty}</span>
                        <button class="btn btn-sm btn-outline-secondary btn-plus" data-id="${item.id}">+</button>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span>Rp ${subtotal.toLocaleString()}</span>
                    <button class="btn btn-sm btn-outline-danger btn-remove" data-id="${item.id}">❌</button>
                </div>
            </li>
        `;
        });
        html += `</ul>`;

        cartItems.innerHTML = html;
        cartTotal.innerText = total.toLocaleString();
    }

    document.getElementById('checkout-cart-form').addEventListener('submit', function(e) {
        if (cart.length === 0) {
            e.preventDefault();
            alert("Keranjang masih kosong!");
            return;
        }

        // simpan cart ke hidden input
        document.getElementById('cart-data').value = JSON.stringify(cart);
    });
</script>

<script src="{{ asset('Savora/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('Savora/assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('Savora/assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('Savora/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('Savora/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('Savora/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>

<script src="{{ asset('Savora/assets/js/main.js') }}"></script>



<script src={{ asset('template/assets/vendor/apexcharts/apexcharts.min.js') }}></script>
<script src={{ asset('template/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>
<script src={{ asset('template/assets/vendor/chart.js/chart.umd.js') }}></script>
<script src={{ asset('template/assets/vendor/echarts/echarts.min.js') }}></script>
<script src={{ asset('template/assets/vendor/quill/quill.js') }}></script>
<script src={{ asset('template/assets/vendor/simple-datatables/simple-datatables.js') }}></script>
<script src={{ asset('template/assets/vendor/tinymce/tinymce.min.js') }}></script>
<script src={{ asset('template/assets/vendor/php-email-form/validate.js') }}></script>

<script src={{ asset('template/assets/js/main.js') }}></script>


</html>
