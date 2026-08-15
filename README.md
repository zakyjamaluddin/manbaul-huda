# Website Resmi MI Manbaul Huda

Repository ini berisi **source code website resmi MI Manbaul Huda**.

Website dikembangkan menggunakan:

* Laravel 13
* Filament 5
* PHP
* SQLite

## Instalasi

Panduan berikut ditujukan untuk server dengan sistem operasi **Linux**.

### 1. Clone Repository

Clone repository ke server:

```bash
git clone https://github.com/zakyjamaluddin/manbaul-huda.git .
```

### 2. Cek Versi PHP

Pastikan server menggunakan PHP yang memenuhi requirement Laravel 13:

```bash
php -v
```

Minimum:

```text
PHP >= 8.3
```

Jika versi PHP belum memenuhi requirement, upgrade PHP terlebih dahulu.

### 3. Persiapkan `deploy.sh`

Berikan izin eksekusi pada file `deploy.sh` sekaligus membersihkan karakter Enter Windows (`CRLF`) jika repository pernah dibuat atau diedit menggunakan Windows:

```bash
sed -i 's/\r$//' deploy.sh
chmod +x deploy.sh
```

### 4. Jalankan Deployment

Setelah file siap, jalankan:

```bash
sudo ./deploy.sh
```

Script `deploy.sh` akan menjalankan proses instalasi dan deployment aplikasi sesuai konfigurasi yang telah disiapkan.

## Catatan

Repository ini menyertakan file:

```text
.env
.htaccess
```

Pastikan konfigurasi `.env` sudah sesuai dengan server, terutama konfigurasi database.

File `.htaccess` digunakan untuk kebutuhan routing Laravel pada server Apache.

---

**MI Manbaul Huda**

> Ora Ninggal Tuntunan lan Ora Ketinggalan Jaman
