<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_pembelian_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id('id_pembelian')->comment('ID unik untuk setiap transaksi pembelian, Primary Key.');
            
            // Definisi Foreign Key
            $table->foreignId('id_barang')->constrained('barang', 'id_barang')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('id_potongan_diterapkan')->nullable()->constrained('potongan_harga', 'id_potongan')->onUpdate('cascade')->onDelete('set null');

            $table->unsignedInteger('jumlah_beli')->comment('Jumlah unit barang yang dibeli dalam transaksi ini.');
            $table->decimal('harga_satuan_saat_transaksi', 15, 2)->comment('Harga satuan barang pada saat transaksi terjadi.');
            $table->decimal('total_harga_awal', 17, 2)->comment('Total harga sebelum diskon (jumlah * harga satuan).');
            $table->decimal('nilai_diskon', 17, 2)->default(0.00)->comment('Jumlah nominal diskon yang didapat.');
            $table->decimal('harga_akhir', 17, 2)->comment('Harga final setelah dikurangi diskon.');
            $table->timestamp('tanggal_pembelian')->useCurrent()->comment('Waktu transaksi dicatat.');
        });

        DB::statement("ALTER TABLE pembelian COMMENT='Tabel untuk mencatat riwayat transaksi pembelian.'");
    }

    public function down()
    {
        Schema::dropIfExists('pembelian');
    }
};