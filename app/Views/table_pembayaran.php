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