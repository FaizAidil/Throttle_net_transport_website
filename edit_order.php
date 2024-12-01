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

// Mendapatkan ID dari URL
$id = $_GET['id'];

// Query untuk mengambil data pemesanan berdasarkan ID
$sql = "SELECT * FROM orders WHERE id = $id";
$result = $conn->query($sql);

// Mengecek apakah data ditemukan
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Data tidak ditemukan!";
    exit;
}

// Jika form disubmit, proses update data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $car = $_POST['car'];
    $date = $_POST['date'];
    $duration = $_POST['duration'];

    $updateSql = "UPDATE orders SET 
                    name='$name', 
                    email='$email', 
                    phone='$phone', 
                    car='$car', 
                    date='$date', 
                    duration='$duration' 
                  WHERE id=$id";

    if ($conn->query($updateSql) === TRUE) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='lihat_order.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pemesanan</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="Logo.png" type="image/x-icon">
    <link rel="icon" href="Logo.png" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #4d4d4d;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #333;
            padding: 20px;
            border-radius: 10px;
            width: 70%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        form input, form select {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        form button {
            width: 50%;
            padding: 10px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        form button:hover {
            background-color: #c82333;
        }
        .btn-cancel {
            background-color: #dc3545;
        }
        .btn-cancel:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Pemesanan <br> <img src="Logo.png" alt="logo"> </h2>
        <form method="POST">
            <label for="name">Nama Lengkap</label>
            <input type="text" id="name" name="name" value="<?= $row['name']; ?>" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= $row['email']; ?>" required>

            <label for="phone">Nomor Telepon</label>
            <input type="tel" id="phone" name="phone" value="<?= $row['phone']; ?>" required>

            <label for="car">Mobil</label>
            <input type="text" id="car" name="car" value="<?= $row['car']; ?>" required>

            <label for="date">Tanggal Sewa</label>
            <input type="date" id="date" name="date" value="<?= $row['date']; ?>" required>

            <label for="duration">Durasi (Hari)</label>
            <input type="number" id="duration" name="duration" value="<?= $row['duration']; ?>" required>

            <button type="submit">Simpan</button>
            <button type="button" class="btn-cancel" onclick="window.location.href='lihat_order.php';">Batal</button>
        </form>
    </div>
</body>
</html>
