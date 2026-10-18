<?php
include 'db.php';
include 'author.php';

// Header untuk file Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_data_siswa.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Mulai tabel
echo "<table border='1'>";
echo "<tr>
<th>ID</th>
<th>Nama</th>
<th>NIS</th>
<th>Kelas</th>
<th>Semester</th>
<th>Extra</th>
</tr>";

// Query ambil data dari tabel data_siswa
$sql = "SELECT id, name, nis, kelas, semester, extra FROM data_siswa";
$result = $conn->query($sql);

// Tampilkan datanya
while ($row = $result->fetch_assoc()) {
    echo "<tr>
    <td>{$row['id']}</td>
    <td>{$row['name']}</td>
    <td>{$row['nis']}</td>
    <td>{$row['kelas']}</td>
    <td>{$row['semester']}</td>
    <td>{$row['extra']}</td>
    </tr>";
}

echo "</table>";
$conn->close();
?>
