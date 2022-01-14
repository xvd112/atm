<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';

    public function getTransaksi($akun = false)
    {
        if ($akun == false) {
            return $this->orderBy('tgl', 'DESC')->findAll();
        } else {
            return $this->where('akun', $akun)->orderBy('tgl', 'DESC')->findAll();
        }
    }

    public function data($akun = false, $jenis)
    {
        if ($akun == false) {
            return $this->like('transaksi', $jenis)->orderBy('tgl', 'DESC')->findAll();
        } else {
            return $this->where('akun', $akun)->like('transaksi', $jenis)->orderBy('tgl', 'DESC')->findAll();
        }
    }

    public function mutasi($akun, $awal = false, $akhir = false)
    {
        if ($awal == false and $akhir == false) {
            return $this->where('akun', $akun)
                ->orderBy('tgl', 'DESC')
                ->get()->getResultArray();
        } else {
            return $this->where('akun', $akun)
                ->where('tgl>=', $awal)
                ->where('tgl<=', $akhir)
                ->orderBy('tgl', 'DESC')
                ->get()->getResultArray();
        }
    }

    public function mutasi_pag($akun, $awal = false, $akhir = false)
    {
        if ($awal == false and $akhir == false) {
            return $this->where('akun', $akun)
                ->orderBy('tgl', 'DESC')
                ->paginate(10, 'data');
        } else {
            return $this->where('akun', $akun)
                ->where('tgl>=', $awal)
                ->where('tgl<=', $akhir)
                ->orderBy('tgl', 'DESC')
                ->paginate(10, 'data');
        }
    }

    public function tot($akun)
    {
        $a = $this->selectSum('jml')->where('akun', $akun)->where('tipe', 'D')->get()->getRow();
        $b = $this->selectSum('jml')->where('akun', $akun)->where('tipe', 'K')->get()->getRow();
        $c = doubleval($a->jml) - doubleval($b->jml);
        return $c;
    }

    public function saveTransaksi($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editTransaksi($data, $transaksi)
    {
        $builder = $this->db->table($this->table);
        $builder->where('transaksi', $transaksi);
        return $builder->update($data);
    }

    public function hapusTransaksi($transaksi)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['transaksi' => $transaksi]);
    }

    public function cari($x, $log)
    {
        return $this->where($x, $log)->get()->getRowArray();
    }
}
