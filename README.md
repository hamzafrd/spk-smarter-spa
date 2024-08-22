# LandWise - Sistem Pendukung Keputusan Pemilihan Tanah Perumahan Berbasis Web

Aplikasi ini adalah sistem pendukung keputusan untuk pemilihan tanah perumahan menggunakan metode SMARTER. Aplikasi ini terdiri dari dua bagian utama: halaman beranda (home) untuk pengguna umum dan halaman admin yang dapat diakses setelah login.

## **Fitur**

- **Halaman Home**: Informasi dasar tentang aplikasi dan fitur pemilihan tanah.
- **Halaman Admin**: Mengelola data kriteria, sub-kriteria, serta pemilihan tanah berdasarkan preferensi pengguna.

## **Instalasi**

### **Prasyarat**

Sebelum menginstal aplikasi ini, pastikan Anda sudah menginstal beberapa perangkat lunak berikut:

- PHP >= 8.3
- Composer
- Node.js & NPM
- MySQL atau DBMS lain yang didukung Laravel

### **Langkah-langkah Instalasi**

1. **Clone Repository**

   ```bash
   git clone https://github.com/hamzafrd/spk-smarter-spa.git
   cd spk-smarter-spa-main
   ```

2. **Salin File Konfigurasi**

   ```bash
   cp .env.example .env
   ```

3. **Instal Dependensi**

   - Instal dependensi PHP menggunakan Composer:
     ```bash
     composer install
     ```
   - Instal dependensi frontend menggunakan NPM:
     ```bash
     npm install
     ```

4. **Generate Key Aplikasi**

   ```bash
   php artisan key:generate
   ```

5. **Konfigurasi Database**

   - Buka file `.env` dan sesuaikan konfigurasi database Anda:
     ```plaintext
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=smarter_laravel_spa
     DB_USERNAME=username_anda
     DB_PASSWORD=password_anda
     ```

6. **Migrasi dan Seed Database**

   ```bash
   php artisan migrate --seed
   ```

7. **Kompilasi Asset Frontend**

   ```bash
   npm run dev
   ```

8. **Jalankan Aplikasi**

   ```bash
   php artisan serve
   ```

   Aplikasi akan berjalan di `http://localhost:8000`.

## **Penggunaan**

- **Halaman Home**: Akses halaman home di `http://localhost:8000` untuk melihat informasi umum dan fitur pemilihan tanah.
- **Halaman Admin**: Akses halaman admin di `http://localhost:8000/dashboard` setelah login. Anda bisa mengelola data kriteria, sub-kriteria, dan proses pemilihan tanah.

## **Lisensi**

Aplikasi ini dilisensikan di bawah [MIT License](LICENSE).
