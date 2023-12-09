<?php
include "koneksi.php";

// Pastikan data diterima dari formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari formulir
    $id_pesanan = $_POST["id_pesanan"];
    $nama_pelanggan = $_POST["nama_pelanggan"];
    $tgl_pesan = $_POST["tgl_pesan"];
    $tgl_ambil = $_POST["tgl_ambil"];
    $jumlah_pesan = $_POST["jumlah_pesan"];
    $bahan = $_POST["bahan"];
    $warna = $_POST["warna"];
    $keterangan = $_POST["keterangan"];
    $jenis_pembayaran = $_POST["jenis_pembayaran"];
    $total_biaya = $_POST["total_biaya"];
    $jumlah_bayar = $_POST["jumlah_bayar"];
    $sisa_pembayaran = $_POST["sisa_pembayaran"];

    // Query SQL untuk menyimpan data ke tabel pesanan
    $query = "UPDATE pesanan SET
                nama_pelanggan = '$nama_pelanggan',
                tgl_pesan = '$tgl_pesan',
                tgl_ambil = '$tgl_ambil',
                jumlah_pesan = '$jumlah_pesan',
                bahan = '$bahan',
                warna = '$warna',
                keterangan = '$keterangan',
                jenis_pembayaran = '$jenis_pembayaran',
                total_biaya = '$total_biaya',
                jumlah_bayar = '$jumlah_bayar',
                sisa_pembayaran = '$sisa_pembayaran'
              WHERE id_pesanan = $id_pesanan";

    // Eksekusi query
    $result = mysqli_query($conn, $query);

    // Cek apakah query berhasil dijalankan
    if ($result) {
        echo '<script>window.alert("Data Berhasil Dirubah")
    window.location="pemesanan.php"
    </script>';
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Metode tidak diizinkan.";
}

// Tutup koneksi database
mysqli_close($conn);
?>
