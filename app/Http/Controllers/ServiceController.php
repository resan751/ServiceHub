<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\User;
use App\Models\Barang;
use App\Models\Jasa;
use App\Models\Service;
use App\Models\Servis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with(['user', 'details.barang', 'details.jasa'])->get();
    return view('layout.home', compact('services'));
    }
    public function data()
    {
        return view('form.pendataan', [
            'Jasa' => Jasa::all(),
            'Barang' => Barang::all()
        ]);
    }

    public function store(Request $request)
    {
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

        $service = Service::create([
            'id_user' => Auth::id(),
            'tanggal' => now(),
            'keluhan' => $request->keluhan,
            'total_harga' => 0,
            'dibayar' => $request->dibayar,
            'kembalian' => $request->kembalian,
        ]);

        if ($request->has('barang')) {
            foreach ($request->barang as $barang) {
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

        if ($request->has('jasa')) {
            foreach ($request->jasa as $jasa) {
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

        $service->update([
            'total_harga' => $total_harga,
        ]);

        return redirect()->route('data.index')->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function destroy($id)
{
    // Cari service berdasarkan ID
    $service = Service::findOrFail($id);

    // Hapus semua detail terkait dengan service ini
    Detail::where('id_service', $service->id_service)->delete();

    // Hapus service setelah detailnya dihapus
    $service->delete();

    return redirect()->route('home.index')->with('success', 'Transaksi berhasil dihapus');
}
}
