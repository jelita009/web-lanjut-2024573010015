# Laporan Modul 8: Authentication & Authorization

**Mata Kuliah:** Workshop Web Lanjut  
**Nama:** Ahmad Aulia Fahlevi  
**NIM:** 2024573010077  
**Kelas:** TI-2C

---

## Abstrak

Praktikum Modul 8 membahas penerapan mekanisme keamanan pada aplikasi web berbasis Laravel yang meliputi Autentikasi dan Otorisasi. Autentikasi diterapkan untuk memastikan keabsahan identitas pengguna melalui fitur login dan registrasi menggunakan Laravel Breeze. Selanjutnya, konsep Otorisasi diimplementasikan dengan pendekatan Role-Based Access Control (RBAC), yaitu pengaturan hak akses berdasarkan peran pengguna seperti admin, manager, dan user. Implementasi dilakukan dengan menambahkan atribut role pada tabel pengguna serta membuat middleware khusus untuk membatasi akses ke rute tertentu. Hasil praktikum menunjukkan bahwa Laravel menyediakan struktur keamanan yang sistematis dan mudah dikembangkan untuk membangun aplikasi web yang aman dan terkontrol.

---

## 1. Dasar Teori

Dasar teori pada praktikum ini menitikberatkan pada konsep keamanan aplikasi web serta bagaimana Laravel mengimplementasikannya.

### 1.1 Autentikasi (Authentication)

* **Pengertian:** Autentikasi adalah proses untuk memverifikasi identitas pengguna sebelum diberikan akses ke sistem.
* **Implementasi pada Laravel:** Laravel menyediakan starter kit seperti Laravel Breeze yang secara otomatis menghasilkan fitur login, register, logout, dan pengelolaan sesi pengguna.
* **Keamanan:** Password pengguna disimpan dalam bentuk hash menggunakan algoritma bcrypt sehingga lebih aman.
* **Middleware auth:** Digunakan untuk membatasi akses rute agar hanya dapat diakses oleh pengguna yang telah login.

### 1.2 Otorisasi (Authorization)

* **Pengertian:** Otorisasi merupakan proses penentuan hak akses pengguna terhadap sumber daya tertentu setelah berhasil diautentikasi.
* **Pendekatan Laravel:** Laravel mendukung otorisasi melalui Gates, Policies, dan Middleware.
* **Role-Based Access Control (RBAC):**

  * Setiap pengguna memiliki peran tertentu.
  * Hak akses ditentukan berdasarkan peran tersebut.
  * Pada praktikum ini, RBAC diimplementasikan menggunakan middleware kustom yang memeriksa role pengguna.

### 1.3 Komponen Pendukung

* **Migration:** Digunakan untuk menambahkan kolom role pada tabel users.
* **Seeder:** Digunakan untuk membuat data pengguna awal dengan peran yang berbeda.
* **Middleware Kustom:** Digunakan untuk memvalidasi apakah pengguna memiliki peran yang sesuai sebelum mengakses rute.

---

## 2. Langkah-Langkah Praktikum

### 2.1 Praktikum 1 – Implementasi Autentikasi dengan Laravel Breeze

1. Menginstal Laravel Breeze menggunakan Composer.
2. Menjalankan perintah `php artisan breeze:install` dan memilih Blade sebagai frontend.
3. Menjalankan migrasi database untuk membuat tabel pengguna.
4. Mengakses halaman register dan login melalui browser.
5. Membuat rute profil yang dilindungi oleh middleware `auth`.
6. Menguji rute tersebut untuk memastikan hanya pengguna yang telah login yang dapat mengaksesnya.

### 2.2 Praktikum 2 – Otorisasi Berbasis Peran (RBAC)

1. Menambahkan kolom `role` pada tabel users melalui migration.
2. Menjalankan migrasi untuk memperbarui struktur database.
3. Membuat seeder untuk menambahkan akun admin, manager, dan user.
4. Membuat middleware `RoleMiddleware` untuk memeriksa peran pengguna.
5. Mendaftarkan middleware pada file konfigurasi aplikasi.
6. Membuat view terpisah untuk setiap peran (admin, manager, user, dan all).
7. Mendefinisikan rute dengan middleware role sesuai kebutuhan.
8. Menguji akses tiap akun untuk memastikan pembatasan berjalan dengan benar.

---

## 3. Hasil dan Pembahasan

### 3.1 Hasil Praktikum

* Sistem autentikasi berhasil berjalan dengan baik menggunakan Laravel Breeze, ditandai dengan berfungsinya fitur login dan register.
* Rute yang dilindungi middleware `auth` tidak dapat diakses oleh pengguna yang belum login.
* Sistem otorisasi berbasis peran berhasil diterapkan, di mana setiap pengguna hanya dapat mengakses halaman sesuai dengan perannya.
* Akses tidak sah akan menghasilkan respons error 403 (Forbidden).

### 3.2 Mekanisme Validasi Input di Laravel

* Laravel secara otomatis melakukan validasi input pada proses registrasi.
* Field seperti email dan password divalidasi agar sesuai dengan aturan yang ditentukan.
* Password pengguna diamankan dengan hashing sebelum disimpan ke database.

### 3.3 Peran Route, Controller, dan View

* **Route:** Menentukan jalur aplikasi serta middleware keamanan yang digunakan.
* **Controller:** Mengelola logika aplikasi, termasuk autentikasi dan pengambilan data pengguna.
* **View:** Menampilkan antarmuka yang sesuai dengan status autentikasi dan peran pengguna.

---

## 4. Kesimpulan

Berdasarkan praktikum yang telah dilakukan, dapat disimpulkan bahwa Laravel menyediakan mekanisme autentikasi dan otorisasi yang kuat dan terstruktur. Laravel Breeze mempermudah implementasi autentikasi dasar, sedangkan middleware kustom memungkinkan penerapan kontrol akses berbasis peran secara fleksibel. Dengan kombinasi kedua mekanisme tersebut, aplikasi web dapat dibangun dengan tingkat keamanan yang lebih baik dan terkontrol sesuai kebutuhan pengguna.

---

## 5. Referensi

* Laravel Documentation – Authentication & Authorization. [https://laravel.com/docs/authentication](https://laravel.com/docs/authentication)
* Traversy Media. *Laravel Authentication Tutorial*. [https://www.youtube.com/@TraversyMedia](https://www.youtube.com/@TraversyMedia)
* DigitalOcean Community. *How To Set Up Authentication and Authorization in Laravel*. [https://www.digitalocean.com/community](https://www.digitalocean.com/community)
