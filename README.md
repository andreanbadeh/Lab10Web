# Praktikum 10: PHP OOP
NAMA : ANDREAN PUTRA ARYA

NIM : 312410341

KELAS : TI.24.A.4

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

Hasilnya:

![gambar](https://github.com/andreanbadeh/Lab10Web/blob/8c03ed3a870fbeb28ea8916f00925a86f3f488bf/image/Screenshot%20from%202025-12-03%2008-23-32.png)

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

# Pertanyaan & Tugas

![gambar](https://github.com/andreanbadeh/Lab10Web/blob/3e0aafe5f8cfe47e2f7e6d1a6ea3cfd3bf99f160/image/Screenshot%20from%202025-12-03%2008-22-04.png)

# Hasil Akhir From
![gambar](https://github.com/andreanbadeh/Lab10Web/blob/b6ae1053e4a6d6ef821ef3e8c3422ca798736c0d/image/Screenshot%20from%202025-12-03%2008-25-37.png)
