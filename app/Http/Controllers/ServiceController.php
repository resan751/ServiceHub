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
        $barang = Barang::all();
        $jasa = Jasa::all();
        return view('form.detail', compact('barang', 'jasa'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'barang_id.*' => 'nullable|exists:barangs,id_barang',
            'jasa_id.*' => 'nullable|exists:jasas,id_jasa',
            'jumlah.*' => 'required|integer|min:1',
            'harga_satuan_barang.*' => 'required_with:barang_id.*|numeric|min:0',
            'harga_satuan_jasa.*' => 'required_with:jasa_id.*|numeric|min:0',
        ]);

        // Buat transaksi service
        $service = Service::create([
            'id_user' => Auth::id(),
            'tanggal' => now(),
            'total_harga' => 0
        ]);

        $total_harga = 0;

        // Simpan detail barang
        if ($request->has('barang_id')) {
            foreach ($request->barang_id as $key => $id) {
                if ($id) {
                    $jumlah = $request->jumlah_barang[$key];
                    $harga_satuan = $request->harga_satuan_barang[$key];
                    $total = $harga_satuan * $jumlah;

                    Detail::create([
                        'id_service' => $service->id_service,
                        'id_barang' => $id,
                        'jumlah' => $jumlah,
                        'harga_satuan' => $harga_satuan,
                        'total_harga' => $total
                    ]);

                    $total_harga += $total;
                }
            }
        }

        // Simpan detail jasa
        if ($request->has('jasa_id')) {
            foreach ($request->jasa_id as $key => $id) {
                if ($id) {
                    $jumlah = $request->jumlah_jasa[$key];
                    $harga_satuan = $request->harga_satuan_jasa[$key];
                    $total = $harga_satuan * $jumlah;

                    Detail::create([
                        'id_service' => $service->id_service,
                        'id_jasa' => $id,
                        'jumlah' => $jumlah,
                        'harga_satuan' => $harga_satuan,
                        'total_harga' => $total
                    ]);

                    $total_harga += $total;
                }
            }
        }

        // Update total harga
        $service->update(['total_harga' => $total_harga]);

        return redirect()->route('list.index')->with('success', 'Transaksi berhasil disimpan');
    }
}
