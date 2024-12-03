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

// Mengecek apakah ada parameter 'id' yang dikirim
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data berdasarkan id
    $sql = "DELETE FROM orders WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
            alert('Data berhasil dihapus!');
            window.location.href = 'lihat_order.php';
        </script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Menutup koneksi
$conn->close();
?>
