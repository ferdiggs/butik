<?php
require('fpdf/fpdf.php');
include "koneksi.php";

// Ambil nilai bulan dari parameter URL
$selectedMonth = isset($_POST['selected']) ? $_POST['selected'] : date('m'); // Set default ke bulan saat ini

// Query untuk mendapatkan data pesanan berdasarkan bulan yang dipilih
$query = "SELECT * FROM pesanan WHERE MONTH(tgl_pesan) = '$selectedMonth'";
$result = $conn->query($query);

// Tambahkan logika untuk menangani form cetak laporan
if (isset($_POST['cetak'])) {
    // Buat objek FPDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Tambahkan konten ke PDF
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Laporan Bulanan Pesanan', 0, 1, 'C');

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'Bulan:', 0);
    $pdf->Cell(0, 10, $selectedMonth, 0, 1);

    // Tambahkan tabel data pesanan
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(40, 10, 'No', 1);
    $pdf->Cell(40, 10, 'Nama Pelanggan', 1);
    $pdf->Cell(40, 10, 'Tanggal Pesan', 1);
    $pdf->Cell(40, 10, 'Jenis Pembayaran', 1);
    $pdf->Cell(40, 10, 'Jumlah Bayar', 1);
    $pdf->Ln(); // Pindah ke baris berikutnya

    $no = 1;
    $grand_total = 0;

    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(40, 10, $no, 1);
        $pdf->Cell(40, 10, $row['nama_pelanggan'], 1);
        $pdf->Cell(40, 10, $row['tgl_pesan'], 1);
        $pdf->Cell(40, 10, $row['jenis_pembayaran'], 1);
        $pdf->Cell(40, 10, $row['jumlah_bayar'], 1);
        $pdf->Ln(); // Pindah ke baris berikutnya

        $grand_total += $row['jumlah_bayar'];
        $no++;
    }

    $pdf->Cell(160, 10, 'Total', 1); // Ubah lebar cell agar total berada di bawah kolom "Jumlah Bayar"
    $pdf->Cell(40, 10, $grand_total, 1);
    $pdf->Ln(); // Pindah ke baris berikutnya
    
    // Output ke browser
    $pdf->Output('laporan_bulanan.pdf', 'D');

    // Tutup koneksi database
    mysqli_close($conn);

    // Hentikan eksekusi script selanjutnya
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .select2-container--default .select2-selection--single {
            width: 100% !important;
            height: 38px !important;
            /* Sesuaikan tinggi sesuai kebutuhan */
        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- Summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Select2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- Bootstrap Datepicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include "sidebar.php"; ?>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v1</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Form Pemesanan</h3>
                        </div>
                        <div class="card-body">
                            <form id="formTampilkan" method="post" action="laporan_bulanan.php">
                                <div class="form-group">
                                    <label>Pilih Bulan:</label>
                                    <select name='selected' id="selected_month">
                                        <?php
                                        $months = [
                                            '01' => 'Januari',
                                            '02' => 'Februari',
                                            '03' => 'Maret',
                                            '04' => 'April',
                                            '05' => 'Mei',
                                            '06' => 'Juni',
                                            '07' => 'Juli',
                                            '08' => 'Agustus',
                                            '09' => 'September',
                                            '10' => 'Oktober',
                                            '11' => 'November',
                                            '12' => 'Desember'
                                        ];

                                        foreach ($months as $monthNumber => $monthName) {
                                            $selected = ($selectedMonth == $monthNumber) ? 'selected' : '';
                                            echo "<option value='$monthNumber' $selected>$monthName</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="tampilkan" class="btn btn-block btn-success btn-sm">Tampilkan</button>
                                    <button type="submit" name="cetak" class="btn btn-block btn-primary btn-sm">Cetak Laporan</button>

                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Pesanan</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="white-space: nowrap;">No</th>
                                            <th style="white-space: nowrap;">Nama Pelanggan</th>
                                            <th style="white-space: nowrap;">Tanggal Pesan</th>
                                            <th style="white-space: nowrap;">Jenis Pembayaran</th>
                                            <th style="white-space: nowrap;">Jumlah Bayar</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $grand_total = 0; // Inisialisasi grand total

                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>$no</td>";
                                            echo "<td>" . $row['nama_pelanggan'] . "</td>";
                                            echo "<td>" . $row['tgl_pesan'] . "</td>";
                                            echo "<td>" . $row['jenis_pembayaran'] . "</td>";
                                            echo "<td>" . $row['jumlah_bayar'] . "</td>";
                                            echo "</tr>";
                                            $grand_total += $row['jumlah_bayar'];
                                            $no++;
                                        }

                                        // Tampilkan total di bawah kolom "Jumlah Bayar"
                                        echo "<tr>
                                             <td colspan='4'><b>Total</b></td>
                                             <td><b>" . $grand_total . "</b></td>
                                              </tr>";
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.1.0
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- date-range-picker -->
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Bootstrap Switch -->
    <script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- BS-Stepper -->
    <script src="plugins/bs-stepper/js/bs-stepper.min.js"></script>
    <!-- dropzonejs -->
    <script src="plugins/dropzone/min/dropzone.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>


    <!-- Page specific script -->
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('YYYY-MM-DD', {
                'placeholder': 'YYYY-MM-DD'
            })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('YYYY-MM-DD', {
                'placeholder': 'YYYY-MM-DD'
            })
            //Money Euro
            $('[data-mask]').inputmask()

            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'YYYY-MM-DD'
            });

            //Date and time picker
            $('#reservationdatetime').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                }
            });

            //Date range picker
            $('#reservation').daterangepicker()
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'YYYY-MM-DD hh:mm A'
                }
            })
            //Date range as a button
            $('#daterange-btn').daterangepicker({
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                }
            )

            //Timepicker
            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'YYYY-MM-DD'
            });


            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox()

            //Colorpicker
            $('.my-colorpicker1').colorpicker()
            //color picker with addon
            $('.my-colorpicker2').colorpicker()

            $('.my-colorpicker2').on('colorpickerChange', function(event) {
                $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
            })

            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })

        })
        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function() {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })

        // DropzoneJS Demo Code Start
        Dropzone.autoDiscover = false

        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode = document.querySelector("#template")
        previewNode.id = ""
        var previewTemplate = previewNode.parentNode.innerHTML
        previewNode.parentNode.removeChild(previewNode)

        var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
            url: "/target-url", // Set the url
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: "#previews", // Define the container to display the previews
            clickable: ".fileinput-button" // Define the element that should be used as click trigger to select

        });

        myDropzone.on("addedfile", function(file) {
            // Hookup the start button
            file.previewElement.querySelector(".start").onclick = function() {
                myDropzone.enqueueFile(file);
            };
        });

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function(progress) {
            document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
        });

        myDropzone.on("sending", function(file) {
            // Show the total progress bar when upload starts
            document.querySelector("#total-progress").style.opacity = "1";
            // And disable the start button
            file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
        });

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("queuecomplete", function(progress) {
            document.querySelector("#total-progress").style.opacity = "0";
        });

        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.
        document.querySelector("#actions .start").onclick = function() {
            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
        };
        document.querySelector("#actions .cancel").onclick = function() {
            myDropzone.removeAllFiles(true);
        };
        // DropzoneJS Demo Code End
    </script>
    <script>
        $(function() {
            $('#bulanPesan').datetimepicker({
                viewMode: 'months',
                format: 'MM/YYYY'
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables dengan ID "example1"
            var table = $('#example3').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });

            // Tambahkan fungsi pencarian berdasarkan nama barang
            $('#search').on('keyup', function() {
                table.search(this.value).draw();
            });
        });
    </script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script>
        function submitForm() {
            document.getElementById("formTampilkan").submit();
        }
    </script>

</body>

</html>