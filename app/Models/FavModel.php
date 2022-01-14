<?php

namespace App\Models;

use CodeIgniter\Model;

class FavModel extends Model
{
    protected $table = 'favorit';

    public function getFav($akun = false)
    {
        return $this->where('akun', $akun)->get()->getResultArray();
    }

    public function saveFav($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editFav($data, $akun)
    {
        $builder = $this->db->table($this->table);
        $builder->where('akun', $akun);
        return $builder->update($data);
    }

    public function hapusFav($akun)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['akun' => $akun]);
    }

    public function login($x, $log)
    {
        return $this->where($x, $log)->get()->getRowArray();
    }
}
