<?php
include('koneksi.php');

if (isset($_GET['id_pelanggan'])) {
    $id_pelanggan = $_GET['id_pelanggan'];

    // Query untuk menghapus data dari tabel barang
    $query = "DELETE FROM pelanggan WHERE id_pelanggan=$id_pelanggan";

    // Eksekusi query
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script>window.alert("Data Berhasil Dihapus")
        window.location="pelanggan.php"
        </script>';
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
} else {
    echo 'ID tidak diberikan.';
}
?>
