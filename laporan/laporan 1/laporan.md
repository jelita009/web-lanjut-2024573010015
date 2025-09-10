# Laporan Modul 1: Perkenalan Laravel
**Mata Kuliah:** Workshop Web Lanjut   
**Nama:** Jelita Anggraini  
**NIM:** 2024573010015
**Kelas:** TI-2C

---

## Abstrak 
Laporan ini berisi penjelasan mengenai langkah-langkah instalasi, konfigurasi, dan pengujian framework Laravel. Di dalamnya dijelaskan bagaimana proses membangun aplikasi web berbasis arsitektur MVC (Model-View-Controller), mulai dari instalasi PHP, Composer, hingga menjalankan server Laravel menggunakan perintah php artisan serve. Selain itu, laporan juga memuat hasil uji coba berupa tampilan halaman awal Laravel yang menandakan instalasi berhasil dilakukan.

**Tujuan**

Laporan ini bertujuan untuk mendokumentasikan proses instalasi dan pengujian Laravel sebagai framework PHP modern, agar dapat memahami dasar penggunaan Laravel serta memudahkan pengembangan aplikasi web.

---

## 1. Pendahuluan
Laravel adalah framework PHP open-source yang dirancang untuk mempermudah pengembangan aplikasi web dengan sintaks yang elegan dan ekspresif. Laravel mengikuti pola desain Model-View-Controller (MVC). Pola ini memisahkan logika aplikasi menjadi tiga komponen utama:

+ Model – Mengelola data dan logika bisnis.
+ View – Menangani tampilan atau lapisan presentasi.
+ Controller – Bertindak sebagai penghubung antara model dan view, memproses input pengguna, lalu menampilkan respons.

- Karakteristik utama (MVC, opinionated, dsb.)
1. MVC (Model–View–Controller)
    * Laravel menggunakan arsitektur MVC yang memisahkan logika aplikasi (Controller), pengelolaan data (Model), dan tampilan (View).
    * Dengan pola ini, kode menjadi lebih terstruktur, mudah dikelola, dan bisa dikerjakan oleh tim secara paralel.
2. Opinionated Framework
    * Laravel termasuk framework yang opinionated, artinya sudah memiliki aturan, standar, dan cara kerja tertentu yang dianggap “terbaik” oleh pengembangnya.
3. Elegant Syntax
    * Laravel dikenal dengan sintaks yang bersih, sederhana, dan ekspresif, sehingga kode lebih mudah dipahami.
4. Fitur Lengkap & Bawaan
    * Laravel sudah menyediakan banyak fitur bawaan seperti autentikasi, routing, Eloquent ORM, templating Blade, Artisan CLI, dan middleware.
5. Menyediakan fitur keamanan (CSRF, XSS, hashing password).
6. Ekosistem & Komunitas Besar
   * Laravel memiliki ekosistem yang luas (seperti Laravel Breeze, Jetstream, Livewire, Sanctum, Passport, dsb.) dan komunitas yang sangat aktif.
7. Mendukung Pengembangan Modern
   * Laravel mendukung REST API, integrasi dengan frontend modern (Vue, React, Inertia), serta memiliki tool untuk testing otomatis.

Laravel cocok untuk berbagai jenis aplikasi web, baik skala kecil maupun besar, seperti aplikasi e-commerce, sistem manajemen konten (CMS), aplikasi portal, aplikasi perusahaan, dan aplikasi khusus lainnya, berkat fitur-fitur bawaan, arsitektur MVC yang fleksibel, dan ekosistem pendukung yang kaya. 

---

## 2. Komponen Utama Laravel (ringkas)
Tuliskan penjelasan singkat (1–3 kalimat) untuk tiap komponen berikut:
1. Blade Templating Engine: Blade adalah mesin templating Laravel yang ringan, tapi tetap kuat. Blade memungkinkan pengembang untuk menggunakan sintaksis sederhana untuk membuat tampilan dinamis dan dapat digunakan kembali.

2. Eloquent ORM: Eloquent ORM adalah sistem ORM (Object-Relational Mapping) milik Laravel yang kuat dan mudah digunakan. Eloquent memungkinkan pengembang untuk berinteraksi dengan basis data menggunakan sintaksis yang elegan dan intuitif.

3. Routing: Laravel menyediakan sistem routing yang fleksibel dan mudah digunakan. Dengan Laravel, pengembang dapat dengan mudah menentukan rute untuk aplikasi mereka menggunakan metode yang sederhana dan mudah dibaca.

