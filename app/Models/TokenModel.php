<?php

namespace App\Models;

use CodeIgniter\Model;

class TokenModel extends Model
{
    protected $table = 'token';

    public function getToken($akun = false)
    {
        if ($akun == false) {
            return $this->where('akun', $akun)->orderBy('created_at', 'DESC')->findAll();
        } else {
            return $this->getWhere(['akun' => $akun])->getRow();
        }
    }

    public function saveToken($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editToken($data, $akun)
    {
        $builder = $this->db->table($this->table);
        $builder->where('akun', $akun);
        return $builder->update($data);
    }

    public function hapusToken($akun)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['akun' => $akun]);
    }

    public function login($x, $log)
    {
        return $this->where($x, $log)->get()->getRowArray();
    }
}
