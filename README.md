# ระบบปักหมุด

## เครื่องมือที่ใช้
- [Laravel](https://laravel.com)
- [Orchid](https://orchid.software/)

## การติดตั้ง
- ข้อมูลป้อนเข้าระบบอยู่ในโหล์เดอร์ /data
- สร้างไฟล์สำหรับตั้งค่า
```bash
cp .env.example .env
```
- แก้ไขการตั้งค่าในไฟล์ .env
- ติดตั้ง Package
```bash
composer -i หรือ composer install
```
- เอาข้อมูลลง DB
```bash
php artisan migrate:fresh --seed
```
- เริ่ม Web server
```bash
php artisan serve
```
