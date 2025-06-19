<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KatalogController extends Controller
{

    public function showForm()
    {
        // Hanya menampilkan view, tidak ada data yang perlu dikirim
        return view('katalog');
    }

    public function hitungDiskon(Request $request)
    {
        // 1. Validasi input untuk memastikan data yang masuk sesuai
        $validated = $request->validate([
            'harga_satuan' => 'required|numeric|min:0',
            'jumlah_pembelian' => 'required|integer|min:1',
        ]);

        // 2. Ambil data dari request yang sudah divalidasi
        $satuan_harga = $validated['harga_satuan'];
        $pembelian_jumlah = $validated['jumlah_pembelian'];
        $total_harga_awal = $harga_satuan * $jumlah_pembelian;
        
        $persentase_diskon = 0;

        if ($pembelian_jumlah % 500 == 0) {
            $persentase_diskon = 50; 
        } elseif ($pembelian_jumlah % 100 == 0) {
                       $persentase_diskon = 0;
        } elseif ($pembelian_jumlah % 40 == 0) {
            $persentase_diskon = 10;
        }
        $nilai_diskon = $total_harga_awal * ($persentase_diskon / 100);
        $harga_akhir = $total_harga_awal - $nilai_diskon;

        return view('katalog', [
            'hasil' => [
                'harga_satuan' => $satuan_harga,
                'jumlah_pembelian' => $pembelian_jumlah,
                'total_harga_awal' => $total_harga_awal,
                'persentase_diskon' => $persentase_diskon,
                'nilai_diskon' => $nilai_diskon,
                'harga_akhir' => $harga_akhir,
            ]
        ])->withInput($request->all()); 
    }
}
