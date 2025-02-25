<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\User;
use App\Models\Barang;
use App\Models\Jasa;
use App\Models\Service;
use App\Models\Servis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        $services = Service::with(['user', 'details.barang', 'details.jasa'])
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->get();

        $jumlahTransaksi = $services->count();
        $totalPendapatan = $services->sum('total_harga');

        return view('layout.list', compact('services', 'bulan', 'tahun', 'jumlahTransaksi', 'totalPendapatan'));
    }
}
