<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Pemesanan</title>
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
                <td>Laporan Data Pemesanan</td>
            </tr>
        </table>
        <table class="head" style="margin-bottom: 20px; text-align: center;">
            <tr>
                <td width="130px">Tanggal Awal</td>
                <td><strong><?= $tanggalawalpemesanan; ?></strong></td>
                <td width="130px">Tanggal Akhir</td>
                <td><strong><?= $tanggalakhirpemesanan; ?></strong></td>
            </tr>
        </table>
        <table border="1" class="body" width="625">
            <thead>
                <tr style="height: 25px;">
                    <th>No.</th>
                    <th>Faktur</th>
                    <th>Pelanggan</th>
                    <th>Tanggal</th>
                    <th>Total Item</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                foreach ($pemesanan as $row) : $no++ ?>
                    <tr style="height: 20px; text-align: center;">
                        <td> <?= $no; ?></td>
                        <td> <?= $row['pemesanan_faktur']; ?></td>
                        <td> <?= $row['pelanggan_nama']; ?></td>
                        <td> <?= $row['pemesanan_tanggal']; ?></td>
                        <td> <?= $row['pemesanan_total_item']; ?></td>
                        <td>Rp. <?= $row['pemesanan_total_harga']; ?></td>
                        <td>
                            <?php if ($row['pemesanan_status'] == 0) { ?>
                                Belum Bayar
                            <?php } else if ($row['pemesanan_status'] == 1) { ?>
                                Sudah Bayar
                            <?php } else if ($row['pemesanan_status'] == 2) { ?>
                                Selesai
                            <?php } else { ?>
                                Batal
                            <?php } ?>
                        </td>
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