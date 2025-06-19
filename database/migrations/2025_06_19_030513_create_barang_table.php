<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_barang_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id('id_barang')->comment('ID unik untuk setiap barang, Primary Key.');
            $table->string('nama_barang')->comment('Nama lengkap dari barang.');
            $table->decimal('harga', 15, 2)->comment('Harga satuan barang. Menggunakan DECIMAL untuk presisi keuangan.');
            $table->unsignedInteger('jumlah_stok')->default(0)->comment('Jumlah stok barang yang tersedia saat ini.');
            $table->timestamps(); // Ini akan membuat kolom created_at dan updated_at
        });

        // Menambahkan comment untuk tabel setelah dibuat (opsional, tapi bagus)
        DB::statement("ALTER TABLE barang COMMENT='Tabel untuk menyimpan data master barang di e-katalog.'");
    }

    public function down()
    {
        Schema::dropIfExists('barang');
    }
};