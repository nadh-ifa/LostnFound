# TESTING DOCUMENTATION — TEMUKAN

---

# Authentication Testing

## Register
- [x] Register dengan data valid berhasil
- [x] Register dengan email yang sudah digunakan ditolak
- [x] Password kosong menghasilkan error
- [x] Confirm password berbeda menghasilkan error

## Login
- [x] Login berhasil
- [x] Password salah ditolak
- [x] User tidak ditemukan ditolak

## Logout
- [x] Logout berhasil

---

# User Testing

## Create Item
- [x] Create laporan berhasil
- [x] Upload gambar berhasil
- [x] Field kosong menghasilkan error

## Read Item
- [x] Daftar laporan tampil
- [x] Detail laporan tampil lengkap

## Update Item
- [x] Owner dapat edit laporan
- [x] User lain tidak dapat edit laporan

## Delete Item
- [x] Delete laporan berhasil

## Comment
- [x] Komentar tampil
- [x] Tambah komentar tanpa reload berhasil
- [x] Komentar kosong ditolak

## Search & Filter
- [x] Search berjalan
- [x] Filter status berjalan
- [x] Reset filter berjalan

---

# Receptionist Testing

## Authentication
- [x] Login sebagai resepsionis berhasil

## Dashboard
- [x] Dashboard resepsionis tampil
- [x] Statistik laporan tampil

## Status Management
- [x] Update status barang berhasil
- [x] Dropdown status berjalan
- [x] Perubahan status tersimpan

## Authorization
- [x] User biasa tidak bisa akses dashboard resepsionis
- [x] User biasa tidak bisa update status

---

# Vue.js Testing

## ItemSearch.vue
- [x] Data laporan berhasil diambil dari API
- [x] Search reactive berjalan
- [x] Filter reactive berjalan

## CommentSection.vue
- [x] Komentar tampil realtime
- [x] Jumlah komentar update otomatis
- [x] Tambah komentar tanpa reload berhasil

---

# API Testing

- [x] POST /api/register
- [x] POST /api/login
- [x] POST /api/logout
- [x] GET /api/me
- [x] GET /api/items
- [x] POST /api/items
- [x] PUT /api/items/{id}
- [x] DELETE /api/items/{id}
- [x] POST /api/items/{id}/comments
- [x] PATCH /api/items/{id}/status

---

# Responsive Testing

- [x] Mobile
- [x] Tablet
- [x] Desktop

---

# Bug & Regression Testing

- [x] Tidak ada error console
- [x] Tidak ada broken route
- [x] Tidak ada bug setelah integrasi Vue.js
- [x] Dropdown logout berjalan normal
- [x] Integrasi frontend-backend berjalan
