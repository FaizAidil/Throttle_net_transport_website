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

// Mengambil data dari form
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$car = $_POST['car'];  // Menambahkan data mobil yang dipilih
$date = $_POST['date'];
$duration = $_POST['duration'];

// Menyimpan data ke dalam database
$sql = "INSERT INTO orders (name, email, phone, car, date, duration) 
        VALUES ('$name', '$email', '$phone', '$car', '$date', '$duration')";

// Mengeksekusi query dan mengecek apakah berhasil
if ($conn->query($sql) === TRUE) {
    echo "Pemesanan berhasil disimpan!";
    // Mengarahkan ke index.html setelah berhasil
    header("Location: index.html");
    exit(); // Jangan lupa menambahkan exit setelah header untuk menghentikan eksekusi lebih lanjut
} else {
    echo "Terjadi kesalahan: " . $conn->error;
}

// Menutup koneksi
$conn->close();
?>
