<?php
// Sertakan file koneksi.php
include 'koneksi.php';

// Ambil data dari formulir edit
$idPelanggan = $_POST['id_pelanggan'];
$namaPelanggan = $_POST['nama_pelanggan'];
$alamatPelanggan = $_POST['alamat_pelanggan'];
$noTlp = $_POST['no_tlp'];
$ig = $_POST['ig'];

// Kode untuk mengupdate data pelanggan di database
$sql = "UPDATE pelanggan SET nama_pelanggan='$namaPelanggan', alamat_pelanggan='$alamatPelanggan',  no_tlp='$noTlp', ig='$ig' WHERE id_pelanggan='$idPelanggan'";

if ($conn->query($sql) === TRUE) {
    echo '<script>window.alert("Data Berhasil Dirubah")
    window.location="pelanggan.php"
    </script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi database
$conn->close();
?>
