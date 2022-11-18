<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    public function cekLogin($email)
    {
        return $this->db->table('tb_user')
            ->where(array('user_email' => $email))
            ->get()->getRowArray();
    }

    public function cekLoginPelanggan($email)
    {
        return $this->db->table('tb_pelanggan')
            ->where(array('pelanggan_email' => $email))
            ->get()->getRowArray();
    }

    public function registerSave($data)
    {
        $query = $this->db->table('tb_pelanggan')->insert($data);
        return $query;
    }
}
