<?php
// Konfigurasi koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rentalmobildb";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data dari tabel messages
$sql = "SELECT * FROM pesan ORDER BY tanggal DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Masuk</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="Logo.png" type="image/x-icon">
</head>
<body>
    
    <div class="back-home">
        <button class="kembali" onclick="window.location.href='index.html';">Kembali ke Menu Utama</button>
    </div>

    <div class="container">
        <h2>Pesan Masuk</h2>
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-top: 20px; border-radius: 8px; overflow: hidden;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Pesan</th>
                    <th>Tanggal Kirim</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Mengecek apakah ada data dalam tabel
                if ($result->num_rows > 0) {
                    $no = 1;
                    // Menampilkan setiap baris data dalam tabel
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['pesan']}</td>
                                <td>{$row['tanggal']}</td>
                              </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada pesan</td></tr>";
                }

                // Menutup koneksi
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>
