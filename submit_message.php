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

// Menangani pengiriman formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Menyisipkan data ke dalam tabel messages
    $sql = "INSERT INTO pesan (name, email, pesan, tanggal) 
            VALUES ('$name', '$email', '$message', NOW())";

    if ($conn->query($sql) === TRUE) {
        // Jika data berhasil disimpan, redirect dengan status sukses
        header("Location: index.html?status=success");
        exit;
    } else {
        // Jika terjadi kesalahan saat menyimpan data
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Menutup koneksi
    $conn->close();
}
?>