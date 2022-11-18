<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    public function getPembayaran()
    {
        $bulder = $this->db->table('tb_pembayaran')
            ->join('tb_pemesanan', 'pemesanan_faktur = pembayaran_faktur')
            ->join('tb_pelanggan', 'pemesanan_pelanggan = pelanggan_id');
        return $bulder->get();
    }
    public function getPembayaranByUser($id)
    {
        $bulder = $this->db->table('tb_pembayaran')
            ->join('tb_pemesanan', 'pemesanan_faktur = pembayaran_faktur')
            ->join('tb_pelanggan', 'pemesanan_pelanggan = pelanggan_id')
            ->where(['pemesanan_pelanggan' => $id]);
        return $bulder->get();
    }
    public function savePembayaran($data)
    {
        $query = $this->db->table('tb_pembayaran')->insert($data);
        return $query;
    }
    public function updatePembayaran($data, $id)
    {
        $query = $this->db->table('tb_pembayaran')->update($data, array('pembayaran_id' => $id));
        return $query;
    }
    public function deletePembayaran($id)
    {
        $query = $this->db->table('tb_pembayaran')->delete(array('pembayaran_id' => $id));
        return $query;
    }
    public function getDataDetailPembayaran($id)
    {
        $bulder = $this->db->table('tb_pembayaran')
            ->join('tb_pemesanan', 'pemesanan_faktur = pembayaran_faktur')
            ->join('tb_pelanggan', 'pemesanan_pelanggan = pelanggan_id')
            ->where(['pembayaran_faktur' => $id]);
        return $bulder->get();
    }
}
