<?php
// Include file koneksi.php untuk menghubungkan ke database
include "koneksi.php";

// Ambil nilai dari formulir HTML
$id_pelanggan = $_POST['id_pelanggan'];
$warna = $_POST['warna'];
$keterangan = $_POST['keterangan'];
$bahan = $_POST['bahan'];
$jumlah_pesan = $_POST['jumlah_pesan'];
$jenis_pembayaran = $_POST['jenis_pembayaran'];
$total_biaya = $_POST['total_biaya'];
$jumlah_bayar = $_POST['jumlah_bayar'];
$sisa_pembayaran = $_POST['sisa_pembayaran'];
$tgl_pesan = $_POST['tgl_pesan'];
$tgl_ambil = $_POST['tgl_ambil'];

// Query untuk mendapatkan nama pelanggan berdasarkan ID pelanggan
$query_pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");
$pelanggan = mysqli_fetch_array($query_pelanggan);

// Ambil nilai yang ingin Anda simpan di tabel pemesanan
$nama_pelanggan = $pelanggan['nama_pelanggan'];

// Lanjutkan dengan query pemesanan
$query_pemesanan = "INSERT INTO pesanan (nama_pelanggan, bahan, warna, keterangan, jumlah_pesan, jenis_pembayaran, total_biaya, jumlah_bayar, sisa_pembayaran, tgl_pesan, tgl_ambil) VALUES ('$nama_pelanggan', '$bahan', '$warna', '$keterangan', '$jumlah_pesan', '$jenis_pembayaran', '$total_biaya', '$jumlah_bayar', '$sisa_pembayaran', '$tgl_pesan', '$tgl_ambil')";

$result = mysqli_query($conn, $query_pemesanan);

// Cek apakah query berhasil dijalankan
if ($result) {
    echo '<script>window.alert("Data Berhasil Ditambah")
    window.location="pemesanan.php"
    </script>';
    exit();
} else {
    echo "Error: " . $query_pemesanan . "<br>" . mysqli_error($conn);
}

// Tutup koneksi database
mysqli_close($koneksi);
?>
