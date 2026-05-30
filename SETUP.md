# 📚 SETUP SISTEM INVENTARIS LABORATORIUM - PERTEMUAN 5

## 🚀 Urutan Perintah Terminal yang Harus Dijalankan

Ikuti urutan perintah berikut untuk menyelesaikan setup sistem:

### Step 1: Jalankan Migrations (Buat Tabel Baru)
```bash
php artisan migrate
```

**Output yang diharapkan:**
- Migration: 2026_05_29_044000_create_kondisis_table
- Migration: 2026_05_29_044100_alter_inventaris_add_kondisi_id

### Step 2: Jalankan Seeders (Isi Data Default)
```bash
php artisan db:seed
```

**Output yang diharapkan:**
- KondisiSeeder: Insert 3 kondisi (Baik, Rusak Ringan, Rusak Berat)
- KategoriSeeder: Insert 4 kategori (Laptop, Proyektor, Perangkat Jaringan, Aksesoris Lab)

### Step 3: Update Data Inventaris Existing (Opsional)
Jika Anda sudah memiliki data inventaris sebelumnya, jalankan query berikut via tinker:

```bash
php artisan tinker
```

Kemudian di dalam tinker, jalankan:
```php
>>> use App\Models\Inventaris;
>>> use App\Models\Kondisi;
>>> 
>>> // Ambil kondisi Baik
>>> $baik = Kondisi::where('nama', 'Baik')->first();
>>> 
>>> // Update semua inventaris existing untuk menggunakan kondisi_id
>>> Inventaris::whereNull('kondisi_id')->update(['kondisi_id' => $baik->id]);
>>> 
>>> // Verifikasi
>>> Inventaris::count();
>>> exit
```

### Step 4: Clear Cache (Opsional tapi Recommended)
```bash
php artisan cache:clear
php artisan config:cache
php artisan view:clear
```

### Step 5: Start Development Server
```bash
php artisan serve
```

Akses aplikasi di: **http://127.0.0.1:8000**

---

## 📋 File-File yang Telah Dibuat/Diupdate

### A. Migrations (Database)
- ✅ `database/migrations/2026_05_29_044000_create_kondisis_table.php` - Tabel kondisis baru
- ✅ `database/migrations/2026_05_29_044100_alter_inventaris_add_kondisi_id.php` - Tambah kolom kondisi_id ke inventaris

### B. Seeders
- ✅ `database/seeders/KondisiSeeder.php` - Baru (isi 3 kondisi default)
- ✅ `database/seeders/DatabaseSeeder.php` - Update (panggil KondisiSeeder)

### C. Models
- ✅ `app/Models/Kondisi.php` - Baru (Model untuk tabel kondisis)
- ✅ `app/Models/Inventaris.php` - Update (tambah relasi kondisi)
- ✅ `app/Models/Kategori.php` - Tidak perlu diubah

### D. Controllers
- ✅ `app/Http/Controllers/DashboardController.php` - Baru
- ✅ `app/Http/Controllers/KategoriController.php` - Baru (CRUD Kategori)
- ✅ `app/Http/Controllers/KondisiController.php` - Baru (CRUD Kondisi)
- ✅ `app/Http/Controllers/InventarisController.php` - Update (gunakan kondisi_id)

### E. Routes
- ✅ `routes/web.php` - Update (tambah resource routes untuk kategori, kondisi, dashboard)

### F. Views - Layout
- ✅ `resources/views/layouts/app.blade.php` - Redesign (tema putih-biru, sidebar navigasi, responsive)

### G. Views - Dashboard
- ✅ `resources/views/dashboard.blade.php` - Baru (statistik, ringkasan data)

### H. Views - Kategori
- ✅ `resources/views/kategori/index.blade.php` - Baru (list kategori dengan jumlah barang)
- ✅ `resources/views/kategori/create.blade.php` - Baru (form tambah kategori)
- ✅ `resources/views/kategori/edit.blade.php` - Baru (form edit kategori)

### I. Views - Kondisi
- ✅ `resources/views/kondisi/index.blade.php` - Baru (list kondisi dengan preview badge)
- ✅ `resources/views/kondisi/create.blade.php` - Baru (form tambah kondisi dengan live preview)
- ✅ `resources/views/kondisi/edit.blade.php` - Baru (form edit kondisi dengan live preview)

