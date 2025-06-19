<?php
// database/seeders/PotonganHargaSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PotonganHargaSeeder extends Seeder
{
    public function run()
    {
        DB::table('potongan_harga')->insert([
            [
                'nama_aturan' => 'Diskon Pembelian Kelipatan 500',
                'syarat_habis_dibagi' => 500,
                'persentase_diskon' => 50.00,
                'prioritas' => 1,
            ],
            [
                'nama_aturan' => 'Tanpa Diskon Pembelian Kelipatan 100',
                'syarat_habis_dibagi' => 100,
                'persentase_diskon' => 0.00,
                'prioritas' => 2,
            ],
            [
                'nama_aturan' => 'Diskon Pembelian Kelipatan 40',
                'syarat_habis_dibagi' => 40,
                'persentase_diskon' => 10.00,
                'prioritas' => 3,
            ],
        ]);
    }
}