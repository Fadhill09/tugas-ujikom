<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard | Admin</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    @include('style.admin')
</head>

<body>

    @include('admin.pages.header')

    @include('admin.pages.sidebar')
    <main id="main" class="main">
        <div class="pagetitle mb-4">
            <h1 class="fw-bold">Dashboard</h1>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row g-4">

                <!-- Card Total Pemasukan -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <h5 class="card-title text-muted">Total Pemasukan</h5>
                            <h3 class="text-success fw-bold mt-2">
                                Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
                            </h3>
                        </div>
                    </div>
                </div>

                <!-- Card Total Pembelian -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <h5 class="card-title text-muted">Total Pembelian</h5>
                            <h3 class="text-primary fw-bold mt-2">
                                {{ $totalPembelian }} Transaksi
                            </h3>
                        </div>
                    </div>
                </div>

                <!-- Filter Tanggal -->
                <div class="col-12">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Filter Transaksi</h5>
                            <form id="filterForm" class="row g-3">
                                <div class="col-md-4">
                                    <label for="start_date" class="form-label">Dari Tanggal</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="end_date" class="form-label">Sampai Tanggal</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control">
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="bi bi-filter"></i> Filter
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title">Grafik Jumlah Transaksi</h5>
                            <canvas id="dailyTransactionsChart" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>

                <script src="{{ asset('js/chart.min.js') }}"></script>
                <script>
                    const ctx = document.getElementById('dailyTransactionsChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: @json($labels),
                            datasets: [{
                                label: 'Jumlah Transaksi',
                                data: @json($data),
                                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1,
                                borderRadius: 6
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        precision: 0
                                    }
                                }
                            }
                        }
                    });
                </script>

    </main>

    @include('admin.pages.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


    @include('style.admin')
</body>

</html>
