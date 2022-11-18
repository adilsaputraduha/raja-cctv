<!DOCTYPE html>
<html>

<head>
    <title>Faktur Pembayaran</title>
    <link rel="shortcut icon" href="<?= base_url(); ?>/assets/images/logo.png">
    <style type="text/css">
        .head {
            border-style: double;
            border-width: 3px;
            border-color: white;
        }

        .body {
            border-collapse: collapse;
            border: 1px;
            border-color: black;
        }

        table tr .text2 {
            text-align: right;
            font-size: 13px;
        }

        table tr .text {
            text-align: center;
            font-size: 13px;
        }

        table tr td {
            font-size: 13px;
        }
    </style>
</head>

<body>
    <center>
        <table class="head" width="625">
            <tr>
                <td>
                    <center>
                        <font size="5"><b>RAJA CCTV</b></font><br>
                        <font size="2"><i>Email : rajacctv@gmail.com Kode Pos : 25171 Telp./Fax (0831) 8997 6872</i></font>
                    </center>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
        </table>
        <table class="head" style="margin-bottom: 20px;">
            <tr>
                <td>Faktur Pembayaran</td>
            </tr>
        </table>
        <table class="head" style="margin-bottom: 20px;" width="625">
            <?php $no = 0;
            foreach ($pembayaran as $row) : $no++ ?>
                <tr>
                    <td width="20%">Nomor Pemesanan</td>
                    <td width="20%"><strong><?= $nomorpemesanan; ?></strong></td>
                    <td width="20%">Pelanggan</td>
                    <td width="20%"><strong><?= $row['pelanggan_nama']; ?></strong></td>
                </tr>
                <tr>
                    <td>Tanggal Pemesanan</td>
                    <td><strong><?= $row['pemesanan_tanggal']; ?></strong></td>
                    <td>Tanggal Pembayaran</td>
                    <td><strong><?= $row['pembayaran_tanggal']; ?></strong></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <table border="1" class="body" width="625">
            <thead>
                <tr style="height: 25px;">
                    <th>Nama Produk</th>
                    <th>Jenis Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                foreach ($detailpemesanan as $row) : $no++ ?>
                    <tr style="height: 20px; text-align: center;">
                        <td> <?= $row['produk_nama']; ?></td>
                        <td> <?= $row['jenis_nama']; ?></td>
                        <td>Rp. <?= $row['produk_harga']; ?></td>
                        <td> <?= $row['detail_pemesanan_qty']; ?></td>
                        <td>Rp. <?= $row['detail_pemesanan_jumlah']; ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php
                foreach ($pembayaran as $row) : ?>
                    <tr style="height: 20px; text-align: center;">
                        <td colspan="3">Total</td>
                        <td> <?= $row['pemesanan_total_item']; ?></td>
                        <td>Rp. <?= $row['pemesanan_total_harga']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <table width="625" style="margin-top: 30px;">
            <tr style="text-align: right !important;">
                <td>Padang, <?= date("d M Y"); ?></td>
            </tr>
            <tr style="text-align: right !important;">
                <td>Pimpinan Raja CCTV</td>
            </tr>
            <tr style="text-align: right !important; height: 120px;">
                <td>(...................................)</td>
            </tr>
        </table>
    </center>
</body>

<script>
    window.print();
</script>

</html>