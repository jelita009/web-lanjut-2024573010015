<!-- # **LAPORAN PRAKTIKUM 8**
## **HTTP Client & API Fetching (Lanjutan)**

**Mata Kuliah:** Workshop Web Lanjut
**Nama**  : Jelita Anggraini  
**NIM**   : 2024573010015  
**Kelas** : TI-2C  
**Tanggal** : 17 November 2025  

---

## Abstrak

Praktikum ini mengambil topik lanjutan dari pemanggilan API dengan Laravel, di mana mahasiswa mempelajari pengiriman permintaan ke server, pengolahan data respons, serta penerapan mekanisme otentikasi dan pengelolaan token. Tujuannya adalah agar aplikasi Laravel dapat berkomunikasi dengan aman dan efisien ke layanan backend eksternal.

---

## Tujuan

1. Memahami cara kerja otentikasi API (misalnya Bearer Token) dalam Laravel.  
2. Mengimplementasikan request HTTP yang memerlukan header khusus atau token.  
3. Memproses data respons yang kompleks, termasuk nested objek dan koleksi.  
4. Menangani skenario gagal koneksi atau otorisasi (status 4xx/5xx).  
5. Menerapkan best-practice integrasi API ke dalam aplikasi Laravel.

---

## Dasar Teori

### 1. Otentikasi API dan Token

Api eksternal sering mengharuskan klien memiliki token akses. Token ini dikirim dalam header Authorization sebagai `Bearer <token>`. Dalam Laravel, header dapat disisipkan pada request HTTP Client.

### 2. HTTP Client dengan Header dan Middleware

Dalam Laravel, kita dapat menambahkan header seperti berikut:
```php
    $response = Http::withHeaders([
        'Authorization' => 'Bearer '.$token,
        'Accept'        => 'application/json',
    ])->get($url);
```
Selain itu, fitur middleware bisa digunakan untuk mem‐hook sebelum/ sesudah request.

### 3. Struktur Respons Kompleks dan Pemrosesan

Respons API bisa berisi objek dalam objek atau array dalam array. Laravel menyederhanakannya dengan metode json() yang menghasilkan array asosiatif atau koleksi. Kemudian kita bisa menggunakan collection helpers untuk mempermudah pengolahan.

### 4. Penanganan Error: Kegagalan dan Respon Tidak Valid

HTTP Client Laravel menyediakan metode seperti successful(), failed(), retry(), dan throw() untuk mendeteksi status respons. Ini penting saat server mengembalikan status 401, 403, 404, atau 500.

## Langkah–Langkah Praktikum
### Praktikum 1 — Konfigurasi Otentikasi API dan Request Berheader
- Langkah 1: Siapkan Project Laravel Baru
```
laravel new api-secure
cd api-secure
code .
```

- Langkah 2: Pasang Paket Otentikasi (Opsional)
Jika API membutuhkan OAuth2 atau paket lainnya:
```
    composer require laravel/passport
    php artisan passport:install
```
- Langkah 3: Tambahkan Route dan Controller

File: routes/web.php
```
    use App\Http\Controllers\SecureApiController;
    Route::get('/secure-data', [SecureApiController::class, 'fetchSecureData'])->name('secure.fetch');
```

Lalu buat controller:
```
    php artisan make:controller SecureApiController
```

- Langkah 4: Buat Fungsi Controller untuk Request Berheader

File: app/Http/Controllers/SecureApiController.php
```
    namespace App\Http\Controllers;

    use Illuminate\Support\Facades\Http;
    use Illuminate\Http\Request;

    class SecureApiController extends Controller
    {
        public function fetchSecureData(Request $request)
        {
            $token   = 'YOUR_ACCESS_TOKEN';
            $endpoint = 'https://example.com/api/secure-endpoint';

            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$token,
                'Accept'        => 'application/json',
            ])->get($endpoint);

            if ($response->failed()) {
                return view('error')->with('message', 'Gagal mengakses API.');
            }

            $data = $response->json();

            return view('securedata', compact('data'));
        }
    }
```
- Langkah 5: Buat View untuk Menampilkan Data

File: resources/views/securedata.blade.php
```
    <!DOCTYPE html>
    <html>
    <head>
        <title>Secure Data</title>
    </head>
    <body>
        <h2>Data Terproteksi dari API</h2>

        <pre>{{ print_r($data, true) }}</pre>
    </body>
    </html>
```

Jalankan:
```
    php artisan serve
```
Akses ke: http://localhost:8000/secure-data

