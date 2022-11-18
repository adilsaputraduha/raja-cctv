<?= $this->extend('main'); ?>

<?= $this->section('menu'); ?>

<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
        <a href="<?= base_url('/'); ?>" class="nav-link active">
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
        <div class="row mt-2">
            <div class="col-sm-12">
            </div>
        </div>
    </div>
</div>

<?php if (session()->get('userLevel') == 0 || session()->get('userLevel') == 1  || session()->get('userLevel') == 2) { ?>
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $pelanggan; ?><sup style="font-size: 20px; margin-left: 5px;">Orang</sup></h3>
                            <p>Pelanggan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="<?= base_url('pelanggan'); ?>" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $user; ?><sup style="font-size: 20px; margin-left: 5px;">Orang</sup></h3>
                            <p>User</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-people"></i>
                        </div>
                        <a href="<?= base_url('user'); ?>" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $produk; ?><sup style="font-size: 20px; margin-left: 5px;">Produk</sup></h3>
                            <p>Produk</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-paper-airplane"></i>
                        </div>
                        <a href="<?= base_url('produk'); ?>" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $pemesanan; ?><sup style="font-size: 20px; margin-left: 5px;">Unit</sup></h3>
                            <p>Pemesanan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-list"></i>
                        </div>
                        <a href="<?= base_url('pemesanan'); ?>" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
<?php } ?>

<?php if (session()->get('userLevel') == 3) { ?>
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <h4>Produk yang dapat kamu pesan</h4>
            <div class="row mt-5">
                <?php $no = 0;
                foreach ($produklooping as $row) : $no++ ?>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-white">
                            <div class="inner">
                                <h3>Rp. <?= number_format($row['produk_harga']) ?></h3>
                                <p><?= $row['produk_nama']; ?></p>
                            </div>
                            <div class="icon ml-3">
                                <img src="<?= base_url() ?>/fotoproduk/<?= $row['produk_gambar']; ?>" width="100px" alt="">
                            </div>
                            <a data-toggle="modal" data-target="#showModal" class="small-box-footer">Detail Produk</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="form-group mt-5">
                <h6 class="text-dark">Untuk pembayaran pesanan, silahkan transfer ke rekening resmi Raja CCTV :</h6>
                <h6 class="text-dark">Nama Bank : Bank Nagari</h6>
                <h6 class="text-dark">Nomor Rekening : 0675535353</h6>
                <h6 class="text-dark">Atas Nama : Raja CCTV</h6>
                <h6 class="text-danger mt-2">Hati-hati penipuan!</h6>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <?php $no = 0;
    foreach ($produklooping as $row) : $no++ ?>
        <div id="showModal" class="modal fade" role="dialog" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="">Detail produk</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('pemesanan/pesansekarang'); ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="modal-body">
                            <input type="hidden" name="invoice" id="invoice" value="<?= $nomor ?>">
                            <input type="hidden" name="idproduk" id="idproduk" value="<?= $row['produk_id']; ?>">
                            <input type="hidden" name="hargaproduk" id="hargaproduk" value="<?= $row['produk_harga']; ?>">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nama Produk</label>
                                        <input type="text" readonly value="<?= $row['produk_nama']; ?>" class="form-control" id="nama" name="nama" required placeholder="Masukan nama">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="text" readonly value="Rp. <?= number_format($row['produk_harga']) ?>" class="form-control" id="harga" name="harga" required placeholder="Masukan harga">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Jenis</label>
                                        <input type="text" readonly value="<?= $row['jenis_nama']; ?>" class="form-control" id="harga" name="harga" required placeholder="Masukan harga">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <input type="text" readonly value="Rp. <?= $row['produk_deskripsi']; ?>" class="form-control" id="deskripsi" name="deskripsi" required placeholder="Masukan deskripsi">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="float-right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-warning">Pesan Sekarang</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php } ?>

<?= $this->endSection(); ?>