### J. Views - Inventaris
- ✅ `resources/views/inventaris/index.blade.php` - Update (statistik, filter kondisi_id, kolom ditambahkan)
- ✅ `resources/views/inventaris/create.blade.php` - Update (styling lebih rapi)
- ✅ `resources/views/inventaris/edit.blade.php` - Update (styling lebih rapi)
- ✅ `resources/views/inventaris/show.blade.php` - Update (layout detail lebih menarik)
- ✅ `resources/views/inventaris/_form.blade.php` - Update (gunakan kondisi_id, form styling)

---

## 🎯 Fitur-Fitur yang Sudah Diimplementasikan

### ✅ CRUD Kategori
- Halaman index dengan jumlah barang per kategori
- Form create/edit dengan validasi (kode unik, nama unik)
- Proteksi delete: tidak bisa hapus kategori jika ada barang
- Search/filter kategori
- Pagination (10 item per halaman)

### ✅ CRUD Kondisi
- Halaman index dengan preview badge warna
- Form create/edit dengan dropdown warna dan live preview
- Proteksi delete: tidak bisa hapus kondisi jika digunakan
- 3 kondisi default: Baik (hijau), Rusak Ringan (kuning), Rusak Berat (merah)
- Pagination (10 item per halaman)

### ✅ Update CRUD Inventaris
- Filter berdasarkan kondisi_id (bukan enum string lagi)
- Statistik kondisi di atas tabel (total baik, ringan, berat)
- Kolom "Ditambahkan" dengan format dd-mm-yyyy
- Badge warna kondisi di list dan detail
- Modal konfirmasi hapus (vanilla JS, tanpa library)
- Form lebih rapi dengan label di atas, input full-width

### ✅ Dashboard
- Kartu statistik: Total Inventaris, Total Kategori, Jenis Kondisi
- Ringkasan kondisi barang (hijau/kuning/merah)
- 5 barang terbaru ditambahkan (dengan kondisi badge)

