<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
public function dashboard(Request $request)
{
    $query = Transaction::query();

    // filter tanggal kalau ada input
    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereBetween('created_at', [
            $request->start_date . " 00:00:00",
            $request->end_date . " 23:59:59"
        ]);
    }

    // total pemasukan
    $totalPemasukan = $query->sum('total_price');

    // total transaksi
    $totalPembelian = $query->count();

    // grafik jumlah transaksi per hari
    $dailyTransactions = $query->selectRaw('DATE(created_at) as tanggal, COUNT(*) as jumlah')
        ->groupBy('tanggal')
        ->orderBy('tanggal', 'asc')
        ->pluck('jumlah', 'tanggal');

    // ubah jadi array untuk chart.js
    $labels = $dailyTransactions->keys()->toArray();
    $data   = $dailyTransactions->values()->toArray();

    return view('admin.dashboard', compact(
        'totalPemasukan',
        'totalPembelian',
        'labels',
        'data'
    ));
}

}
