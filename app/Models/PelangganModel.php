<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    public function getPelanggan()
    {
        $bulder = $this->db->table('tb_pelanggan');
        return $bulder->get();
    }
    public function savePelanggan($data)
    {
        $query = $this->db->table('tb_pelanggan')->insert($data);
        return $query;
    }
    public function updatePelanggan($data, $id)
    {
        $query = $this->db->table('tb_pelanggan')->update($data, array('pelanggan_id' => $id));
        return $query;
    }
    public function deletePelanggan($id)
    {
        $query = $this->db->table('tb_pelanggan')->delete(array('pelanggan_id' => $id));
        return $query;
    }
}
