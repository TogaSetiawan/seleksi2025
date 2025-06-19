<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_potongan_harga_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('potongan_harga', function (Blueprint $table) {
            $table->id('id_potongan')->comment('ID unik untuk setiap aturan potongan harga, Primary Key.');
            $table->string('nama_aturan')->comment('Deskripsi singkat aturan, misal: "Diskon Kelipatan 500".');
            $table->unsignedInteger('syarat_habis_dibagi')->unique()->comment('Angka pembagi untuk syarat, misal: 500, 100, 40.');
            $table->decimal('persentase_diskon', 5, 2)->comment('Nilai diskon dalam persen, misal: 50.00, 10.00.');
            $table->unsignedTinyInteger('prioritas')->comment('Prioritas eksekusi aturan (angka lebih kecil lebih dulu). Penting untuk logika.');
        });

        DB::statement("ALTER TABLE potongan_harga COMMENT='Tabel untuk mendefinisikan aturan potongan harga secara dinamis.'");
    }

    public function down()
    {
        Schema::dropIfExists('potongan_harga');
    }
};