<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\FavModel;
use App\Models\UserModel;

class Akun extends BaseController
{
    public function __construct()
    {
        $this->model =  new TransaksiModel();
        $this->fav =  new FavModel();
        $this->user =  new UserModel();
    }

    public function index()
    {
        $saldo = $this->model->tot(session()->akun);
        $data = [
            'saldo' => 'Rp' . number_format($saldo, 2, ',', '.'),
            'title' => 'Home'
        ];
        return view('user/index', $data);
    }

    public function setor()
    {
        $saldo = $this->model->tot(session()->akun);
        $data = [
            'saldo' => 'Rp' . number_format($saldo, 2, ',', '.'),
            'title' => 'Setor Tunai'
        ];
        return view('user/setor', $data);
    }

    public function tarik()
    {
        $saldo = $this->model->tot(session()->akun);
        $data = [
            'saldo' => 'Rp' . number_format($saldo, 2, ',', '.'),
            'title' => 'Tarik Tunai'
        ];
        return view('user/tarik', $data);
    }

    public function transfer()
    {
        $saldo = $this->model->tot(session()->akun);

        $f = $this->fav->getFav(session()->akun);
        $z = 0;
        $fav = [];
        for ($i = 0; $i < count($f); $i++) {
            $x = $this->user->getUser($f[$i]['akun_fav']);
            if ($x->active == '5') {
                $fav[$z]['akun_fav'] = $f[$i]['akun_fav'];
                $fav[$z]['nama'] = $f[$i]['nama'];
                $fav[$z]['email'] = $f[$i]['email'];
                $fav[$z]['akun'] = $f[$i]['akun'];
                $z++;
            }
        }

        $data = [
            'saldo' => 'Rp' . number_format($saldo, 2, ',', '.'),
            'fav' => $fav,
            'title' => 'Transfer'
        ];
        return view('user/transfer', $data);
    }

    public function fav()
    {
        $saldo = $this->model->tot(session()->akun);
        $data = [
            'saldo' => 'Rp' . number_format($saldo, 2, ',', '.'),
            'title' => 'Tambah Favorit'
        ];
        return view('user/fav', $data);
    }


    public function info()
    {
        $saldo = $this->model->tot(session()->akun);
        $data = [
            'saldo' => 'Rp' . number_format($saldo, 2, ',', '.'),
            'title' => 'Info Saldo'
        ];
        return view('user/info', $data);
    }

    public function mutasi()
    {
        $saldo = $this->model->tot(session()->akun);
        $data = [
            'saldo' => 'Rp' . number_format($saldo, 2, ',', '.'),
            'title' => 'Mutasi Rekening'
        ];
        return view('user/mutasi', $data);
    }
}
