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

<script>
    function ajaxDelete(id, quantity, jumlah) {
        $.ajax({
            url: "<?= base_url('admin/pemesanan/detail-delete'); ?>",
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
</script>