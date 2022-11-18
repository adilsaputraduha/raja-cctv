<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    public function getProduk()
    {
        $bulder = $this->db->table('tb_produk')
            ->join('tb_jenis', 'produk_jenis = jenis_id');
        return $bulder->get();
    }
    public function saveProduk($data)
    {
        $query = $this->db->table('tb_produk')->insert($data);
        return $query;
    }
    public function updateProduk($data, $id)
    {
        $query = $this->db->table('tb_produk')->update($data, array('produk_id' => $id));
        return $query;
    }
    public function deleteProduk($id)
    {
        $query = $this->db->table('tb_produk')->delete(array('produk_id' => $id));
        return $query;
    }
}
