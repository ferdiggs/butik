<?php
// Include file koneksi.php atau file yang diperlukan untuk koneksi ke database
include "koneksi.php";
require('fpdf/fpdf.php');

// Ambil nilai parameter bulan dari URL
$selectedMonth = isset($_GET['selected']) ? $_GET['selected'] : date('m');


// Query untuk mendapatkan data yang dibutuhkan berdasarkan bulan yang dipilih
$query = "SELECT pelanggan.nama_pelanggan, pesanan.tgl_pesan, pesanan.jenis_pembayaran, pesanan.jumlah_bayar
          FROM pelanggan
          JOIN pesanan ON pelanggan.nama_pelanggan = pesanan.nama_pelanggan
          WHERE MONTH(pesanan.tgl_pesan) = $selectedMonth";

$result = $conn->query($query);

// Mendapatkan data dari database dan menyimpannya dalam bentuk array
$data = array();
$grand_total = 0;
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
    $grand_total += $row['jumlah_bayar'];
}

// Menyiapkan dokumen untuk dicetak (menggunakan FPDF)
$pdf = new FPDF();
$pdf->AddPage();

// Judul laporan
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Laporan Pesanan Bulan ' . $selectedMonth, 0, 1, 'C');

// Header tabel
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(10, 7, 'No', 1);
$pdf->Cell(40, 7, 'Nama Pelanggan', 1);
$pdf->Cell(30, 7, 'Tanggal Pesan', 1);
$pdf->Cell(40, 7, 'Jenis Pembayaran', 1);
$pdf->Cell(40, 7, 'Jumlah Bayar', 1);
$pdf->Ln();

// Isi tabel
$pdf->SetFont('Arial', '', 12);
foreach ($data as $no => $row) {
    $pdf->Cell(10, 7, $no + 1, 1);
    $pdf->Cell(40, 7, $row['nama_pelanggan'], 1);
    $pdf->Cell(30, 7, $row['tgl_pesan'], 1);
    $pdf->Cell(40, 7, $row['jenis_pembayaran'], 1);
    $pdf->Cell(40, 7, $row['jumlah_bayar'], 1);
    $pdf->Ln();
}

// Total
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(120, 7, 'Total', 1);
$pdf->Cell(40, 7, $grand_total, 1);

// Menyimpan atau menampilkan dokumen PDF (tergantung kebutuhan)
$pdf->Output('laporan_pesanan_bulan_' . $selectedMonth . '.pdf', 'I');
?>
