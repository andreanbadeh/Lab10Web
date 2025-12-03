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

# Buat file baru dengan nama Mobil.php
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
# Buat file baru dengan nama form.php
```
<?php
class Form
{
    private $fields = [];
    private $action;
    private $submit;
    private $jumField = 0;

    public function __construct($action, $submit)
    {
        $this->action = $action;
        $this->submit = $submit;
    }

    public function addField($name, $label)
    {
        $this->fields[$this->jumField]['name']  = $name;
        $this->fields[$this->jumField]['label'] = $label;
        $this->jumField++;
    }

    public function displayForm()
    {
        echo "<form action='".$this->action."' method='POST'>";
        echo "<table width='100%' border='0'>";

        foreach ($this->fields as $f) {
            echo "<tr><td align='right'>{$f['label']}</td>";
            echo "<td><input type='text' name='{$f['name']}'></td></tr>";
        }

        echo "<tr><td colspan='2'><input type='submit' value='".$this->submit."'></td></tr>";
        echo "</table></form>";
    }
}
?>
```
# Buat file baru dengan nama form_input.php
```
<?php
include "form.php";
include "database.php";

$db = new Database();

echo "<html>
<head>
    <title>Form Mahasiswa</title>
    <link rel='stylesheet' href='style.css'>
</head>
<body>";

echo "<div class='container'>";

$form = new Form("", "Input");
$form->addField("nim", "NIM");
$form->addField("nama", "Nama");
$form->addField("alamat", "Alamat");

echo "<h3>Silakan isi form berikut:</h3>";
$form->displayForm();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = [
        'nim'    => $_POST['nim'],
        'nama'   => $_POST['nama'],
        'alamat' => $_POST['alamat']
    ];

    $db->insert("mahasiswa", $data);

    echo "<div class='result'>";
    echo "<h4>Input berhasil!</h4>";
    echo "<b>Data baru:</b><br>";
    echo "NIM : " . $_POST['nim'] . "<br>";
    echo "Nama : " . $_POST['nama'] . "<br>";
    echo "Alamat : " . $_POST['alamat'] . "<br>";
    echo "</div>";
}

$all = $db->get("mahasiswa");

echo "<h3>Data Mahasiswa:</h3>";
echo "<table class='data-table'>
        <tr>
            <th>ID</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Alamat</th>
        </tr>";

foreach ($all as $mhs) {
    echo "<tr>
            <td>{$mhs['id']}</td>
            <td>{$mhs['nim']}</td>
            <td>{$mhs['nama']}</td>
            <td>{$mhs['alamat']}</td>
          </tr>";
}

echo "</table>";

echo "</div>"; 
echo "</body></html>";
?>
```
# Buat file dengan nama database.php
```
<?php

class Database {
    protected $host;
    protected $user;
    protected $password;
    protected $db_name;
    protected $conn;

    public function __construct() {
        $this->getConfig();
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db_name);
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    private function getConfig() {
        include_once("config.php");
        $this->host     = $config['host'];
        $this->user     = $config['username'];
        $this->password = $config['password'];
        $this->db_name  = $config['db_name'];
    }

    public function insert($table, $data) {
        $columns = implode(",", array_keys($data));
        $values  = "'" . implode("','", array_values($data)) . "'";
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        return $this->conn->query($sql);
    }

    public function getAll($table) {
        $sql = "SELECT * FROM $table ORDER BY id DESC";
        $res = $this->conn->query($sql);

        $rows = [];
        while ($row = $res->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
}
?>
```
# Konfigurasi Dengan Style.css
```
body {
    font-family: Arial, sans-serif;
    background: #f4f7fc;
    margin: 0;
    padding: 0;
}

.container {
    width: 450px;
    margin: 40px auto;
    background: #ffffff;
    padding: 25px 30px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

h3 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

table {
    width: 100%;
}

td {
    padding: 10px 0;
    font-size: 16px;
}

input[type="text"] {
    width: 95%;
    padding: 10px;
    font-size: 15px;
    border: 1px solid #ccc;
    border-radius: 6px;
}

input[type="submit"] {
    margin-top: 15px;
    padding: 10px 20px;
    width: 100%;
    background: #4a90e2;
    border: none;
    color: white;
    font-size: 16px;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}

input[type="submit"]:hover {
    background: #357ac9;
}

.result {
    margin-top: 20px;
    padding: 15px;
    background: #e0ffe0;
    border-left: 5px solid #33cc33;
    border-radius: 6px;
}
```

# Pertanyaan & Tugas

![gambar](https://github.com/andreanbadeh/Lab10Web/blob/3e0aafe5f8cfe47e2f7e6d1a6ea3cfd3bf99f160/image/Screenshot%20from%202025-12-03%2008-22-04.png)
