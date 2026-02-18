# Dokumentasi Implementasi 2FA (Two-Factor Authentication)

Fitur Two-Factor Authentication (2FA) telah berhasil diimplementasikan pada aplikasi Laravel ini.

## 📋 Yang Sudah Diimplementasikan

### 1. Package
- **pragmarx/google2fa-laravel** - Package untuk integrasi Google 2FA dengan Laravel
- **pragmarx/google2fa** - Core library Google 2FA
- **pragmarx/google2fa-qrcode** - Generator QR Code untuk setup 2FA

### 2. Database
File migration: `2026_02_18_000001_add_two_factor_columns_to_users_table.php`

Kolom yang ditambahkan ke tabel `users`:
- `google2fa_secret` (text, nullable) - Menyimpan secret key untuk 2FA (terenkripsi)
- `google2fa_enabled` (boolean, default: false) - Status aktif/tidaknya 2FA

### 3. Model
File: `app/Models/User.php`

Perubahan:
- Ditambahkan `google2fa_secret` dan `google2fa_enabled` ke `$fillable`
- Ditambahkan cast untuk `google2fa_enabled` sebagai boolean

### 4. Controllers

#### a. TwoFactorController
File: `app/Http/Controllers/Account/TwoFactorController.php`

Method:
- `index()` - Halaman pengaturan 2FA
- `enable()` - Generate QR code dan secret untuk setup 2FA
- `verify()` - Verifikasi kode OTP dan mengaktifkan 2FA
- `disable()` - Menonaktifkan 2FA (memerlukan password)

#### b. LoginController
File: `app/Http/Controllers/Auth/LoginController.php`

Method yang ditambahkan:
- `authenticated()` - Override method untuk cek 2FA setelah login
- `show2faForm()` - Tampilkan form verifikasi 2FA
- `verify2fa()` - Verifikasi kode OTP saat login

### 5. Routes
File: `routes/web.php`

Routes yang ditambahkan:
```php
// 2FA Login Verification
GET  /login/2fa           → LoginController@show2faForm
POST /login/2fa           → LoginController@verify2fa

// 2FA Account Management (Auth Required)
GET  /account/two-factor         → TwoFactorController@index
GET  /account/two-factor/enable  → TwoFactorController@enable
POST /account/two-factor/verify  → TwoFactorController@verify
POST /account/two-factor/disable → TwoFactorController@disable
```

### 6. Views

#### a. Login 2FA Verification
File: `resources/views/auth/2fa.blade.php`
- Form verifikasi kode OTP saat login
- Menggunakan layout AdminLTE

#### b. 2FA Settings Page
File: `resources/views/account/two-factor/index.blade.php`
- Halaman utama pengaturan 2FA
- Menampilkan status 2FA (aktif/tidak aktif)
- Tombol untuk mengaktifkan/menonaktifkan 2FA
- Informasi tentang aplikasi authenticator

#### c. 2FA Enable/Setup Page
File: `resources/views/account/two-factor/enable.blade.php`
- Menampilkan QR code untuk di-scan
- Menampilkan secret key untuk entry manual
- Form verifikasi kode OTP untuk aktivasi

## 🚀 Cara Menggunakan

### Untuk Admin/Developer:
1. Pastikan package sudah terinstall dengan menjalankan:
   ```bash
   composer require pragmarx/google2fa-laravel
   ```

2. Migration sudah dijalankan (sudah selesai)

3. Akses halaman pengaturan 2FA melalui menu atau URL:
   ```
   /account/two-factor
   ```

### Untuk User/Pengguna:
1. Login ke aplikasi
2. Akses halaman "Pengaturan Two-Factor Authentication" melalui menu akun
3. Klik tombol "Aktifkan 2FA"
4. Install aplikasi authenticator:
   - Google Authenticator
   - Microsoft Authenticator
   - Authy
5. Scan QR code yang ditampilkan atau masukkan secret key secara manual
6. Masukkan kode 6 digit dari aplikasi untuk verifikasi
7. 2FA berhasil diaktifkan!

### Login dengan 2FA:
1. Masukkan email dan password seperti biasa
2. Jika 2FA aktif, akan diarahkan ke halaman verifikasi 2FA
3. Masukkan kode 6 digit dari aplikasi authenticator
4. Klik "Verifikasi" untuk melanjutkan login

### Menonaktifkan 2FA:
1. Akses halaman pengaturan 2FA
2. Masukkan password Anda
3. Klik "Nonaktifkan 2FA"

## 🔒 Keamanan

- Secret key disimpan dalam bentuk **terenkripsi** menggunakan fungsi `encrypt()` Laravel
- Kode OTP berlaku selama 30 detik (standar TOTP)
- Password diperlukan untuk menonaktifkan 2FA
- Session digunakan untuk menyimpan user ID sementara saat verifikasi 2FA

## 📱 Aplikasi Authenticator yang Didukung

- Google Authenticator (Android/iOS)
- Microsoft Authenticator
- Authy
- Any TOTP-compatible authenticator app

## 🔧 Konfigurasi Tambahan (Opsional)

Jika ingin mengubah nama aplikasi yang muncul di authenticator, edit file `.env`:
```env
APP_NAME="Nama Aplikasi Anda"
```

## 📝 Catatan

- Fitur ini kompatibel dengan Laravel 12.x
- Menggunakan AdminLTE template untuk UI
- QR Code dihasilkan menggunakan Google Charts API
- Recovery codes belum diimplementasikan (dapat ditambahkan di masa depan)

## 🆘 Troubleshooting

**Q: User kehilangan akses ke aplikasi authenticator?**
A: Admin dapat menonaktifkan 2FA langsung dari database dengan menjalankan:
```sql
UPDATE users SET google2fa_enabled = 0, google2fa_secret = NULL WHERE email = 'user@email.com';
```

**Q: Kode OTP selalu invalid?**
A: Pastikan waktu di server dan device user sudah sinkron (gunakan NTP)

## 📚 Referensi

- Package: https://github.com/antonioribeiro/google2fa-laravel
- Artikel: https://www.rumahweb.com/journal/cara-mengaktifkan-fitur-2fa-login-di-laravel/
- RFC 6238 (TOTP): https://tools.ietf.org/html/rfc6238
