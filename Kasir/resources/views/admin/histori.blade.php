<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Histori | Admin</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    @include('style.admin')

</head>

<body>

    @include('admin.pages.header')

    @include('admin.pages.sidebar')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Histori</h1>
        </div>
        <section class="section dashboard">
            <div class="row">
                <main class="main">
                    <section id="menu" class="menu section">
                        <div class="row">
                            @forelse($transactions as $transaction)
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card transaction-card shadow-sm h-100">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">
                                                <span class="text-primary">#{{ $transaction->id }}</span> -
                                                {{ $transaction->customer_name }}
                                            </h5>

                                            <p class="transaction-info"><strong>Meja:</strong>
                                                {{ $transaction->table_number ?? '-' }}
                                            </p>
                                            <p class="transaction-info"><strong>Tanggal:</strong>
                                                {{ $transaction->created_at->format('d/m/Y H:i') }}
                                            </p>
                                            <p class="transaction-info"><strong>Total:</strong>
                                                Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                                            </p>
                                            <p class="transaction-info"><strong>Dibayar:</strong>
                                                Rp {{ number_format($transaction->total_paid, 0, ',', '.') }}
                                            </p>
                                            <p class="transaction-info"><strong>Kembali:</strong>
                                                Rp {{ number_format($transaction->change, 0, ',', '.') }}
                                            </p>

                                            <div class="transaction-actions mt-auto">
                                                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#detailTransactionModal{{ $transaction->id }}">
                                                <i class="bi bi-info-square"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                  <div class="modal fade" id="detailTransactionModal{{ $transaction->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Transaksi #{{ $transaction->id }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="receipt">
                            <div class="brand text-center">
                                <h2>Coffee Shop</h2>
                                <p>Jl. Raya Bandung • (021) 555-0123</p>
                                <p>------------------------------------</p>
                            </div>

                            <div class="meta mb-2 d-flex justify-content-between">
                                <div>
                                    <div><strong>Nama:</strong> {{ $transaction->customer_name }}</div>
                                    <div><strong>Meja:</strong> {{ $transaction->table_number }}</div>
                                </div>
                                <div class="text-end">
                                    <div><strong>ID:</strong> #{{ $transaction->id }}</div>
                                    <div>{{ $transaction->created_at->format('d/m/Y') }}</div>
                                    <div>{{ $transaction->created_at->format('H:i') }}</div>
                                </div>
                            </div>

                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Sub</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaction->items as $item)
                                        <tr>
                                            <td>{{ \Illuminate\Support\Str::limit($item->product_name, 28) }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                            <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="totals">
                                <div class="d-flex justify-content-between">
                                    <span>Subtotal:</span>
                                    <span>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Dibayar:</span>
                                    <span>Rp {{ number_format($transaction->total_paid, 0, ',', '.') }}</span>
                                </div>
                                <div class="d-flex justify-content-between border-top pt-2">
                                    <span>Kembali:</span>
                                    <span>Rp {{ number_format($transaction->change, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <div class="text-center mt-3">
                                <p>Terima kasih telah berkunjung</p>
                                <small>-- SEMOGA HARI ANDA MENYENANGKAN --</small><br>
                                <small>www.coffeeshop.gmail.com • T: (021) 555-0123</small>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
                            @empty
                                <div class="col-12">
                                    <div class="empty-state">
                                        <i class="bi bi-journal-x"></i>
                                        <p>Belum ada transaksi tercatat.</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">
                         
                            <div class="d-flex justify-content-center mt-4">
                                {{ $transactions->onEachSide(1)->links('pagination::bootstrap-5') }}
                            </div>

                        </div>
                    </section>
                </main>
            </div>
        </section>

      

    </main><!-- End #main -->
    @include('admin.pages.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


    @include('style.admin')
</body>

</html>