### Praktikum 2 — Pemrosesan Respons Kompleks & Koleksi
- Langkah 1: Tambah Route Baru
```
    Route::get('/complex-data', [SecureApiController::class, 'fetchComplex'])->name('secure.complex');
```
- Langkah 2: Fungsi Controller untuk Respons Nested
```
    public function fetchComplex()
    {
        $token    = 'YOUR_ACCESS_TOKEN';
        $endpoint = 'https://example.com/api/complex-endpoint';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token,
            'Accept'        => 'application/json',
        ])->get($endpoint);

        if ($response->failed()) {
            return view('error')->with('message', 'Gagal mengambil data kompleks.');
        }

        $raw   = $response->json();
        $items = collect($raw['data'])->map(function ($item) {
            return [
                'id'    => $item['id'],
                'name'  => $item['attributes']['name'],
                'value' => $item['attributes']['value'],
            ];
        });

        return view('complexdata', compact('items'));
    }
```
- Langkah 3: Buat View

File: resources/views/complexdata.blade.php
```
    <!DOCTYPE html>
    <html>
    <head>
        <title>Complex Data</title>
    </head>
    <body>
        <h2>Hasil Pemrosesan Koleksi</h2>

        <ul>
            @foreach ($items as $item)
                <li>{{ $item['name'] }}: {{ $item['value'] }}</li>
            @endforeach
        </ul>
    </body>
    </html>
```
### Praktikum 3 — Error Handling Lanjutan, Retry, Timeout
- Langkah 1: Route Tambahan
```
    Route::get('/robust-data', [SecureApiController::class, 'fetchRobust'])->name('secure.robust');
```
- Langkah 2: Controller dengan Retry dan Timeout
```
    public function fetchRobust()
    {
        $token    = 'YOUR_ACCESS_TOKEN';
        $endpoint = 'https://example.com/api/unstable-endpoint';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token,
            'Accept'        => 'application/json',
        ])->retry(5, 200)->timeout(10)->get($endpoint);

        if ($response->clientError()) {
            return view('error')->with('message', 'Permintaan tidak valid (client error).');
        }
        if ($response->serverError()) {
            return view('error')->with('message', 'Kesalahan server.');
        }

        $data = $response->json();

        return view('robustdata', compact('data'));
    }
```

- Langkah 3: View untuk Hasil

File: resources/views/robustdata.blade.php
```  <!DOCTYPE html>
    <html>
    <head>
        <title>Robust Data</title>
    </head>
    <body>
        <h2>Data dari Endpoint Tidak Stabil</h2>

        <pre>{{ print_r($data, true) }}</pre>
    </body>
    </html>
```
--- 

## Hasil dan Pembahasan

Pada praktikum ini, aplikasi Laravel berhasil mengakses API yang dilindungi dengan token, memproses respons yang kompleks, dan menghadapi skenario kegagalan seperti timeout dan error server.
Pada Praktikum 1, data berhasil ditampilkan dengan syarat otentikasi. Pada Praktikum 2, koleksi data di‐map ke struktur yang lebih mudah dipakai di view. Pada Praktikum 3, mekanisme retry dan timeout terbukti membantu ketika endpoint “tidak stabil”.

Beberapa hal yang perlu diperhatikan:

Pastikan token valid dan header tersusun dengan benar.

Respons API bisa berubah struktur → pemrosesan koleksi perlu penyesuaian.

Retry/timeout tidak menggantikan desain API yang stabil, namun memperkuat sisi klien.
```
--- 

## Kesimpulan

Dari keseluruhan praktikum dapat disimpulkan bahwa:

Laravel memiliki HTTP Client yang sangat fleksibel untuk komunikasi API aman.

Pemrosesan respons kompleks dapat ditangani dengan koleksi dan mapping.

Penanganan error seperti retry, timeout, dan pengecekan status sangat penting untuk aplikasi yang siap produksi.

Integrasi API bukan hanya soal “mengambil data”, tapi juga “mengelola” dan “melindungi” data.

---

## Referensi

Materi Praktikum — HTTP Client & API Fetching (Lanjutan)
https://hackmd.io/@mohdrzu/BypBawklWg

Dokumentasi Laravel — HTTP Client
https://laravel.com/docs/http-client -->

# Laporan Modul 8: Authentication & Authorization

**Mata Kuliah:** Workshop Web Lanjut  
**Nama:** Jelita Anggraini
**NIM:** 2024573010015
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
