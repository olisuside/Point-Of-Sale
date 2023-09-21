<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Member;
use App\Models\Pembelian;
use App\Models\Pengeluaran;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $kategori = Kategori::count();
        $produk = Produk::count();
        $supplier = Supplier::count();
        $member = Member::count();
        $jumlah_penjualan = Penjualan::sum('bayar');
        $jumlah_pengeluaran = Pembelian::sum('bayar') + Pengeluaran::sum('nominal');

        $tanggal_awal = date('Y-m-01');
        $tanggal_akhir = date('Y-m-d');
        if ($request->has('tanggal_awal') && $request->tanggal_awal != "" && $request->has('tanggal_akhir') && $request->tanggal_akhir != "") {
            $tanggal_awal = $request->tanggal_awal;
            $tanggal_akhir = $request->tanggal_akhir;
        }
        $data = $this->getData($tanggal_awal, $tanggal_akhir);

        $data_tanggal = $data['data_tanggal'];
        $data_pendapatan = $data['data_pendapatan'];
        $data_penjualan = $data['data_penjualan'];
        $data_pembelian = $data['data_pembelian'];

        return view('dashboard.dashboard', compact('kategori', 'produk', 'supplier', 'member', 'tanggal_awal', 'tanggal_akhir', 'data_tanggal', 'data_pendapatan', 'data_penjualan', 'data_pembelian', 'jumlah_penjualan', 'jumlah_pengeluaran'))->with([
            'user' => Auth::user(),
            'data' => $data,
        ]);
    }

    public function data($tanggal_awal, $tanggal_akhir)
    {
        return $this->getData($tanggal_awal, $tanggal_akhir);
    }


    public function getData($tanggal_awal, $tanggal_akhir)
    {
        $data_tanggal = array();
        $data_pendapatan = array();
        $data_penjualan = array();
        $data_pembelian = array();

        while (strtotime($tanggal_awal) <= strtotime($tanggal_akhir)) {
            $data_tanggal[] = $tanggal_awal;

            $total_penjualan = Penjualan::whereBetween('created_at', [$tanggal_awal . ' 00:00:00', $tanggal_awal . ' 23:59:59'])->sum('bayar');
            $total_pembelian = Pembelian::whereBetween('created_at', [$tanggal_awal . ' 00:00:00', $tanggal_awal . ' 23:59:59'])->sum('bayar');
            $total_pengeluaran = Pengeluaran::whereBetween('created_at', [$tanggal_awal . ' 00:00:00', $tanggal_awal . ' 23:59:59'])->sum('nominal');

            $pendapatan = $total_penjualan - $total_pembelian - $total_pengeluaran;
            $data_pendapatan[] = $pendapatan;

            $penjualan = Penjualan::whereBetween('created_at', [$tanggal_awal . ' 00:00:00', $tanggal_awal . ' 23:59:59'])->sum('bayar');
            $data_penjualan[] = $penjualan;

            $pembelian = Pembelian::whereBetween('created_at', [$tanggal_awal . ' 00:00:00', $tanggal_awal . ' 23:59:59'])->sum('bayar');
            $pengeluaran = Pengeluaran::whereBetween('created_at', [$tanggal_awal . ' 00:00:00', $tanggal_awal . ' 23:59:59'])->sum('nominal');
            $pengeluarantot = $pembelian + $pengeluaran;
            $data_pembelian[] = $pengeluarantot;

            $tanggal_awal = date('Y-m-d', strtotime("+1 day", strtotime($tanggal_awal)));
        }

        return [
            'data_tanggal' => $data_tanggal,
            'data_pendapatan' => $data_pendapatan,
            'data_penjualan' => $data_penjualan,
            'data_pembelian' => $data_pembelian,
        ];
    }
}
