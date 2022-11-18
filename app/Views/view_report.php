<?= $this->extend('main'); ?>

<?= $this->section('menu'); ?>

<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
        <a href="<?= base_url('/'); ?>" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Dashboard
            </p>
        </a>
    </li>
    <?php if (session()->get('userLevel') == 0 || session()->get('userLevel') == 1 || session()->get('userLevel') == 3) { ?>
        <?php if (session()->get('userLevel') == 0 || session()->get('userLevel') == 1) { ?>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa fa-table"></i>
                    <p>
                        Master
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <?php if (session()->get('userLevel') == 0) { ?>
                        <li class="nav-item">
                            <a href="<?= base_url('user'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a href="<?= base_url('pelanggan'); ?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pelanggan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('jenis'); ?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Jenis</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('produk'); ?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Produk</p>
                        </a>
                    </li>
                </ul>
            </li>
        <?php } ?>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa fa-receipt"></i>
                <p>
                    Transaksi
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview ">
                <li class="nav-item">
                    <a href="<?= base_url('pemesanan'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pemesanan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('pembayaran'); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pembayaran</p>
                    </a>
                </li>
            </ul>
        </li>
    <?php } ?>
    <?php if (session()->get('userLevel') == 0 || session()->get('userLevel') == 2) { ?>
        <li class="nav-item">
            <a href="<?= base_url('report'); ?>" class="nav-link active">
                <i class="nav-icon far fa fa-book"></i>
                <p>
                    Laporan
                </p>
            </a>
        </li>
    <?php } ?>
    <li class="nav-item">
        <a href="<?= base_url('logout'); ?>" class="nav-link">
            <i class="nav-icon far fa fa-sign-out-alt"></i>
            <p>
                Keluar
            </p>
        </a>
    </li>
</ul>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Laporan</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="card">
        <?php if (session()->getFlashdata('success')) { ?>
            <div class="alert alert-success icons-alert m-2">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?php echo session()->getFlashdata('success'); ?>
            </div>
        <?php } else if (session()->getFlashdata('failed')) { ?>
            <div class="alert alert-danger icons-alert m-2">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?php echo session()->getFlashdata('failed'); ?>
            </div>
        <?php } ?>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="tablereport" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Laporan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Laporan Transaksi Pemesanan</td>
                        <td style="text-align: center;">
                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#printPemesanan"><i class="fa fa-print"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Laporan Transaksi Pemesanan Per Bulan</td>
                        <td style="text-align: center;">
                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#printPemesananPerBulan"><i class="fa fa-print"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Laporan Transaksi Pemesanan Per Tahun</td>
                        <td style="text-align: center;">
                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#printPemesananPerTahun"><i class="fa fa-print"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Laporan Transaksi Pembayaran</td>
                        <td style="text-align: center;">
                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#printPembayaran"><i class="fa fa-print"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Laporan Transaksi Pembayaran Per Bulan</td>
                        <td style="text-align: center;">
                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#printPembayaranPerBulan"><i class="fa fa-print"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Laporan Transaksi Pembayaran Per Tahun</td>
                        <td style="text-align: center;">
                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#printPembayaranPerTahun"><i class="fa fa-print"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<div id="printPemesanan" class="modal fade" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="">Filter Data</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Tanggal Awal</label>
                            <input type="date" class="form-control tanggalawalpemesanan" id="tanggalawalpemesanan" name="tanggalawalpemesanan" required placeholder="Masukan tanggalawalpemesanan">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Tanggal Akhir</label>
                            <input type="date" class="form-control tanggalakhirpemesanan" id="tanggalakhirpemesanan" name="tanggalakhirpemesanan" required placeholder="Masukan tanggalakhirpemesanan">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="float-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button onclick="cetakPemesanan()" class="btn btn-warning">Cetak</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="printPemesananPerBulan" class="modal fade" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="">Filter Data</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Bulan</label>
                            <select name="bulan" id="bulan" class="form-control bulan">
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tahun</label>
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="text" onkeypress="return onlyNumber(event)" name="tahun" class="form-control tahun">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="float-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button onclick="cetakPemesananBulan()" class="btn btn-warning">Cetak</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="printPemesananPerTahun" class="modal fade" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="">Filter Data</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Tahun</label>
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="text" onkeypress="return onlyNumber(event)" name="tahunpesantahun" class="form-control tahunpesantahun">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="float-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button onclick="cetakPemesananTahun()" class="btn btn-warning">Cetak</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="printPembayaran" class="modal fade" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="">Filter Data</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Tanggal Awal</label>
                            <input type="date" class="form-control tanggalawalpembayaran" id="tanggalawalpembayaran" name="tanggalawalpembayaran" required placeholder="Masukan tanggalawalpembayaran">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Tanggal Akhir</label>
                            <input type="date" class="form-control tanggalakhirpembayaran" id="tanggalakhirpembayaran" name="tanggalakhirpembayaran" required placeholder="Masukan tanggalakhirpembayaran">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="float-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button onclick="cetakPembayaran()" class="btn btn-warning">Cetak</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="printPembayaranPerBulan" class="modal fade" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="">Filter Data</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Bulan</label>
                            <select name="bulanbayar" id="bulanbayar" class="form-control bulanbayar">
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tahun</label>
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="text" onkeypress="return onlyNumber(event)" name="tahunbayar" class="form-control tahunbayar">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="float-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button onclick="cetakPembayaranBulan()" class="btn btn-warning">Cetak</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="printPembayaranPerTahun" class="modal fade" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="">Filter Data</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Tahun</label>
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="text" onkeypress="return onlyNumber(event)" name="tahunbayartahun" class="form-control tahunbayartahun">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="float-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button onclick="cetakPembayaranTahun()" class="btn btn-warning">Cetak</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function cetakPemesanan() {
        let tanggalawalpemesanan = $('.tanggalawalpemesanan').val()
        let tanggalakhirpemesanan = $('.tanggalakhirpemesanan').val()

        window.open("/report/pemesanan/" + tanggalawalpemesanan + '/' + tanggalakhirpemesanan, "_blank");
    }

    function cetakPemesananBulan() {
        let bulan = $('.bulan').val()
        let tahun = $('.tahun').val()

        window.open("/report/pemesanan/bulan/" + bulan + '/' + tahun, "_blank");
    }

    function cetakPemesananTahun() {
        let tahun = $('.tahunpesantahun').val()

        window.open("/report/pesan/tahun/" + tahun, "_blank");
    }

    function cetakPembayaran() {
        let tanggalawalpembayaran = $('.tanggalawalpembayaran').val()
        let tanggalakhirpembayaran = $('.tanggalakhirpembayaran').val()

        window.open("/report/pembayaran/" + tanggalawalpembayaran + '/' + tanggalakhirpembayaran, "_blank");
    }

    function cetakPembayaranBulan() {
        let bulan = $('.bulanbayar').val()
        let tahun = $('.tahunbayar').val()

        window.open("/report/pembayaran/bulan/" + bulan + '/' + tahun, "_blank");
    }

    function cetakPembayaranTahun() {
        let tahun = $('.tahunbayartahun').val()

        window.open("/report/bayar/tahun/" + tahun, "_blank");
    }

    $(document).ready(function() {
        $('#tablereport').DataTable({
            order: [
                [0, 'asc']
            ],
        });
    });

    function onlyNumber(event) {
        var angka = (event.which) ? event.which : event.keyCode
        if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
            return false;
        return true;
    }
</script>

<?= $this->endSection(); ?>