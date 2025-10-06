<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->get();
        $products   = Product::latest()->get();
        $transaction = Transaction::latest()->first(); // ambil transaksi terakhir

        return view('kasir.dashboard', compact('products', 'categories', 'transaction'));
    }

    public function history()
{
    
    $transactions = Transaction::with('items')
        ->orderBy('created_at', 'desc')
        ->paginate(10); // biar ada pagination kalau banyak

    return view('kasir.histori', compact('transactions'));
}

}

