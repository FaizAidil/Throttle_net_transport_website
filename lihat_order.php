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

// Query untuk mengambil data dari tabel 'orders'
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pemesanan Sewa Mobil</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="Logo.png" type="image/x-icon">
</head>
<body>
    <div class="back-home">
        <button class="kembali" onclick="window.location.href='index.html';">Kembali ke Menu Utama</button>
    </div>

    <section id="data-pemesanan">
        <div class="container">
            <h2 class="text-center">Data Pemesanan Sewa Mobil</h2>

            <!-- Menampilkan data dalam bentuk tabel -->
            <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-top: 20px;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                        <th>Mobil</th>
                        <th>Tanggal Sewa</th>
                        <th>Durasi (Hari)</th>
                        <th>Aksi</th>
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
                                    <td>{$row['phone']}</td>
                                    <td>{$row['car']}</td>
                                    <td>{$row['date']}</td>
                                    <td>{$row['duration']}</td>
                                    <td>
                                        <a href='edit_order.php?id={$row['id']}'>Edit</a> |
                                        <a href='hapus_order.php?id={$row['id']}' onclick='return confirm(\"Yakin ingin menghapus data ini?\");'>Hapus</a>
                                    </td>
                                  </tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='8'>Tidak ada data pemesanan</td></tr>";
                    }

                    // Menutup koneksi
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>
