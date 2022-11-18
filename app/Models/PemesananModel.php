<?php

namespace App\Models;

use CodeIgniter\Model;

class PemesananModel extends Model
{
    public function getPemesanan()
    {
        $bulder = $this->db->table('tb_pemesanan')
            ->join('tb_pelanggan', 'pemesanan_pelanggan = pelanggan_id');
        return $bulder->get();
    }

    public function getPemesananByUser($id)
    {
        $bulder = $this->db->table('tb_pemesanan')
            ->join('tb_pelanggan', 'pemesanan_pelanggan = pelanggan_id')
            ->where(['pemesanan_pelanggan' => $id]);
        return $bulder->get();
    }

    public function getDataDetail($id)
    {
        $bulder = $this->db->table('tb_detail_pemesanan')
            ->join('tb_produk', 'detail_pemesanan_produk = produk_id')
            ->join('tb_jenis', 'produk_jenis = jenis_id')
            ->where(['detail_pemesanan_faktur' => $id]);
        return $bulder->get();
    }

    public function saveDetail($data)
    {
        $query = $this->db->table('tb_detail_pemesanan')->insert($data);
        return $query;
    }

    public function deleteDetail($id)
    {
        $query = $this->db->table('tb_detail_pemesanan')->delete(array('detail_pemesanan_id' => $id));
        return $query;
    }

    public function savePemesanan($data)
    {
        $query = $this->db->table('tb_pemesanan')->insert($data);
        return $query;
    }

    public function updatePemesanan($data, $id)
    {
        $query = $this->db->table('tb_pemesanan')->update($data, array('pemesanan_faktur' => $id));
        return $query;
    }

    public function getDataDetailPemesanan($id)
    {
        $bulder = $this->db->table('tb_pemesanan')
            ->join('tb_pelanggan', 'pemesanan_pelanggan = pelanggan_id')
            ->where(['pemesanan_faktur' => $id]);
        return $bulder->get();
    }

    public function getDataDetailPemesananByPelanggan($id)
    {
        $bulder = $this->db->table('tb_pemesanan')
            ->join('tb_pelanggan', 'pemesanan_pelanggan = pelanggan_id')
            ->where(['pemesanan_pelanggan' => $id]);
        return $bulder->get();
    }

    public function getPemesananByStatus()
    {
        $bulder = $this->db->table('tb_pemesanan')
            ->join('tb_pelanggan', 'pemesanan_pelanggan = pelanggan_id')
            ->where(['pemesanan_status' => 0]);
        return $bulder->get();
    }

    public function getPemesananByStatusAndPelanggan($id)
    {
        $bulder = $this->db->table('tb_pemesanan')
            ->join('tb_pelanggan', 'pemesanan_pelanggan = pelanggan_id')
            ->where(['pemesanan_status' => 0])
            ->where(['pemesanan_pelanggan' => $id]);
        return $bulder->get();
    }
}
