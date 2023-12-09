<?php
include('koneksi.php');

if (isset($_GET['id_pesanan'])) {
    $id_pesanan = $_GET['id_pesanan'];

    // Query untuk menghapus data dari tabel barang
    $query = "DELETE FROM pesanan WHERE id_pesanan=$id_pesanan";

    // Eksekusi query
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script>window.alert("Data Berhasil Dihapus")
        window.location="pemesanan.php"
        </script>';
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
} else {
    echo 'ID tidak diberikan.';
}
?>
