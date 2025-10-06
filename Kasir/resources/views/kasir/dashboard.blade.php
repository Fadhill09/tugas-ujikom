<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Kasir</title>
    <meta name="description" content="">
    <meta name="keywords" content="">


    @include('style.kasir')
</head>

<body class="index-page">

    @include('kasir.pages.header')

    <main id="main" class="main">
        {{-- <a href="{{ route('checkout.history') }}">Histori</a> --}}
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
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="menu-{{ $category->id }}"
                            role="tabpanel">
                            <div class="overflow-auto" style="white-space: nowrap;">
                                <div class="d-flex flex-nowrap">
                                    @foreach ($category->products->chunk(4) as $chunk)
                                        <div class="flex-shrink-0"
                                            style="flex: 0 0 100%; max-width: 100%; white-space: normal;">
                                            <div class="row">
                                                @foreach ($chunk as $product)
                                                    <div class="col-12 col-md-3 mt-4">
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
                                <span class="text-success fw-bold">Rp <span id="cart-total-display">0</span></span>
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
                                        <div class="modal-header  text-black">
                                            <h5 class="modal-title" id="checkoutModalLabel">Data Pembeli</h5>

                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('checkout.store') }}" method="POST" autocomplete="off">
                                                @csrf
                                                <input type="hidden" name="cart" id="cart-hidden">

                                                <div class="mb-2">
                                                    <label for="total_price" class="form-label">Subtotal</label>
                                                    <input type="text" class="form-control"
                                                        id="cart-total-display-input" readonly>
                                                    <input type="hidden" name="total_price" id="cart-total-hidden">
                                                </div>

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
                                                    <label for="total_paid" class="form-label">Bayar</label>
                                                    <input type="number" name="total_paid" class="form-control"
                                                        required>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-success">Bayar &
                                                        Cetak</button>
                                                </div>
                                            </form>

                                        </div>
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
        // tombol tambah product
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

        // tambah qty
        if (e.target.classList.contains('btn-plus')) {
            let id = e.target.dataset.id;
            let item = cart.find(p => p.id == id);
            if (item) {
                item.qty++;
                updateCart();
            }
        }

        // kurang qty
        if (e.target.classList.contains('btn-minus')) {
            let id = e.target.dataset.id;
            let item = cart.find(p => p.id == id);
            if (item) {
                item.qty--;
                if (item.qty <= 0) cart = cart.filter(p => p.id != id);
                updateCart();
            }
        }

        // hapus item
        if (e.target.classList.contains('btn-remove')) {
            let id = e.target.dataset.id;
            cart = cart.filter(p => p.id != id);
            updateCart();
        }
    });

    function updateCart() {
        let cartItems = document.getElementById('cart-items');
        let cartTotalSpan = document.getElementById('cart-total-display'); // untuk <span>
        let cartTotalInput = document.getElementById('cart-total-display-input'); // untuk <input>
        let cartTotalHidden = document.getElementById('cart-total-hidden'); // untuk <hidden>

        if (cart.length === 0) {
            cartItems.innerHTML = `<p class="text-muted mb-0 text-center">Belum ada pesanan.</p>`;
            if (cartTotalSpan) cartTotalSpan.innerText = 0;
            if (cartTotalInput) cartTotalInput.value = 0;
            if (cartTotalHidden) cartTotalHidden.value = 0;
            return;
        }

        let html = `<ul class="list-group">`;
        let total = 0;

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
                    <span>Rp ${subtotal.toLocaleString('id-ID')}</span>
                    <button class="btn btn-sm btn-outline-danger btn-remove" data-id="${item.id}">❌</button>
                </div>
            </li>
        `;
        });

        html += `</ul>`;
        cartItems.innerHTML = html;

        // update ke tampilan
        if (cartTotalSpan) cartTotalSpan.innerText = total.toLocaleString('id-ID');
        if (cartTotalInput) cartTotalInput.value = `Rp ${total.toLocaleString('id-ID')}`;
        if (cartTotalHidden) cartTotalHidden.value = total;
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


@include('style.kasir')


</html>
