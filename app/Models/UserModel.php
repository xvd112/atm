<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';

    public function getUser($akun = false)
    {
        if ($akun == false) {
            return $this->where('akun', $akun)->orderBy('created_at', 'DESC')->findAll();
        } else {
            return $this->getWhere(['akun' => $akun])->getRow();
        }
    }

    public function saveUser($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editUser($data, $akun)
    {
        $builder = $this->db->table($this->table);
        $builder->where('akun', $akun);
        return $builder->update($data);
    }

    public function hapusUser($akun)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['akun' => $akun]);
    }

    public function login($x, $log)
    {
        return $this->where($x, $log)->get()->getRowArray();
    }
}
