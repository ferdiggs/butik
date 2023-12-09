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
        <!-- Navbar -->

        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        include "sidebar.php";
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v1</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->

                    <!-- general form elements disabled -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Form Pemesanan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="post" action="simpan_pesanan.php">
                                <!-- Input Nama Pelanggan -->
                                <div class="form-group">
                                    <label>Nama Pelanggan</label>
                                    <select name="id_pelanggan" class="form-control select2" style="width: 100%;">
                                        <option selected="selected">Pilih</option>
                                        <?php
                                        include "koneksi.php";
                                        $query = mysqli_query($conn, "SELECT * FROM pelanggan");

                                        while ($pelanggan = mysqli_fetch_array($query)) {
                                            echo "<option value='" . $pelanggan['id_pelanggan'] . "'>" . $pelanggan['nama_pelanggan'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Input Tanggal Beli -->
                                <div class="form-group">
                                    <label>Tanggal Pesan:</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" name="tgl_pesan" class="form-control datetimepicker-input" data-target="#reservationdate" />
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Tanggal Ambil:</label>
                                    <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                        <input type="text" name="tgl_ambil" class="form-control datetimepicker-input" data-target="#reservationdate1" />
                                        <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Input Jumlah -->
                                <div class="form-group">
                                    <label>Jumlah Pesanan</label>
                                    <input type="text" name="jumlah_pesan" class="form-control" placeholder="Enter ...">
                                </div>


                                <div class="form-group">
                                    <label>Bahan Pakaian</label>
                                    <input type="text" name="bahan" class="form-control" placeholder="Enter ...">
                                </div>

                                <div class="form-group">
                                    <label>Warna Pakaian</label>
                                    <input type="text" name="warna" class="form-control" placeholder="Enter ...">
                                </div>

                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control" placeholder="Enter ...">
                                </div>

                                <!-- Input Jenis Pembayaran (Radio Button) -->
                                <div class="form-group">
                                    <label>Jenis Pembayaran</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_pembayaran" value="cash">
                                        <label class="form-check-label">Cash</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_pembayaran" value="kredit">
                                        <label class="form-check-label">Kredit</label>
                                    </div>
                                </div>

                                <!-- Input Total Biaya -->
                                <div class="form-group">
                                    <label>Total Biaya</label>
                                    <input type="text" name="total_biaya" class="form-control" placeholder="Enter ..." id="total_biaya">
                                </div>


                                <!-- Input Jumlah Pembayaran -->
                                <div class="form-group">
                                    <label>Jumlah Pembayaran</label>
                                    <input type="text" name="jumlah_bayar" class="form-control" placeholder="Enter ..." id="jumlah_bayar">
                                </div>

                                <!-- Input Sisa Pembayaran (otomatis diisi setelah input total biaya dan jumlah pembayaran) -->
                                <div class="form-group">
                                    <label>Sisa Pembayaran</label>
                                    <input type="text" name="sisa_pembayaran" class="form-control" placeholder="Enter ..." id="sisa_pembayaran" readonly>
                                </div>

                                <!-- Tombol Simpan -->
                                <div class="form-group">
                                    <button type="submit" name="simpan" class="btn btn-block btn-success btn-sm">Simpan</button>
                                </div>


                                <!-- Tautan untuk menginputkan ukuran -->


                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Pesanan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="white-space: nowrap;">No</th>
                                            <th style="white-space: nowrap;">Nama Pelanggan</th>
                                            <th style="white-space: nowrap;">ID Pesanan</th>
                                            <th style="white-space: nowrap;">Tanggal Pesan</th>
                                            <th style="white-space: nowrap;">Tanggal Ambil</th>
                                            <th style="white-space: nowrap;">Jumlah</th>
                                            <th style="white-space: nowrap;">Bahan</th>
                                            <th style="white-space: nowrap;">Warna</th>
                                            <th style="white-space: nowrap;">Keterangan</th>
                                            <th style="white-space: nowrap;">Jenis Pembayaran</th>
                                            <th style="white-space: nowrap;">Total Biaya</th>
                                            <th style="white-space: nowrap;">Jumlah Bayar</th>
                                            <th style="white-space: nowrap;">Sisa Pembayaran</th>
                                            <th style="white-space: nowrap;" class="text-center">Aksi</th> <!-- Tambah kolom Aksi -->
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        include "koneksi.php";

                                        $query_pesanan = mysqli_query($conn, "SELECT * FROM pesanan");

                                        if (mysqli_num_rows($query_pesanan) > 0) {
                                            $no_pesanan = 1;
                                            while ($data_pesanan = mysqli_fetch_assoc($query_pesanan)) {
                                                echo '<tr>';
                                                echo '<td>' . $no_pesanan . '</td>';
                                                echo '<td>' . $data_pesanan['nama_pelanggan'] . '</td>';
                                                echo '<td>' . $data_pesanan['id_pesanan'] . '</td>';
                                                echo '<td>' . $data_pesanan['tgl_pesan'] . '</td>';
                                                echo '<td>' . $data_pesanan['tgl_ambil'] . '</td>';
                                                echo '<td>' . $data_pesanan['jumlah_pesan'] . '</td>';
                                                echo '<td>' . $data_pesanan['bahan'] . '</td>';
                                                echo '<td>' . $data_pesanan['warna'] . '</td>';
                                                echo '<td>' . $data_pesanan['keterangan'] . '</td>';
                                                echo '<td>' . $data_pesanan['jenis_pembayaran'] . '</td>';
                                                echo '<td>' . $data_pesanan['total_biaya'] . '</td>';
                                                echo '<td>' . $data_pesanan['jumlah_bayar'] . '</td>';
                                                echo '<td>' . $data_pesanan['sisa_pembayaran'] . '</td>';
                                                echo '<td>
                                            <div class="btn-group">
                                                     <a href="edit_pesanan.php?id_pesanan=' . $data_pesanan['id_pesanan'] . '" class="btn btn-warning btn-sm">Edit</a>
                                                        <a href="hapus_pesanan.php?id_pesanan=' . $data_pesanan['id_pesanan'] . '" class="btn btn-danger btn-sm ml-1" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">Hapus</a>
                                                     <a href="cetak_bukti_pemesanan.php?id_pesanan=' . $data_pesanan['id_pesanan'] . '" class="btn btn-primary btn-sm ml-1">Cetak Bukti Pemesanan</a>
                                                   </div>
                                                     </td>';
                                                echo '</tr>';
                                                $no_pesanan++;
                                            }
                                        } else {
                                            echo '<tr><td colspan="9">Tidak ada data pesanan</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>



                    <!-- /.card -->

                    <!-- /.container-fluid -->
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>

    <!-- jQuery -->
    <!-- Skrip JavaScript untuk menghitung sisa pembayaran dan format rupiah -->
<script>
    // Fungsi untuk mengubah angka menjadi format rupiah
    function formatRupiah(angka) {
        var reverse = angka.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return 'Rp ' + ribuan;
    }

    // Menggunakan jQuery untuk memudahkan manipulasi DOM
    $(document).ready(function () {
        // Event listener saat nilai total biaya atau jumlah pembayaran berubah
        $("#total_biaya, #jumlah_bayar").on("input", function () {
            // Ambil nilai total biaya dan jumlah pembayaran
            var totalBiaya = parseFloat($("#total_biaya").val()) || 0;
            var jumlahBayar = parseFloat($("#jumlah_bayar").val()) || 0;

            // Hitung dan set nilai sisa pembayaran
            var sisaPembayaran = totalBiaya - jumlahBayar;

            // Format sisa pembayaran ke dalam format rupiah
            var sisaPembayaranFormatted = formatRupiah(sisaPembayaran);

            // Set nilai sisa pembayaran yang telah diformat
            $("#sisa_pembayaran").val(sisaPembayaranFormatted);
        });
    });
</script>

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

            $('#reservationdate1').datetimepicker({
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
            clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
        })

        myDropzone.on("addedfile", function(file) {
            // Hookup the start button
            file.previewElement.querySelector(".start").onclick = function() {
                myDropzone.enqueueFile(file)
            }
        })

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function(progress) {
            document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
        })

        myDropzone.on("sending", function(file) {
            // Show the total progress bar when upload starts
            document.querySelector("#total-progress").style.opacity = "1"
            // And disable the start button
            file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
        })

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("queuecomplete", function(progress) {
            document.querySelector("#total-progress").style.opacity = "0"
        })

        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.
        document.querySelector("#actions .start").onclick = function() {
            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
        }
        document.querySelector("#actions .cancel").onclick = function() {
            myDropzone.removeAllFiles(true)
        }
        // DropzoneJS Demo Code End
    </script>
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables dengan ID "example1"
            var table = $('#example1').DataTable({
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

    </script>


</body>

</html>