4. Migration dan Seeders: Laravel menyediakan sistem migrasi dan seeder yang kuat untuk mengelola skema basis data. Pengembang dapat dengan mudah membuat, mengubah, dan menghapus tabel serta mengisi tabel dengan data dummy untuk pengujian.

5. Artisan CLI: Artisan adalah command line interface (CLI) milik Laravel yang menawarkan berbagai perintah bawaan untuk mempermudah pengembangan. Dengan Artisan, pengembang dapat membuat kontroler, model, dan komponen lainnya hanya dengan beberapa perintah.

6. Middleware: Middleware di Laravel memungkinkan pengembang untuk memfilter HTTP request yang masuk ke aplikasi. Middleware sangat berguna untuk tugas-tugas seperti otentikasi pengguna dan validasi input.

---

## 3. Berikan penjelasan untuk setiap folder dan files yang ada didalam struktur sebuah project laravel.
- app/ → Folder app berisi kode-kode inti dari aplikasi seperti Model, Controller, Commands, Listener, Events, dll. Poinnya, hampir semua class dari aplikasi berada di folder ini.

- bootstrap/ → Folder bootstrap berisi file app.php yang dimana akan dipakai oleh Laravel untuk boot setiap kali dijalankan.

- config/ → Berisi file konfigurasi (database, mail, app, dll).

- database/ → Folder database berisi database migrations, model factories, dan seeds. Folder ini akan bertanggung jawab dengan pembuatan dan pengisian tabel-tabel database.

- public/ → Folder public memiliki file index.php yaitu entry point dari semua requests yang masuk/diterima ke aplikasi. Folder ini juga tempat menampung gambar, Javascript, dan CSS.

- resources/ → Folder resources berisi semua route yang disediakan aplikasi. Sebagai default, beberapa file routing akan tersedia seperti: web.php, api.php, console.php, dan channels.php. Folder ini adalah tempat dimana kita memberikan koleksi definisi route aplikasi.

- routes/ → File rute aplikasi (web.php, api.php, console.php).

- storage/ → Folder storage adalah tempat dimana cache, logs, dan file sistem yang ter-compile hidup.

- tests/ → Folder tests adalah tempat dimana unit dan integration tests tinggal.

- vendor/ → folder vendor Berisi semua library dari Composer.

---

## 4. Diagram MVC dan Cara kerjanya
Kerangka kerja MVC mencakup 3 komponen berikut:

* Controller
* Model
* View

![Diagram MVC](laporan/laporan1/gambar/Diagram MVC2.png)

1. User (Pengguna) → mengirim permintaan lewat browser, misalnya: "Tampilkan daftar siswa".
2. Controller (Pengontrol) → menerima permintaan itu, lalu memberi tahu Model untuk mengambil data yang dibutuhkan.
3. Model (Data/Logika) → mengambil data dari Database, misalnya daftar siswa.
+ Kalau berhasil → data dikirim ke Controller.
+ Kalau gagal (error) → pesan kesalahan dikirim ke Controller.
4. Controller → setelah dapat data, Controller kasih data itu ke View.
5. View (Tampilan) → mengubah data jadi HTML yang rapi agar bisa ditampilkan di browser.
6. Controller → mengirim hasil dari View kembali ke User.

---

## 6. Kelebihan & Kekurangan (refleksi singkat)
Kelebihan Laravel menurut saya:
- Sintaks rapi dan mudah dipahami.
- Fitur bawaan sudah lengkap (auth, ORM, Blade, dll).
- Dokumentasi dan komunitas besar, jadi gampang cari bantuan.

Tantangan bagi pemula:
- Struktur folder cukup kompleks, bikin bingung di awal.
- Perlu paham dasar OOP dan Composer.
- Agak berat dijalankan dibanding framework PHP sederhana.

---

## 7. Referensi
1. Dokumentasi Resmi Laravel — https://laravel.com/docs
2. Tutorial Laravel Dasar — https://www.petanikode.com/laravel-pemula/
3. MVC Explained — https://www.geeksforgeeks.org/mvc-framework-introduction/
4. web Blog Dicoding — https://www.dicoding.com/blog/kenalan-dengan-laravel-framework-php-yang-keren-dan-serbaguna/
5. web Blog barajaCoding — https://www.barajacoding.or.id/mengenal-struktur-folder-dan-file-pada-laravel/
6. Tutorial Rekayasa Peragkat Lunak — https://www.geeksforgeeks.org/software-engineering/mvc-framework-introduction/

---
