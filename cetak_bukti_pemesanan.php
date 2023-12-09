<?php
require('fpdf/fpdf.php');
include "koneksi.php";

// Ambil ID Pesanan dari parameter URL
$id_pesanan = $_GET['id_pesanan'];

// Query untuk mengambil data pesanan berdasarkan ID
$query = "SELECT * FROM pesanan WHERE id_pesanan = $id_pesanan";
$result = mysqli_query($conn, $query);
$data_pesanan = mysqli_fetch_assoc($result);

// Buat objek FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Set font
$pdf->SetFont('Arial', '', 12);

// Tambahkan konten ke PDF
$pdf->Image('asset/logouhtp.png', 70, 25, 70); // Ganti 'path/to/logo.png' dengan path menuju file logo Anda
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 18); // Set font menjadi Bold
$pdf->Cell(0, 10, 'BUKTI PEMESANAN', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12); // Mengembalikan font ke kondisi semula

$pdf->Ln(70);

$pdf->Cell(0, 10, 'Nama Pelanggan: ' . $data_pesanan['nama_pelanggan'], 0, 1, 'C');
$pdf->Cell(0, 10, 'ID Pesanan: ' . $data_pesanan['id_pesanan'], 0, 1, 'C');
$pdf->Cell(0, 10, 'Tanggal Pesan: ' . $data_pesanan['tgl_pesan'], 0, 1, 'C');
$pdf->Cell(0, 10, 'Tanggal Ambil: ' . $data_pesanan['tgl_ambil'], 0, 1, 'C');
$pdf->Cell(0, 10, 'Keterangan: ' . $data_pesanan['keterangan'], 0, 1, 'C');
$pdf->Cell(0, 10, 'Jumlah Pesan: ' . $data_pesanan['jumlah_pesan'], 0, 1, 'C');
$pdf->Cell(0, 10, 'Total Biaya: ' . $data_pesanan['total_biaya'], 0, 1, 'C');
$pdf->Cell(0, 10, 'Jumlah Bayar: ' . $data_pesanan['jumlah_bayar'], 0, 1, 'C');
$pdf->Cell(0, 10, 'Sisa Pembayaran: ' . $data_pesanan['sisa_pembayaran'], 0, 1, 'C');

// Output ke browser
$pdf->Output('bukti_pemesanan.pdf', 'D');

// Tutup koneksi database
mysqli_close($conn);
