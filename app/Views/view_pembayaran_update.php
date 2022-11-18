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
        <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
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
                    <a href="<?= base_url('pembayaran'); ?>" class="nav-link active">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pembayaran</p>
                    </a>
                </li>
            </ul>
        </li>
    <?php } ?>
    <?php if (session()->get('userLevel') == 0 || session()->get('userLevel') == 2) { ?>
        <li class="nav-item">
            <a href="<?= base_url('report'); ?>" class="nav-link">
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
                    <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('pembayaran') ?>">Pembayaran</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
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
            <form action="<?= base_url('pembayaran/edit') ?>" method="POST" enctype="multipart/form-data">
                <?php
                foreach ($pembayaran as $row) : ?>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Faktur Pemesanan</label>
                                <input type="hidden" id="idpembayaran" value="<?= $row['pembayaran_id']; ?>" name="idpembayaran" required readonly class="form-control idpembayaran" />
                                <input type="text" id="fakturpemesanan" value="<?= $row['pembayaran_faktur']; ?>" name="fakturpemesanan" required readonly class="form-control fakturpemesanan" />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Pelanggan</label>
                                <input type="text" value="<?= $row['pelanggan_nama']; ?>" readonly class="form-control namapelanggan" id="namapelanggan" name="namapelanggan" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Tanggal Pembayaran</label>
                                <input type="date" value="<?= $row['pembayaran_tanggal']; ?>" class="form-control tanggalpembayaran" id="tanggalpembayaran" name="tanggalpembayaran" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Bukti Pembayaran</label>
                                <input type="file" class="form-control buktipembayaran" id="buktipembayaran" name="buktipembayaran" required>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <br>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Jenis Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody id="coba">
                                <?php $no = 0;
                                foreach ($detailpemesanan as $row) : $no++ ?>
                                    <tr>
                                        <td> <?= $row['produk_nama']; ?></td>
                                        <td> <?= $row['jenis_nama']; ?></td>
                                        <td>Rp. <?= $row['produk_harga']; ?></td>
                                        <td> <?= $row['detail_pemesanan_qty']; ?></td>
                                        <td>Rp. <?= $row['detail_pemesanan_jumlah']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br><br>
                <?php
                foreach ($pembayaran as $row) : ?>
                    <div class="row justify-content-end">
                        <div class="col-lg-3">
                            <label for="">Total Item :</label>
                            <input type="text" value="<?= $row['pemesanan_total_item']; ?>" readonly class="form-control totalitem"></input>
                        </div>
                    </div>
                    <br>
                    <div class="row justify-content-end">
                        <div class="col-lg-3">
                            <label for="">Total Harga :</label>
                            <input type="text" value="<?= $row['pemesanan_total_harga']; ?>" readonly class="form-control totalharga"></input>
                        </div>
                    </div>
                <?php endforeach; ?>
                <br>
                <div class="row justify-content-end">
                    <div class="col-lg-3">
                        <a href="<?= base_url('pembayaran'); ?>" class="btn btn-secondary btn-sm">
                            Kembali
                        </a>
                        <button class="btn btn-warning btn-sm" type="submit">
                            Update & Cetak
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<script>
    let qty = 0;
    let totalharga = 0;

    function onlyNumber(event) {
        var angka = (event.which) ? event.which : event.keyCode
        if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
            return false;
        return true;
    }

    $(function() {
        $("#tabledua").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $("#tabletiga").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });

    $(document).ready(function() {
        $(".btn-choosedua").click(function() {
            const fakturpemesanan = $(this).data('faktur');
            const nama = $(this).data('nama');
            const tanggal = $(this).data('tanggal');
            const totalitem = $(this).data('totalitem');
            const totalharga = $(this).data('totalharga');
            $('.fakturpemesanan').val(fakturpemesanan);
            $('.namapelanggan').val(nama);
            $('.tanggalpemesanan').val(tanggal);
            $('.totalitem').val(totalitem);
            $('.totalharga').val(totalharga);

            reload(fakturpemesanan)
            $("#searchPemesanan").modal('hide');
        });
    });

    function reload(fakturpemesanan) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('pembayaran/detail-index'); ?>",
            data: {
                fakturpemesanan: fakturpemesanan
            },
            beforeSend: function(f) {
                $('#coba').html(`<div class="text-center">
                Mencari data...
                </div>`);
            },
            success: function(response) {
                $('#coba').html(response);
            },
            error: function(xhr, ajaxOption, thrownError) {
                alert(xhr.status + '\n' + thrownError)
            }
        });
    }
</script>

<?= $this->endSection(); ?>