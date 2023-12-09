<?php
// Include file koneksi.php untuk menghubungkan ke database
include "koneksi.php";

// Ambil nilai dari formulir HTML
$id_pelanggan = $_POST['id_pelanggan'];
$panjang_lengan = floatval($_POST["panjang_lengan"]);
$lebar_pinggul = floatval($_POST["lebar_pinggul"]);
$lebar_bahu = floatval($_POST["lebar_bahu"]);
$lebar_kaki = floatval($_POST["lebar_kaki"]);
$lebar_lengan = floatval($_POST["lebar_lengan"]);
$lebar_leher = floatval($_POST["lebar_leher"]);

// Query untuk mendapatkan nama pelanggan berdasarkan ID pelanggan
$query_pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");
$pelanggan = mysqli_fetch_array($query_pelanggan);

// Ambil nilai yang ingin Anda simpan di tabel pemesanan
$nama_pelanggan = $pelanggan['nama_pelanggan'];

// Lanjutkan dengan query pemesanan
$query_pemesanan = "INSERT INTO ukuran (nama_pelanggan, panjang_lengan, lebar_pinggul, lebar_bahu, lebar_kaki, lebar_lengan, lebar_leher) VALUES ('$nama_pelanggan', '$panjang_lengan', '$lebar_pinggul', '$lebar_bahu', '$lebar_kaki', '$lebar_lengan', '$lebar_leher')";

$result = mysqli_query($conn, $query_pemesanan);

// Cek apakah query berhasil dijalankan
if ($result) {
    echo '<script>window.alert("Data Berhasil Ditambah")
    window.location="ukuran.php"
    </script>';
    exit();
} else {
    echo "Error: " . $query_pemesanan . "<br>" . mysqli_error($conn);
}

// Tutup koneksi database
mysqli_close($koneksi);
?>
