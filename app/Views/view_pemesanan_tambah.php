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
                    <a href="<?= base_url('pemesanan'); ?>" class="nav-link active">
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
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('pemesanan') ?>">Pemesanan</a></li>
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
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Faktur Pemesanan</label>
                        <input type="text" value="<?= $nomor; ?>" readonly class="form-control fakturpemesanan <?= ($validation->hasError('fakturpemesanan')) ? 'is-invalid' : ''; ?>" id="fakturpemesanan" name="fakturpemesanan" value="<?= old('fakturpemesanan'); ?>" required placeholder="Masukan nomor pemesanan">
                        <div class="invalid-feedback">
                            <?= $validation->getError('fakturpemesanan'); ?>
                        </div>
                    </div>
                </div>
                <?php if (session()->get('userLevel') == 0 || session()->get('userLevel') == 1) { ?>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Pelanggan</label>
                            <div class="input-group mb-3">
                                <input type="hidden" id="idpelanggan" name="idpelanggan" class="idpelanggan">
                                <input type="text" id="namapelanggan" name="namapelanggan" required readonly class="form-control namapelanggan" />
                                <button class="btn btn-warning ml-1" data-toggle="modal" data-target="#searchPelanggan" type="button">Cari</button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Tanggal Pemesanan</label>
                        <input type="date" class="form-control tanggalpemesanan <?= ($validation->hasError('tanggalpemesanan')) ? 'is-invalid' : ''; ?>" id="tanggalpemesanan" name="tanggalpemesanan" value="<?= old('tanggalpemesanan'); ?>" required placeholder="Masukan tanggalpemesanan">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tanggalpemesanan'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <div class="input-group mb-3">
                            <input type="hidden" id="idproduk" class="idproduk" name="idproduk">
                            <input type="text" id="namaproduk" name="namaproduk" required readonly class="form-control namaproduk" />
                            <button class="btn btn-warning ml-1" data-toggle="modal" data-target="#searchProduk" type="button">Cari</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Jenis Produk</label>
                        <input type="text" readonly class="form-control jenisproduk" id="jenisproduk" name="jenisproduk" required>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" readonly class="form-control hargaproduk" id="hargaproduk" name="hargaproduk" required>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Qty</label>
                        <input type="text" class="form-control qtyproduk" id="qtyproduk" name="qtyproduk" required>
                    </div>
                </div>
                <div class="col-sm-1">
                    <label>Aksi</label>
                    <div class="form-group">
                        <button class="btn btn-warning" onclick="ajaxSave()">+</button>
                    </div>
                </div>
            </div>
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
                                <th>Aksi</th>
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
                                    <td style="text-align: center;">
                                        <button class="btn btn-sm btn-danger" onclick="ajaxDelete(<?= $row['detail_pemesanan_id']; ?>, <?= $row['detail_pemesanan_qty']; ?>, <?= $row['detail_pemesanan_jumlah']; ?>)"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <br><br>
            <div class="row justify-content-end">
                <div class="col-lg-3">
                    <label for="">Total Item :</label>
                    <input type="text" readonly value="<?= $totalitem ?>" class="form-control totalitem"></input>
                </div>
            </div>
            <br>
            <div class="row justify-content-end">
                <div class="col-lg-3">
                    <label for="">Total Harga :</label>
                    <input type="text" readonly value="<?= $totalharga ?>" class="form-control totalharga"></input>
                </div>
            </div>
            <br>
            <?php if (session()->get('userLevel') == 3) { ?>
                <div class="row justify-content-end">
                    <div class="col-lg-3">
                        <a href="<?= base_url('pemesanan'); ?>" class="btn btn-secondary btn-sm">
                            Kembali
                        </a>
                        <button class="btn btn-warning btn-sm" onclick="simpanTransaksiPelanggan()">
                            Simpan & Cetak
                        </button>
                    </div>
                </div>
            <?php } else { ?>
                <div class="row justify-content-end">
                    <div class="col-lg-3">
                        <a href="<?= base_url('pemesanan'); ?>" class="btn btn-secondary btn-sm">
                            Kembali
                        </a>
                        <button class="btn btn-warning btn-sm" onclick="simpanTransaksi()">
                            Simpan & Cetak
                        </button>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<div id="searchPelanggan" class="modal fade" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="">Cari Data</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tabledua" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No. Hp</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($pelanggan as $row) : $no++ ?>
                            <tr>
                                <td> <?= $row['pelanggan_email']; ?></td>
                                <td> <?= $row['pelanggan_nama']; ?></td>
                                <td> <?= $row['pelanggan_alamat']; ?></td>
                                <td> <?= $row['pelanggan_nohp']; ?></td>
                                <td style="text-align: center;">
                                    <button class="btn btn-sm btn-warning btn-choosesatu" data-id="<?= $row['pelanggan_id']; ?>" data-nama="<?= $row['pelanggan_nama']; ?>"><i class="fa fa-arrow-left"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="searchProduk" class="modal fade" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="">Cari Data</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tabletiga" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Jenis</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($produk as $row) : $no++ ?>
                            <tr>
                                <td> <?= $row['produk_nama']; ?></td>
                                <td>Rp. <?= $row['produk_harga']; ?></td>
                                <td> <?= $row['jenis_nama']; ?></td>
                                <td> <?= $row['produk_deskripsi']; ?></td>
                                <td>
                                    <img src="<?= base_url() ?>/fotoproduk/<?= $row['produk_gambar']; ?>" alt="" width="100px">
                                </td>
                                <td style="text-align: center;">
                                    <button class="btn btn-sm btn-warning btn-choosedua" data-kode="<?= $row['produk_id']; ?>" data-nama="<?= $row['produk_nama']; ?>" data-harga="<?= $row['produk_harga']; ?>" data-jenis="<?= $row['jenis_nama']; ?>"><i class="fa fa-arrow-left"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    let qty = $('.totalitem').val();
    let totalharga = $('.totalharga').val();

    function onlyNumber(event) {
        var angka = (event.which) ? event.which : event.keyCode
        if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
            return false;
        return true;
    }

    function hitungTotal() {
        let qtyproduk = $('.qtyproduk').val()
        let hargaproduk = $('.hargaproduk').val()

        let hargaxqty = hargaproduk * qtyproduk

        qty = parseInt(qty) + parseInt(qtyproduk)
        totalharga = parseInt(totalharga) + parseInt(hargaxqty)

        $('.totalitem').val(qty);
        $('.totalharga').val(totalharga);
    }

    function hitungTotalHapus(quantity, jumlah) {
        totalharga = parseInt(totalharga) - parseInt(jumlah)
        qty = parseInt(qty) - parseInt(quantity)

        $('.totalitem').val(qty);
        $('.totalharga').val(totalharga);
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
        $(".btn-choosesatu").click(function() {
            const idpelanggan = $(this).data('id');
            const namapelanggan = $(this).data('nama');
            $('.idpelanggan').val(idpelanggan);
            $('.namapelanggan').val(namapelanggan);

            $("#searchPelanggan").modal('hide');
        });

        $(".btn-choosedua").click(function() {
            const kodeproduk = $(this).data('kode');
            const namaproduk = $(this).data('nama');
            const hargaproduk = $(this).data('harga');
            const jenisproduk = $(this).data('jenis');
            $('.idproduk').val(kodeproduk);
            $('.namaproduk').val(namaproduk);
            $('.hargaproduk').val(hargaproduk);
            $('.jenisproduk').val(jenisproduk);
            $('.qtyproduk').val(1);

            $("#searchProduk").modal('hide');
        });
    });

    function reload() {
        let fakturpemesanan = $('.fakturpemesanan').val();

        $.ajax({
            type: "POST",
            url: "<?= base_url('pemesanan/detail-index'); ?>",
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

    function ajaxSave() {
        let fakturpemesanan = $('.fakturpemesanan').val()
        let kodeproduk = $('.idproduk').val()
        let hargaproduk = $('.hargaproduk').val()
        let qtyproduk = $('.qtyproduk').val()

        let jumlahharga = parseInt(hargaproduk) * parseInt(qtyproduk)

        if (kodeproduk.length == 0) {
            alert('Produk tidak boleh kosong')
        } else if (qtyproduk.length == 0 || qtyproduk == 0) {
            alert('Qty tidak boleh kosong')
        } else {
            $.ajax({
                url: "<?= base_url('pemesanan/detail-save'); ?>",
                type: "POST",
                data: {
                    fakturpemesanan: fakturpemesanan,
                    kodeproduk: kodeproduk,
                    qtyproduk: qtyproduk,
                    hargaproduk: hargaproduk,
                    jumlahharga: jumlahharga,
                },
                success: function(data) {
                    reload();
                    hitungTotal();
                    $('.idproduk').val('');
                    $('.namaproduk').val('');
                    $('.hargaproduk').val('');
                    $('.jenisproduk').val('');
                    $('.qtyproduk').val('');
                },
                error: function(xhr, ajaxOption, thrownError) {
                    alert(xhr.status + '\n' + thrownError)
                }
            });
        }
    }

    function ajaxDelete(id, quantity, jumlah) {
        $.ajax({
            url: "<?= base_url('pemesanan/detail-delete'); ?>",
            type: "POST",
            data: {
                detailid: id,
            },
            success: function(data) {
                reload();
                hitungTotalHapus(quantity, jumlah);
            },
            error: function(xhr, ajaxOption, thrownError) {
                alert(xhr.status + '\n' + thrownError)
            }
        });
    }

    function simpanTransaksi() {
        let fakturpemesanan = $('.fakturpemesanan').val()
        let tanggalpemesanan = $('.tanggalpemesanan').val()
        let idpelanggan = $('.idpelanggan').val()
        let totalitem = $('.totalitem').val()
        let totalharga = $('.totalharga').val()

        if (idpelanggan.length == 0) {
            alert('Pelanggan tidak boleh kosong')
        } else if (tanggalpemesanan.length == 0) {
            alert('Tanggal pemesanan tidak boleh kosong')
        } else if (totalitem.length == 0 || totalitem == 0) {
            alert('Item tidak boleh kosong')
        } else {
            $.ajax({
                url: "<?= base_url('pemesanan/save'); ?>",
                type: "POST",
                data: {
                    fakturpemesanan: fakturpemesanan,
                    tanggalpemesanan: tanggalpemesanan,
                    idpelanggan: idpelanggan,
                    totalitem: totalitem,
                    totalharga: totalharga,
                },
                success: function(data) {
                    cetakFaktur(fakturpemesanan);
                    window.location = "<?= base_url('pemesanan'); ?>";
                },
                error: function(xhr, ajaxOption, thrownError) {
                    alert(xhr.status + '\n' + thrownError)
                }
            });
        }
    }

    function simpanTransaksiPelanggan() {
        let fakturpemesanan = $('.fakturpemesanan').val()
        let tanggalpemesanan = $('.tanggalpemesanan').val()
        let idpelanggan = $('.idpelanggan').val()
        let totalitem = $('.totalitem').val()
        let totalharga = $('.totalharga').val()

        if (tanggalpemesanan.length == 0) {
            alert('Tanggal pemesanan tidak boleh kosong')
        } else if (totalitem.length == 0 || totalitem == 0) {
            alert('Item tidak boleh kosong')
        } else {
            $.ajax({
                url: "<?= base_url('pemesanan/save'); ?>",
                type: "POST",
                data: {
                    fakturpemesanan: fakturpemesanan,
                    tanggalpemesanan: tanggalpemesanan,
                    idpelanggan: idpelanggan,
                    totalitem: totalitem,
                    totalharga: totalharga,
                },
                success: function(data) {
                    cetakFaktur(fakturpemesanan);
                    window.location = "<?= base_url('pemesanan'); ?>";
                },
                error: function(xhr, ajaxOption, thrownError) {
                    alert(xhr.status + '\n' + thrownError)
                }
            });
        }
    }

    function cetakFaktur(fakturpemesanan) {
        window.open("/pemesanan/faktur/" + fakturpemesanan, "_blank");
    }
</script>

<?= $this->endSection(); ?>