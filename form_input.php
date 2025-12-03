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
