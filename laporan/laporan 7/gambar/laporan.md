# **LAPORAN PRAKTIKUM**
## **Modul: HTTP Client & API Fetching**
### **Workshop Web Lanjut**

**Nama**  : Jelita Anggraini  
**NIM**   : 2024573010015  
**Kelas** : TI-2C  
**Tanggal** : 17 November 2025  

---

# **Abstrak**

Praktikum ini membahas penerapan *HTTP Client* pada Laravel untuk berinteraksi dengan layanan API eksternal.  
Mahasiswa mempelajari bagaimana Laravel mengirim permintaan HTTP seperti GET, POST, PUT, dan DELETE, serta
menangani respons yang diberikan server. Selain itu, praktikum menjelaskan penggunaan fitur bawaan Laravel
untuk pemanggilan API, cara memproses data respons, dan bagaimana menangani error ketika permintaan ke
server gagal.

---

# **Tujuan**

1. Memahami konsep dasar komunikasi API menggunakan HTTP Client Laravel.
2. Mengimplementasikan request GET, POST, PUT, dan DELETE ke API eksternal.
3. Mengelola data respons API dan menampilkannya pada view.
4. Menggunakan error handling untuk menangani masalah seperti timeout atau server error.
5. Mempraktikkan integrasi API ke dalam aplikasi Laravel secara terstruktur.

---

# **Dasar Teori**

## **1. Pengertian HTTP Client di Laravel**
Laravel menyediakan fitur *HTTP Client* berbasis Guzzle yang memungkinkan aplikasi mengirim permintaan HTTP
ke server lain. Dengan fitur ini, aplikasi dapat mengambil data, mengirim data, atau memodifikasi data yang
tersimpan pada API eksternal.

Laravel HTTP Client memiliki kelebihan:
- Sintaks sederhana
- Mendukung async request
- Menyediakan fitur retry
- Mendukung error handling otomatis

---

## **2. Jenis HTTP Method yang Sering Digunakan**

| Method | Fungsi | Contoh Penggunaan |
|-------|--------|-------------------|
| GET | Mengambil data dari server | List user, detail barang |
| POST | Mengirim data baru | Registrasi, tambah data |
| PUT | Mengubah data yang sudah ada | Update profil |
| DELETE | Menghapus data | Hapus item |

---

## **3. Alur Kerja Pemanggilan API Menggunakan HTTP Client**

1. Client mengirim request (GET/POST/PUT/DELETE) menggunakan Laravel HTTP::method().
2. Server API memproses permintaan dan mengembalikan respons (JSON).
3. Laravel memparsing respons menjadi collection atau array.
4. Data dikirim ke view untuk ditampilkan.
5. Jika terjadi kesalahan, Laravel menangani error dan memberikan pesan ke pengguna.

---

## **4. Contoh Penggunaan HTTP Client**

### GET Request:
```php
$response = Http::get('https://jsonplaceholder.typicode.com/posts');
$data = $response->json();
```
### POST Request:
```
$response = Http::post('https://jsonplaceholder.typicode.com/posts', [
    'title' => 'Belajar HTTP Client',
    'body' => 'Ini contoh konten.',
]);
```
Langkah–Langkah Praktikum
Praktikum 1 — GET Data dari API (JSONPlaceholder)
Langkah 1: Membuat Project Baru