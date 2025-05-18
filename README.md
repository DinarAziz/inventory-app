# 📦 Inventory App Laravel

Selamat datang di **Inventory App**, aplikasi manajemen inventaris berbasis Laravel + Tailwind CSS. Project ini dikembangkan oleh **Dinar Aziz Al Ghifari** untuk latihan dan pengembangan sistem informasi berbasis web.

---

## ✨ Fitur Utama

- ✅ CRUD Data Barang
- ✅ Kelola Kategori & Pemasok
- ✅ Peminjaman & Pengembalian Barang
- ✅ Dashboard Admin Interaktif
- ✅ Otentikasi & Manajemen User
- ✅ Responsive Design (Tailwind CSS)

---

## 🛠 Tech Stack

- Laravel 10
- Tailwind CSS
- MySQL
- Vite
- Composer & NPM

---

## 🚀 Cara Instalasi

```bash
git clone https://github.com/dinaraziz/inventory-app.git
cd inventory-app
cp .env.example .env
composer install
npm install && npm run dev
php artisan key:generate
php artisan migrate
php artisan serve
