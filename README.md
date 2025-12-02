# Praktikum 10: PHP OOP
NAMA : ANDREAN PUTRA ARYA

NIM : 312410341

KELAS : TI.24.A.4

# Membuat Database
```
CREATE DATABASE IF NOT EXISTS lab10_db;
USE lab10_db;
```
# Membuat Tabel
```
CREATE TABLE IF NOT EXISTS mahasiswa (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nim VARCHAR(20) NOT NULL,
  nama VARCHAR(100) NOT NULL,
  alamat VARCHAR(255)
);
```

# Menampilkan Tabel Di terminal

![gambar](https://github.com/andreanbadeh/Lab10Web/blob/283df9f5ce656b11ccca081b62693370afc58aa8/image/Screenshot%20from%202025-12-03%2006-07-22.png)

# Bagian Phpmyadmin

![gambar](https://github.com/andreanbadeh/Lab10Web/blob/80351aca8bffd80b9165789d77b09c93bed4fcdf/image/Screenshot%20from%202025-12-03%2006-09-20.png)

# Buat file baru dengan nama config.php
```
<?php
$config = [
    "host"     => "localhost",
    "username" => "root",
    "password" => "070406",
    "db_name"  => "lab10_db"
];
?>
```

# # Buat file baru dengan nama Mobil.php
```
<?php
class Mobil
{
    private $warna;
    private $merk;
    private $harga;

    public function __construct()
    {
        $this->warna = "Biru";
        $this->merk  = "BMW";
        $this->harga = "10000000";
    }

    public function gantiWarna($warnaBaru)
    {
        $this->warna = $warnaBaru;
    }

    public function tampilWarna()
    {
        echo "Warna mobilnya : " . $this->warna;
    }
}

$a = new Mobil();
$b = new Mobil();

echo "<b>Mobil pertama</b><br>";
$a->tampilWarna();
echo "<br>Mobil pertama ganti warna<br>";
$a->gantiWarna("Merah");
$a->tampilWarna();

echo "<br><br><b>Mobil kedua</b><br>";
$b->gantiWarna("Hijau");
$b->tampilWarna();
?>
```
