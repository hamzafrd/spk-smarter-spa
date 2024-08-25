# LandWise - Sistem Pendukung Keputusan Pemilihan Tanah Perumahan Berbasis Web
Aplikasi ini adalah sistem pendukung keputusan untuk pemilihan tanah perumahan menggunakan metode SMARTER. Aplikasi ini terdiri dari dua bagian utama: halaman beranda (home) untuk pengguna umum dan halaman admin yang dapat diakses setelah login.

## **Fitur**

- **Halaman Home**: Informasi dasar tentang aplikasi dan fitur pemilihan tanah.
- **Halaman Admin**: Mengelola data kriteria, sub-kriteria, serta pemilihan tanah berdasarkan preferensi pengguna.
- 
## **Beberapa Screenshot Aplikasi**
![Dashboard](https://github.com/user-attachments/assets/7e99126c-accc-4fdb-b4e2-c9819dbe1a52)
![Dashboard White](https://github.com/user-attachments/assets/c0de55e5-1f85-4200-81a7-c0bc73a76a60)
![Kriteria](https://github.com/user-attachments/assets/120e3c0b-ea88-4ff5-9a64-6aff3972f5fe)
![kriteria_atur posisi](https://github.com/user-attachments/assets/1ed2f172-298b-4af0-8365-9a009439ff7e)
![kritera_ modal sub](https://github.com/user-attachments/assets/560dac62-b023-4b2e-9f86-23a81181e3f6)

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
