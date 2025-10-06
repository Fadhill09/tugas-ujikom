<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Struk</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('icons/remixicon.css') }}">

    <style>
        /* --- Layout struk --- */
        body {
            background: #f4f4f4;
            padding: 20px;
            font-family: "Courier New", Courier, monospace;
        }

        @page {
            margin: 5px;
        }

        .receipt {
            width: 320px;
            /* typical thermal width; ubah jadi 380 untuk kertas lebar */
            max-width: 100%;
            margin: 0 auto;
            background: #fff;
            padding: 14px 18px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border-radius: 6px;
            color: #111;
            font-size: 13px;
            line-height: 1.25;
            margin-top: 90px;
            page-break-inside: avoid;
            /* biar nggak kepotong */
        }

        .item {
            page-break-inside: avoid;
        }

        .receipt .brand {
            text-align: center;
            margin-bottom: 8px;
        }

        .receipt .brand h2 {
            margin: 0;
            font-size: 18px;
            letter-spacing: 0.5px;
        }

        .receipt .brand p {
            margin: 0;
            font-size: 11px;
            color: #555
        }

        .divider {
            border-top: 1px dashed #bbb;
            margin: 10px 0;
        }

        .receipt table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .receipt table thead th {
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            padding-bottom: 6px;
        }

        .receipt table tbody td {
            vertical-align: top;
            padding: 6px 0;
        }

        .qtty {
            width: 70px;
            text-align: center;
        }

        .price,
        .subtotal {
            width: 80px;
            text-align: center;
        }

        .line-item-name {
            display: block;
            font-weight: 600;
        }

        .small-desc {
            display: block;
            font-size: 12px;
            color: #666;
            margin-top: 3px;
        }

        .totals {
            margin-top: 8px;
        }

        .totals .row {
            margin: 0;
            padding: 6px 0;
        }

        .totals .label {
            color: #333;
        }

        .totals .value {
            text-align: right;
            font-weight: 700;
        }

        .footer {
            text-align: center;
            margin-top: 12px;
            font-size: 12px;
            color: #444;
        }

        .thank {
            font-weight: 700;
            margin-top: 8px;
        }

        /* print styles — buat hasil print rapih */
        @media print {
            body {
                background: none;
                padding: 0;
            }

            .receipt {
                box-shadow: none;
                border-radius: 0;
                margin: 0;
                width: 100%;
            }

            .no-print {
                display: none;
            }
        }
    </style>

</head>

<body class="index-page">
    <div class="receipt">
        <div class="brand">
            <h2>Coffee Shop</h2>
            <p>Jl. Raya bandung • (021) 555-0123</p>
            <p>------------------------------------</p>
        </div>

        <div class="meta mb-1">
            <div style="display:flex; justify-content:space-between;">
                <div>
                    <div><strong>Nama:</strong> {{ $transaction->customer_name }}</div>
                    <div><strong>Meja:</strong> {{ $transaction->table_number }}</div>
                </div>
                <div style="text-align:right;">
                    <div><strong>ID:</strong> #{{ $transaction->id }}</div>
                    <div>{{ $transaction->created_at->format('d/m/Y') }}</div>
                    <div>{{ $transaction->created_at->format('H:i') }}</div>
                </div>
            </div>
        </div>

        <div class="divider"></div>

        <table class="mb-0">
            <thead>
                <tr>
                    <th>Item</th>
                    <th class="qtty">Jumlah</th>
                    <th class="price">Harga</th>
                    <th class="subtotal">Sub</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaction->items as $item)
                    <tr>
                        <td>
                            <span
                                class="line-item-name">{{ \Illuminate\Support\Str::limit($item->product_name, 28) }}</span>
                            {{-- jika mau tampilkan keterangan produk --}}
                            {{-- <span class="small-desc">Catatan / pilihan</span> --}}
                        </td>
                        <td class="qtty">{{ $item->qty }}</td>
                        <td class="price">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="subtotal">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="divider"></div>

        <div class="totals">
            <div class="row">
                <div class="col-7 label">Subtotal:</div>
                <div class="col-5 value">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</div>
            </div>
            <div class="row">
                <div class="col-7 label">Dibayar:</div>
                <div class="col-5 value">Rp {{ number_format($transaction->total_paid, 0, ',', '.') }}</div>
            </div>
            <div class="row" style="border-top:1px solid #ddd; margin-top:6px; padding-top:6px;">
                <div class="col-7 label">Kembali:</div>
                <div class="col-5 value">Rp {{ number_format($transaction->change, 0, ',', '.') }}</div>
            </div>
        </div>

        <div class="divider"></div>

        <div class="footer">
            <div>Terima kasih telah berkunjung</div>
            <div class="thank">-- SEMOGA HARI ANDA MENYENANGKAN --</div>
            <div style="margin-top:10px; font-size:11px; color:#666;">
                <small>www.coffeeshop.gmail.com • T: (021) 555-0123</small>
            </div>
        </div>

    </div>
</body>
</script>
 @include('style.kasir')


</html>
