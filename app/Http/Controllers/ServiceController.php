<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Barang;
use App\Models\Jasa;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        return view('form.pendataan', [
            'Jasa' => \App\Models\jasa::all(),
            'Barang' => \App\Models\barang::all()
        ]);
    }

    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'keluhan' => 'nullable|string',
        'dibayar' => 'required|numeric|min:0',
        'kembalian' => 'required|numeric|min:0',
        'barang.*.id_barang' => 'nullable|exists:barangs,id_barang',
        'barang.*.harga' => 'nullable|numeric|min:0',
        'jasa.*.id_jasa' => 'nullable|exists:jasas,id_jasa',
        'jasa.*.harga' => 'nullable|numeric|min:0',
    ]);

    $total_harga = 0;

    // Simpan transaksi ke tabel services
    $service = Service::create([
        'id_user' => Auth::id(),
        'tanggal' => now(),
        'keluhan' => $request->keluhan,
        'total_harga' => 0, // Akan diperbarui nanti
        'dibayar' => $request->dibayar,
        'kembalian' => $request->kembalian,
    ]);

    // Simpan barang yang dipilih
    if ($request->has('barang')) {
        foreach ($request->barang as $id_barang => $barang) {
            if (!empty($barang['id_barang']) && isset($barang['harga'])) {
                $hargaBarang = (int) $barang['harga'];
                $total_harga += $hargaBarang;

                Detail::create([
                    'id_service' => $service->id_service,
                    'id_barang' => $barang['id_barang'],
                    'id_jasa' => null,
                    'harga_satuan' => $hargaBarang,
                    'total_harga' => $hargaBarang,
                ]);
            }
        }
    }

    // Simpan jasa yang dipilih
    if ($request->has('jasa')) {
        foreach ($request->jasa as $id_jasa => $jasa) {
            if (!empty($jasa['id_jasa']) && isset($jasa['harga'])) {
                $hargaJasa = (int) $jasa['harga'];
                $total_harga += $hargaJasa;

                Detail::create([
                    'id_service' => $service->id_service,
                    'id_barang' => null,
                    'id_jasa' => $jasa['id_jasa'],
                    'harga_satuan' => $hargaJasa,
                    'total_harga' => $hargaJasa,
                ]);
            }
        }
    }

    // Update total harga di database
    $service->update([
        'total_harga' => $total_harga,
    ]);

    return redirect()->route('home.index')->with('success', 'Transaksi berhasil ditambahkan');
}

}
