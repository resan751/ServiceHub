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

class ServiceController extends Controller
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

        return view('layout.home', compact('services', 'bulan', 'tahun', 'jumlahTransaksi', 'totalPendapatan'));
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
            'total_harga_semua' => 'required|numeric|min:0',
            'barang.*.id_barang' => 'nullable|exists:barangs,id_barang',
            'barang.*.harga' => 'nullable|numeric|min:0',
            'jasa.*.id_jasa' => 'nullable|exists:jasas,id_jasa',
            'jasa.*.harga' => 'nullable|numeric|min:0',
        ]);

        $service = Service::create([
            'id_user' => Auth::id(),
            'tanggal' => now(),
            'keluhan' => $request->keluhan,
            'total_harga' => $request->total_harga_semua,
            'dibayar' => $request->dibayar,
            'kembalian' => $request->kembalian,
        ]);

        if ($request->has('barang')) {
            foreach ($request->barang as $barang) {
                if (!empty($barang['id_barang'])) {
                    $barangModel = Barang::find($barang['id_barang']);
                    if (!$barangModel || $barangModel->stok <= 0) {
                        return redirect()->back()->with('error', 'Stok ' . $barangModel->nama_barang . ' tidak mencukupi');
                    }
                }
            }
        }

        if ($request->has('barang')) {
            foreach ($request->barang as $barang) {
                if (!empty($barang['id_barang']) && isset($barang['harga'])) {
                    Detail::create([
                        'id_service' => $service->id_service,
                        'id_barang' => $barang['id_barang'],
                        'id_jasa' => null,
                        'harga_satuan' => $barang['harga'],
                        'total_harga' => $barang['harga'],
                    ]);

                    $barangModel = Barang::find($barang['id_barang']);
                    if ($barangModel && $barangModel->stok > 0) {
                        $barangModel->stok = $barangModel->stok - 1;
                        $barangModel->save();
                    }
                }
            }
        }

        if ($request->has('jasa')) {
            foreach ($request->jasa as $jasa) {
                if (!empty($jasa['id_jasa']) && isset($jasa['harga'])) {
                    Detail::create([
                        'id_service' => $service->id_service,
                        'id_barang' => null,
                        'id_jasa' => $jasa['id_jasa'],
                        'harga_satuan' => $jasa['harga'],
                        'total_harga' => $jasa['harga'],
                    ]);
                }
            }
        }

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