### ✅ Tampilan & UX
- **Tema**: Putih dan biru modern (#1a73e8 primary)
- **Sidebar**: Navigasi kiri dengan menu Dashboard, Inventaris, Kategori, Kondisi
- **Topbar**: Sticky dengan judul halaman dan tanggal
- **Responsive**: Mobile-friendly (tested di 768px, 480px)
- **Breadcrumb**: Support untuk navigasi (siap di views)
- **Badges**: Warna berbeda untuk kategori (biru) dan kondisi (hijau/kuning/merah)
- **Alert**: Auto-hide setelah 3 detik dengan animasi
- **Buttons**: Icon unicode + label, hover effect, multiple styles
- **Tables**: Striped, hover highlight, shadow ringan, pagination biru
- **Form**: Label di atas, focus ring biru, error styling, full-width inputs
- **Modal**: Delete confirmation modal vanilla CSS+JS

---

## 🔍 Testing Checklist

Setelah setup selesai, coba hal-hal berikut:

### Dashboard
- [ ] Akses http://127.0.0.1:8000 - harus menampilkan dashboard
- [ ] Pastikan statistik total menunjukkan angka yang benar
- [ ] Lihat 5 barang terbaru ditampilkan dengan benar

### Kategori
- [ ] Buat kategori baru (kode: TEST, nama: Testing)
- [ ] Edit kategori yang baru dibuat
- [ ] Tambahkan barang inventaris dengan kategori TEST
- [ ] Verifikasi jumlah barang di index kategori berubah
- [ ] Coba hapus kategori dengan barang (harus ditolak dengan pesan error)
- [ ] Hapus semua barang kategori TEST terlebih dahulu
- [ ] Baru hapus kategori TEST (seharusnya berhasil)

### Kondisi
- [ ] Verifikasi 3 kondisi default sudah ada (Baik, Rusak Ringan, Rusak Berat)
- [ ] Lihat preview badge warna di index
- [ ] Buat kondisi baru (coba warna berbeda)
- [ ] Edit kondisi baru, ubah nama dan warna
- [ ] Coba hapus kondisi yang belum digunakan (harus berhasil)
- [ ] Coba hapus kondisi "Baik" jika ada barang (harus ditolak)

### Inventaris
- [ ] Filter berdasarkan kondisi (dropdown harus menampilkan kondisi dari tabel kondisis)
- [ ] Lihat badge warna kondisi di tabel
- [ ] Lihat statistik kondisi di atas tabel
- [ ] Tambah barang baru (pilih kondisi dari dropdown)
- [ ] Edit barang (ubah kondisi, verifikasi perubahan)
- [ ] Klik tombol hapus, modal konfirmasi harus muncul
- [ ] Klik Batal di modal, modal hilang tanpa hapus
- [ ] Klik Hapus di modal, barang terhapus

### Responsive
- [ ] Buka di browser DevTools, pilih device iPhone 12 (390px)
- [ ] Sidebar harus berubah menjadi responsive
- [ ] Tabel harus tetap readable
- [ ] Tombol harus tetap clickable

---

## 🛠️ Troubleshooting

### Error: "Target class [DashboardController] does not exist"
**Solusi**: Jalankan `php artisan cache:clear` dan `php artisan config:cache`

### Error: "SQLSTATE[42S02]: Table or view not found"
**Solusi**: Pastikan sudah jalankan `php artisan migrate` terlebih dahulu

### Error: "Trying to access array offset on null" di kondisi
**Solusi**: Update data inventaris yang ada menggunakan tinker (lihat Step 3 di atas)

### Sidebar tidak muncul atau styling berantakan
**Solusi**: 
1. Clear browser cache (Ctrl+Shift+Delete)
2. Jalankan `php artisan view:clear`
3. Reload halaman (Ctrl+F5)

### Modal konfirmasi tidak muncul saat klik hapus
**Solusi**: Pastikan JavaScript di layout app.blade.php tidak ada error di console browser (F12)

---

## 📝 Catatan Penting

1. **Kolom Kondisi Enum**: Kolom `kondisi` (enum) di tabel inventaris masih ada untuk backward compatibility. Kolom baru `kondisi_id` digunakan untuk relasi ke tabel kondisis.

2. **Restful Routes**: Semua controller menggunakan resource routes, jadi endpoint yang tersedia:
   - GET `/inventaris` - list
   - GET `/inventaris/create` - form create
   - POST `/inventaris` - store
   - GET `/inventaris/{id}` - show detail
   - GET `/inventaris/{id}/edit` - form edit
   - PUT `/inventaris/{id}` - update
   - DELETE `/inventaris/{id}` - destroy
   - (sama untuk `/kategori` dan `/kondisi`)

3. **Database Constraints**:
   - Kategori: kode unik, nama unik
   - Kondisi: nama unik
   - Inventaris: kode_barang unik, kategori_id & kondisi_id foreign key dengan cascade delete

4. **CSS Inline**: Semua styling ada di `<style>` tag di layout app.blade.php. Tidak ada file CSS eksternal.

5. **JS Vanilla**: Semua JavaScript adalah vanilla JS (tanpa library). Modal, auto-hide alerts, live preview - semuanya murni HTML+CSS+JS.

---

## 🎨 Color Palette yang Digunakan

- **Primary Blue**: `#1a73e8` (sidebar, buttons, links)
- **Dark Blue**: `#1557b0` (hover state)
- **Success Green**: `#198754` (badge kondisi baik)
- **Warning Yellow**: `#ffc107` (badge kondisi ringan)
- **Danger Red**: `#dc3545` (badge kondisi berat)
- **Info Blue**: `#0c3475` (badge kategori)
- **Light Gray**: `#f0f4f8` (background)
- **White**: `#ffffff` (cards, form elements)

---

## ✨ Selesai!

Sistem Inventaris Laboratorium Anda sudah siap digunakan dengan:
- ✅ CRUD Lengkap (Inventaris, Kategori, Kondisi)
- ✅ Dashboard dengan Statistik
- ✅ Desain Modern & Responsive
- ✅ Modal Konfirmasi & Validasi
- ✅ Auto-hide Alert
- ✅ Navigation Sidebar
- ✅ Live Preview (untuk badge)
- ✅ Pagination & Filter

Selamat menggunakan! 🚀
