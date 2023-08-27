<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $kategori = Kategori::count();
        $produk = Produk::count();
        $supplier = Supplier::count();

        return view('dashboard.dashboard', compact('kategori', 'produk', 'supplier',))->with([
            'user' => Auth::user(),
        ]);
    }
}
