<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TokenModel;
use Exception;

class Home extends BaseController
{
    public function __construct()
    {
        helper('form');
        helper('text');
        helper('url');
        $this->model =  new UserModel();
        $this->token =  new TokenModel();
        $this->email = \Config\Services::email();
    }

    public function index()
    {
        $data['title'] = 'Login';
        return view('akun/login', $data);
    }

    public function signup()
    {
        $data['title'] = 'Signup';
        return view('akun/signup', $data);
    }

    public function add()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();

        $validation->setRules([
            'uname' => [
                'label' => 'uname',
                'rules' => 'is_unique[users.uname]',
                'errors' => [
                    'is_unique' => 'Username sudah terdaftar',
                ]
            ],
            'email' => [
                'label' => 'email',
                'rules' => 'is_unique[users.email]',
                'errors' => [
                    'is_unique' => 'Email sudah terdaftar',
                ]
            ]
        ]);
        if (!$validation->withRequest($request)->run()) {
            session()->setFlashdata('warning', $validation->listErrors());
            return redirect()->to(base_url() . '/#signup');
        }

        $x = $this->model->getUser();
        if ($x == NULL) {
            $akun = 'ACC0001';
        } else {
            $akun = 'ACC' . sprintf('%04d', (substr($x[0]['akun'], -4) + 1));
        }

        $email = $request->getPost('email');
        $data = array(
            'akun' => $akun,
            'uname' => $request->getPost('uname'),
            'fname' => $request->getPost('fname'),
            'lname' => $request->getPost('lname'),
            'email' => $email,
            'pass' => password_hash($request->getPost('pass'), PASSWORD_BCRYPT),
        );
        $this->model->saveUser($data);

        $data_token = array(
            'akun' => $akun,
            'token' => random_string('md5', 16)
        );
        $this->token->saveToken($data_token);
        return redirect()->to(base_url() . '/home/sendEmail/' . $email);
    }

    public function sendEmail($email)
    {
        try {
            $i = $this->model->login('email', $email);
            $token = $this->token->getToken($i['akun']);
            $to = $email;
            $subject = 'Email Verification';
            $t = $token->token;
            $message = 'Hi ' . $i['fname'] . ' ' . $i['lname'] . '<br><br>'
                . 'Please click the link below to activated your account. <br><br>'
                . '<a href="' . base_url() . '/home/active/' . $t . '">Activated Account</a>';

            $this->email->setFrom('tes.login.pn@gmail.com');
            $this->email->setTo($to);
            $this->email->setSubject($subject);
            $this->email->setMessage($message);

            // dd($message);
            if ($this->email->send()) {
                session()->setFlashdata('pesan', 'Please verify your email');
                return redirect()->to(base_url() . '/');
            } else {
                echo $this->email->printDebugger();
                return false;
                // session()->setFlashdata('warning', 'Email cannot send');
                // return redirect()->to(base_url() . '/');
            }
        } catch (Exception $e) {
            session()->setFlashdata('danger', 'Something went wrong');
            return redirect()->to(base_url() . '/');
        }
    }

    public function active($token)
    {
        $x = $this->token->login('token', $token);
        $data = array(
            'active' => 5,
            'updated_at' => date('Y-m-d h:i:s')
        );
        $this->model->editUser($data, $x['akun']);
        $data_token = array(
            'token' => random_string('md5', 16)
        );
        $this->token->editToken($data_token, $x['akun']);
        return redirect()->to(base_url() . '/');
    }

    public function login()
    {
        $request = \Config\Services::request();
        $log = $request->getPost('log');
        $pass = $request->getPost('pass');

        $cek_email = $this->model->login('email', $log);
        $cek_uname = $this->model->login('uname', $log);
        $cek_akun = $this->model->login('akun', $log);

        if ($cek_email != NULL and password_verify($pass, $cek_email['pass']) and $cek_email['active'] == 5) {
            session()->set('log', true);
            session()->set('uname', $cek_email['uname']);
            session()->set('fname', $cek_email['fname']);
            session()->set('lname', $cek_email['lname']);
            session()->set('akun', $cek_email['akun']);
            session()->set('email', $cek_email['email']);
            return redirect()->to(base_url() . '/akun');
        } elseif ($cek_uname != NULL and password_verify($pass, $cek_uname['pass']) and $cek_uname['active'] == 5) {
            session()->set('log', true);
            session()->set('uname', $cek_uname['uname']);
            session()->set('fname', $cek_uname['fname']);
            session()->set('lname', $cek_uname['lname']);
            session()->set('akun', $cek_uname['akun']);
            session()->set('email', $cek_uname['email']);
            return redirect()->to(base_url() . '/akun');
        } elseif ($cek_akun != NULL and password_verify($pass, $cek_akun['pass']) and $cek_akun['active'] == 5) {
            session()->set('log', true);
            session()->set('uname', $cek_akun['uname']);
            session()->set('fname', $cek_akun['fname']);
            session()->set('lname', $cek_akun['lname']);
            session()->set('akun', $cek_akun['akun']);
            session()->set('email', $cek_akun['email']);
            return redirect()->to(base_url() . '/akun');
        } elseif ($cek_uname != NULL and $cek_uname['active'] != 5) {
            session()->setFlashdata('warning', 'Account not active yet.');
            return redirect()->to(base_url() . '/');
        } elseif ($cek_email != NULL and $cek_email['active'] != 5) {
            session()->setFlashdata('warning', 'Account not active yet.');
            return redirect()->to(base_url() . '/');
        } elseif ($cek_akun != NULL and $cek_akun['active'] != 5) {
            session()->setFlashdata('warning', 'Account not active yet.');
            return redirect()->to(base_url() . '/');
        } else {
            session()->setFlashdata('danger', 'Username / Email / Akun not found');
            return redirect()->to(base_url() . '/');
        }
    }

    public function logout()
    {
        session()->remove('uname');
        session()->remove('fname');
        session()->remove('lname');
        session()->remove('akun');
        session()->remove('email');
        session()->remove('log');
        session()->setFlashdata('pesan', 'Logout success');
        return redirect()->to(base_url() . '/');
    }
}
