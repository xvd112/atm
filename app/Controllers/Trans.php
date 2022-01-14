<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\FavModel;
use App\Models\UserModel;
use DateTime;

class Trans extends BaseController
{
    public function __construct()
    {
        $this->model =  new TransaksiModel();
        $this->fav =  new FavModel();
        $this->user =  new UserModel();
    }

    public function debit()
    {
        $request = \Config\Services::request();
        $jml = str_replace(".", "", substr($request->getPost('setor'), 2));
        $set = str_replace(",", ".", $jml);

        $x = $this->model->data(false, 'STR');
        if ($x == NULL) {
            $t = 'STR0001';
        } else {
            $t = 'STR' . sprintf('%04d', (substr($x[0]['transaksi'], -4) + 1));
        }

        $saldo = $this->model->tot(session()->akun);
        $mut = $saldo + $set;

        $data = array(
            'jml' => $set,
            'akun' => session()->akun,
            'transaksi' => $t,
            'mutasi' => $mut,
            'ket' => 'Setor tunai',
            'tipe' => 'D',
        );
        $this->model->saveTransaksi($data);
        session()->setFlashdata('pesan', 'Setoran berhasil');
        return redirect()->to(base_url() . '/akun');
    }

    public function fav()
    {
        $request = \Config\Services::request();
        $akun = $request->getPost('akun');
        $x = $this->user->getUser($akun);

        if ($x != NULL and $akun != session()->akun and $x->active == '5') {
            $data = array(
                'akun' => session()->akun,
                'akun_fav' => $akun,
                'nama' => $request->getPost('nama'),
                'email' => $request->getPost('email')
            );
            $this->fav->saveFav($data);
            session()->setFlashdata('pesan', 'Favorit berhasil ditambahkan');
            return redirect()->to(base_url() . '/akun/transfer');
        } else {
            session()->setFlashdata('warning', 'Akun tidak ada');
            return redirect()->to(base_url() . '/akun/fav');
        }
    }

    public function kredit()
    {
        $request = \Config\Services::request();
        $jml = str_replace(".", "", substr($request->getPost('tarik'), 2));
        $set = str_replace(",", ".", $jml);

        $saldo = $this->model->tot(session()->akun);

        if ($saldo != 0 and $saldo >= $set) {
            $x = $this->model->data(false, 'TRT');
            if ($x == NULL) {
                $t = 'TRT0001';
            } else {
                $t = 'TRT' . sprintf('%04d', (substr($x[0]['transaksi'], -4) + 1));
            }

            $mut = $saldo - $set;

            $data = array(
                'jml' => $set,
                'akun' => session()->akun,
                'transaksi' => $t,
                'mutasi' => $mut,
                'ket' => 'Tarik tunai',
                'tipe' => 'K'
            );
            $this->model->saveTransaksi($data);
            session()->setFlashdata('pesan', 'Penarikan berhasil');
            return redirect()->to(base_url() . '/akun');
        } else {
            session()->setFlashdata('warning', 'Penarikan gagal, saldo tidak cukup');
            return redirect()->to(base_url() . '/akun/tarik');
        }
    }

    public function transfer()
    {
        $request = \Config\Services::request();
        $jml = str_replace(".", "", substr($request->getPost('transfer'), 2));
        $set = str_replace(",", ".", $jml);

        $saldo = $this->model->tot(session()->akun);

        if ($saldo != 0 and $saldo >= $set) {
            $x = $this->model->data(false, 'TFK');
            if ($x == NULL) {
                $t = 'TFK0001';
            } else {
                $t = 'TFK' . sprintf('%04d', (substr($x[0]['transaksi'], -4) + 1));
            }

            $mut = $saldo - $set;

            $data = array(
                'jml' => $set,
                'akun' => session()->akun,
                'transaksi' => $t,
                'for' => $request->getPost('ket'),
                'ket' => 'Transfer ke ' . $request->getPost('akun'),
                'mutasi' => $mut,
                'tipe' => 'K'
            );
            $this->model->saveTransaksi($data);

            $x = $this->model->data(false, 'TFM');
            if ($x == NULL) {
                $tf = 'TFM0001';
            } else {
                $tf = 'TFM' . sprintf('%04d', (substr($x[0]['transaksi'], -4) + 1));
            }

            $saldo2 = $this->model->tot($request->getPost('akun'));
            $mut2 = $saldo2 + $set;


            $data_tf = array(
                'jml' => $set,
                'akun' => $request->getPost('akun'),
                'transaksi' => $tf,
                'for' => $request->getPost('ket'),
                'ket' => 'Transfer dari ' . session()->akun,
                'mutasi' => $mut2,
                'tipe' => 'D'
            );
            $this->model->saveTransaksi($data_tf);

            session()->setFlashdata('pesan', 'Transfer berhasil');
            return redirect()->to(base_url() . '/akun');
        } else {
            session()->setFlashdata('warning', 'Transfer gagal, saldo tidak cukup');
            return redirect()->to(base_url() . '/akun/transfer');
        }
    }

    public function mutasi($jenis = false)
    {
        $request = \Config\Services::request();
        date_default_timezone_set("Asia/Kolkata");
        if ($jenis != false) {
            $tn = strtotime(date('Y-m-d'));
            if ($jenis == 'n') {
                $awal = date('Y-m-d');
                $akhir =  date('Y-m-d', strtotime('+1 days', $tn));
            } elseif ($jenis == 'm') {
                $awal =  date('Y-m-d', strtotime('-7 days', $tn));
                $akhir =  date('Y-m-d', strtotime('+1 days', $tn));
            } elseif ($jenis == 'b') {
                $awal =  date('Y-m-d', strtotime('-1 month', $tn));
                $akhir =  date('Y-m-d', strtotime('+1 days', $tn));
            }
        } else {
            $awal = $request->getPost('awal');
            $akhir = date('Y-m-d', strtotime('+1 days', strtotime($request->getPost('akhir'))));
        }
        $a = $this->model->mutasi(session()->akun, $awal, $akhir);
        if ($a != NULL) {
            $saldo = $this->model->tot(session()->akun);

            $currentPage = $request->getVar('page_data') ? $request->getVar('page_data') : 1;

            $data = [
                'saldo' => 'Rp' . number_format($saldo, 2, ',', '.'),
                's' => $saldo,
                'b' => $this->model->mutasi_pag(session()->akun, $awal, $akhir),
                'pager' => $this->model->pager,
                'currentPage' => $currentPage,
                'title' => 'Mutasi Rekening'
            ];
            return view('user/isi', $data);
        } else {
            session()->setFlashdata('warning', 'Transaksi tidak ditemukan');
            return redirect()->to(base_url() . '/akun/mutasi');
        }
    }
}
