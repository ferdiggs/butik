<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari formulir
    $id_ukuran = $_POST["id_ukuran"];
    $nama_pelanggan = $_POST["nama_pelanggan"];
    $panjang_lengan = $_POST["panjang_lengan"];
    $lebar_pinggul = $_POST["lebar_pinggul"];
    $lebar_bahu = $_POST["lebar_bahu"];
    $lebar_kaki = $_POST["lebar_kaki"];
    $lebar_lengan = $_POST["lebar_lengan"];
    $lebar_leher = $_POST["lebar_leher"];

    // Query SQL untuk memperbarui data ukuran
    $query = "UPDATE ukuran
              SET nama_pelanggan = '$nama_pelanggan',
                  panjang_lengan = '$panjang_lengan',
                  lebar_pinggul = '$lebar_pinggul',
                  lebar_bahu = '$lebar_bahu'
                  lebar_kaki = '$lebar_kaki'
                  lebar_lengan = '$lebar_lengan'
                  lebar_leher = '$lebar_leher'
              WHERE id_ukuran = '$id_ukuran'";

    // Jalankan query
    $result = mysqli_query($conn, $query);

    // Periksa hasil query
    if ($result) {
        echo '<script>window.alert("Data Berhasil Dirubah")
    window.location="ukuran.php"
    </script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Tutup koneksi
    mysqli_close($conn);
} else {
    // Redirect jika halaman diakses tanpa melalui form
    header("Location: halaman_tidak_diizinkan.php");
    exit();
}
?>
