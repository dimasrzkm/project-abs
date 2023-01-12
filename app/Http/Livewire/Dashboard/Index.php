<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Order;
use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $product = Product::with('categorie')->get();
        $productFilteredMakanan = $product->where('categorie.slug', 'makanan')->count();
        $productFilteredMinuman = $product->where('categorie.slug', 'minuman')->count();
        $jumlahTranasaksi = Order::get()->count();
        return view('livewire.dashboard.index', [
            'jumlah_makanan' => $productFilteredMakanan,
            'jumlah_minuman' => $productFilteredMinuman,
            'jumlah_transaksi' => $jumlahTranasaksi,
        ]);
    }
}
