#!/usr/bin/env bash

# Hentikan eksekusi skrip jika terjadi error pada salah satu perintah
set -e

echo "--------------------------------------------------------"
echo "🚀 SKRIP DEPLOYMENT OTOMATIS: MI MANBA'UL HUDA"
echo "--------------------------------------------------------"


# 2. Cek & Instalasi Ekstensi PHP untuk Laravel 13 & Filament 5
echo "🔧 Memeriksa & menginstall ekstensi PHP yang dibutuhkan..."
if command -v apt-get &> /dev/null; then
    sudo apt-get update && sudo apt-get install -y \
        php-cli php-mbstring php-xml php-curl php-sqlite3 \
        php-gd php-zip php-intl php-bcmath
elif command -v yum &> /dev/null; then
    sudo yum install -y \
        php-cli php-mbstring php-xml php-curl php-sqlite3 \
        php-gd php-zip php-intl php-bcmath
fi

# 3. Cek & Instalasi Composer
if ! command -v composer &> /dev/null; then
    echo "📦 Composer belum terinstall. Menginstall Composer..."
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer
    php -r "unlink('composer-setup.php');"
    echo "✅ Composer berhasil terinstall."
else
    echo "✅ Composer sudah terinstall."
fi

# 4. Clone Repository ke Direktori Aktif (dengan tanda titik '.')
echo "📥 Mengkloning repository dari GitHub ke direktori aktif..."
if [ -d ".git" ]; then
    echo "🔄 Repository sudah ada. Memperbarui data terbaru dengan git pull..."
    git pull origin main || git pull origin master
else
    git clone https://github.com/zakyjamaluddin/manbaul-huda.git .
fi

# 5. Composer Install (Mengabaikan Versi Platform PHP / Composer Server)
echo "📦 Menginstall dependensi Composer (mengabaikan versi platform PHP)..."
composer install --no-interaction --prefer-dist --optimize-autoloader --ignore-platform-reqs



# 8. Storage Symlink
echo "🔗 Membuat link direktori storage..."
php artisan storage:link --force || true

# 9. Clear & Optimize Cache
echo "🧹 Membersihkan & mengoptimalkan cache..."
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 10. Pengaturan Izin Folder (Permissions)
echo "🔒 Mengatur izin folder storage & bootstrap/cache..."
chmod -R 775 storage bootstrap/cache || true

echo "--------------------------------------------------------"
echo "🎉 DEPLOYMENT SELESAI & BERHASIL!"
echo "Website MI Manba'ul Huda siap dijalankan."
echo "--------------------------------------------------------"
