## Instalasi dan Penggunaan Laravel CRUD API with Auth

Dokumentasi ini memberikan panduan instalasi dan penggunaan Laravel CRUD API dengan modul otentikasi. Ini juga termasuk otentikasi JWT dan dokumentasi API Swagger.

### Persyaratan

Pastikan Anda memiliki lingkungan pengembangan yang sudah terpasang dengan persyaratan berikut:

1. PHP 8.x
2. Composer
3. Laravel 9.x
4. MySQL Database Server

### Langkah 1: Clone Repositori

Pertama, clone repositori dari GitHub:

```bash
git clone https://github.com/jauharimalik/cekapi
cd cekapi
```

### Langkah 2: Konfigurasi Lingkungan

Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Buka file `.env` dan konfigurasi koneksi database sesuai dengan pengaturan Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=testindosat
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

### Langkah 3: Migrasi Database

Migrate database dengan menjalankan perintah berikut:

```bash
php artisan migrate
```

### Langkah 4: Generate Swagger API

Generate dokumentasi Swagger API dengan menjalankan perintah berikut:

```bash
php artisan l5-swagger:generate
```

### Langkah 5: Menjalankan Server

Jalankan server Laravel:

```bash
php artisan serve
```

Server akan berjalan pada alamat `http://127.0.0.1:8000`.

### Langkah 6: Mengakses API Documentation

Buka browser dan akses API documentation melalui URL berikut:

```
http://127.0.0.1:8000/api/documentation
```

Anda akan melihat panel Swagger yang berisi dokumentasi API.

## Cara Menggunakan API

1. Pertama, lakukan login dengan menggunakan kredensial yang diberikan atau kredensial pengguna lain yang telah Anda daftarkan.

2. Atur bearer token sebagai otorisasi header dalam setiap permintaan API yang Anda kirim.

3. Lakukan permintaan API sesuai dengan yang Anda inginkan.

## Contoh Penggunaan API

### Get List of Movies

```
GET /flix/api/movies
```

Mengembalikan daftar film.

### Create a New Movie

```
POST /flix/api/movies
```

Membuat rekaman film baru.

Body Permintaan (Contoh):

```json
{
    "title": "Pengabdi Setan 2 Comunion",
    "description": "Sebuah film horor Indonesia tahun 2022...",
    "rating": 7.0,
    "kode": "123",
    "image": ""
}
```

### Get Movie by ID

```
GET /flix/api/movies/{movie}
```

Mengembalikan detail film berdasarkan ID.

### Update Movie

```
PATCH /flix/api/movies/{movie}
```

Mengupdate film berdasarkan ID.

Body Permintaan (Contoh):

```json
{
    "title": "Pengabdi Setan 2 Comunion (Updated)",
    "description": "Deskripsi film yang telah diubah...",
    "rating": 8.0,
    "kode": "456",
    "image": ""
}
```

### Delete Movie

```
DELETE /flix/api/movies/{movie}
```

Menghapus film berdasarkan ID.

Ini adalah panduan instalasi dan penggunaan Laravel CRUD API dengan modul otentikasi. Semoga membantu Anda dalam mengimplementasikan aplikasi Anda. Jika Anda memiliki pertanyaan lebih lanjut atau memerlukan bantuan lebih lanjut, jangan ragu untuk bertanya.
