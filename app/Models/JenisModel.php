<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisModel extends Model
{
    public function getJenis()
    {
        $bulder = $this->db->table('tb_jenis');
        return $bulder->get();
    }
    public function saveJenis($data)
    {
        $query = $this->db->table('tb_jenis')->insert($data);
        return $query;
    }
    public function updateJenis($data, $id)
    {
        $query = $this->db->table('tb_jenis')->update($data, array('jenis_id' => $id));
        return $query;
    }
    public function deleteJenis($id)
    {
        $query = $this->db->table('tb_jenis')->delete(array('jenis_id' => $id));
        return $query;
    }
}
