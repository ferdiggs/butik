<?php
// Sertakan file koneksi.php
include 'koneksi.php';

// Ambil data dari formulir
$namaPelanggan = $_POST['nama_pelanggan'];
$alamatPelanggan = $_POST['alamat_pelanggan'];
$noTlp = $_POST['no_tlp'];
$ig = $_POST['ig'];

// Kode untuk menambahkan data pelanggan ke database
$sql = "INSERT INTO pelanggan (nama_pelanggan, alamat_pelanggan, no_tlp, ig) VALUES ('$namaPelanggan', '$alamatPelanggan', '$noTlp', '$ig')";

if ($conn->query($sql) === TRUE) {
    echo '<script>window.alert("Data Berhasil Ditambah")
    window.location="pelanggan.php"
    </script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi database
$conn->close();
?>
