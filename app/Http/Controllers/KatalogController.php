<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KatalogController extends Controller
{
    /**
     * Menampilkan halaman form katalog.
     */
    public function showForm()
    {
        // Hanya menampilkan view, tidak ada data yang perlu dikirim
        return view('katalog');
    }

    /**
     * Menghitung diskon berdasarkan input dari form.
     */
    public function hitungDiskon(Request $request)
    {
        // 1. Validasi input untuk memastikan data yang masuk sesuai
        $validated = $request->validate([
            'harga_satuan' => 'required|numeric|min:0',
            'jumlah_pembelian' => 'required|integer|min:1',
        ]);

        // 2. Ambil data dari request yang sudah divalidasi
        $harga_satuan = $validated['harga_satuan'];
        $jumlah_pembelian = $validated['jumlah_pembelian'];
        $total_harga_awal = $harga_satuan * $jumlah_pembelian;
        
        $persentase_diskon = 0;

        // 3. Implementasi logika diskon sesuai urutan prioritas
        if ($jumlah_pembelian % 500 == 0) {
            $persentase_diskon = 50; // Diskon 50%
        } elseif ($jumlah_pembelian % 100 == 0) {
            // Sesuai aturan, jika habis dibagi 100 (tapi bukan 500), tidak ada diskon
            $persentase_diskon = 0;
        } elseif ($jumlah_pembelian % 40 == 0) {
            $persentase_diskon = 10; // Diskon 10%
        }
        // Jika tidak memenuhi semua kondisi di atas, persentase_diskon tetap 0 (default)

        // 4. Kalkulasi harga akhir
        $nilai_diskon = $total_harga_awal * ($persentase_diskon / 100);
        $harga_akhir = $total_harga_awal - $nilai_diskon;

        return view('katalog', [
            'hasil' => [
                'harga_satuan' => $harga_satuan,
                'jumlah_pembelian' => $jumlah_pembelian,
                'total_harga_awal' => $total_harga_awal,
                'persentase_diskon' => $persentase_diskon,
                'nilai_diskon' => $nilai_diskon,
                'harga_akhir' => $harga_akhir,
            ]
        ])->withInput($request->all()); 
    }
}
