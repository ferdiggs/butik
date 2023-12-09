<?php
include('koneksi.php');

if (isset($_GET['id_ukuran'])) {
    $id_ukuran = $_GET['id_ukuran'];

    // Query untuk menghapus data dari tabel barang
    $query = "DELETE FROM ukuran WHERE id_ukuran=$id_ukuran";

    // Eksekusi query
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script>window.alert("Data Berhasil Dihapus")
        window.location="ukuran.php"
        </script>';
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
} else {
    echo 'ID tidak diberikan.';
}
?>
