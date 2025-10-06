<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;

class CheckoutController extends Controller
{

    public function index(Request $request)
    {
        $cart = $request->cart ? json_decode($request->cart, true) : [];
        return view('kasir.struk', compact('cart'));
    }


    // simpan transaksi + items
    public function store(Request $request)
    {
        $cart = json_decode($request->cart, true);

        if (!$cart || count($cart) === 0) {
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }

        $total_price = collect($cart)->sum(fn($item) => $item['qty'] * $item['harga']);

        $transaction = Transaction::create([
            'customer_name' => $request->customer_name ?? 'Anonim',
            'table_number'  => $request->table_number ?? '-',
            'total_price'   => $total_price,
            'total_paid'    => $request->total_paid ?? 0,
            'change'        => ($request->total_paid ?? 0) - $total_price,
        ]);

        foreach ($cart as $item) {
            $transaction->items()->create([
                'product_name' => $item['nama'],
                'qty'          => $item['qty'],
                'price'        => $item['harga'],
                'subtotal'     => $item['qty'] * $item['harga'],
            ]);
        }


        // return view('kasir.struk', compact('transaction'))
        //     ->with('success', 'Pesanan berhasil disimpan!');
          return redirect()->route('checkout.download', $transaction->id);
    }

    // tampilkan struk
    public function hasil($id)
    {
        $transaction = Transaction::with('items')->findOrFail($id);
        return view('kasir.struk', compact('transaction'));
    }

    public function download($id)
    {
        $transaction = Transaction::with('items')->findOrFail($id);

        $pdf = Pdf::loadView('kasir.struk', compact('transaction'))
                ->setPaper('a4', 'portrait'); 

        return $pdf->download('struk-' . $transaction->id . '.pdf');
    }
}
