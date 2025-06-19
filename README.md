Aplikasi E-Katalog Pemerintah - Studi Kasus Laravel
Aplikasi web sederhana yang dibangun dengan framework Laravel untuk mensimulasikan perhitungan diskon pada sistem E-Katalog Pemerintah berdasarkan jumlah pembelian barang.

Fitur
Form input untuk harga satuan dan jumlah pembelian.

Kalkulasi diskon otomatis berdasarkan aturan bisnis yang ditentukan.

Menampilkan rincian perhitungan: total harga awal, persentase diskon, dan harga akhir.

Validasi input untuk memastikan data yang dimasukkan benar.

Ketentuan Diskon
Sistem menerapkan potongan harga dengan aturan sebagai berikut:

Jika angka pembelian habis dibagi 500, pembeli mendapat potongan harga 50%.

Jika angka pembelian tidak habis dibagi 500 tetapi habis dibagi 100, maka tidak ada potongan harga.

Jika angka pembelian tidak habis dibagi 500 dan 100, tetapi habis dibagi 40, pembeli mendapat potongan harga 10%.

Jika tidak memenuhi semua kondisi di atas, maka tidak ada potongan harga.

Prasyarat
PHP >= 8.1

Composer

Web Server (misal: Nginx, Apache) atau bisa menggunakan server bawaan Laravel.

Database (misal: MySQL, MariaDB).

Instruksi Menjalankan Aplikasi
Berikut adalah langkah-langkah untuk menginstal dan menjalankan proyek ini di komputer lokal Anda.

1. Clone Repository
Buka terminal atau command prompt, lalu clone repository ini ke direktori pilihan Anda.

git clone https://link-ke-repository-anda.git
cd nama-folder-proyek

2. Install Dependencies
Install semua paket PHP yang dibutuhkan oleh Laravel melalui Composer.

composer install

3. Setup Environment File
Salin file .env.example menjadi .env. File ini berisi semua konfigurasi aplikasi, termasuk koneksi database.

cp .env.example .env

Setelah itu, buat kunci aplikasi unik dengan perintah Artisan.

php artisan key:generate

4. Konfigurasi Database
Buka file .env yang baru saja Anda buat dan atur detail koneksi database Anda.

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_ekatalog
DB_USERNAME=root
DB_PASSWORD=

Pastikan Anda sudah membuat database kosong bernama db_ekatalog (atau nama lain sesuai konfigurasi) di phpMyAdmin atau tool database Anda.

5. Jalankan Migrasi Database
Jalankan perintah migrasi untuk membuat semua tabel yang dibutuhkan oleh aplikasi di dalam database Anda.

php artisan migrate

Jika ada data awal yang perlu dimasukkan (Seeder), jalankan perintah berikut:

php artisan db:seed

6. Jalankan Server Pengembangan
Gunakan perintah Artisan serve untuk menjalankan server pengembangan bawaan Laravel.

php artisan serve

7. Akses Aplikasi
Buka browser Anda dan kunjungi alamat berikut:
http://127.0.0.1:8000/katalog

Anda sekarang dapat memasukkan harga dan jumlah pembelian untuk menguji fungsionalitas kalkulator diskon.