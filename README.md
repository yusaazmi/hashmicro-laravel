# Panduan Penggunaan

Ini adalah aplikasi test Hashmicro
Berisi Simple CRUD, relasi model, fitur pengecekan input dan Role permission
Ini adalah requirement untuk menjalankan aplikasi:

- [PHP](https://www.php.net/) (versi 8.2.0 atau lebih tinggi)
- [Composer](https://getcomposer.org/) (versi 2.7 atau lebih tinggi) 
- [Laravel](https://laravel.com/) (versi 11)
- [Database](https://www.mysql.com/) (MySQL, versi 8.1)

## Instalasi

1. Pastikan Anda memiliki PHP, Composer, dan MySQL terpasang di komputer Anda.
2. Clone repositori ini ke komputer Anda.
3. Buka terminal dan navigasikan ke direktori proyek.
4. Jalankan perintah berikut untuk menginstal semua dependensi:

    ```bash
    composer install
    ```

5. Salin file `.env.example` menjadi `.env`:

    ```bash
    cp .env.example .env
    ```

6. Generate kunci aplikasi:

    ```bash
    php artisan key:generate
    ```

7. Atur koneksi basis data Anda di dalam file `.env`.
8. Jalankan migrasi untuk membuat tabel basis data:

    ```bash
    php artisan migrate:fresh
    ```

9. Jalankan seeder untuk mengisi data awal ke dalam basis data:

    ```bash
    php artisan db:seed
    ```
10. Untuk menjalankan aplikasi anda dapat menggunakan perintah berikut :
    ```bash
    php artisan serve
    ```
    Kemudian masuk ke
    ```bash
    http://127.0.0.1:8000/login
    ```
11. Anda bisa login dengan memasukkan email default admin
    ```bash
    username : admin@gmail.com
    password : password
    ```
