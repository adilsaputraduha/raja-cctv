<?php

namespace App\Controllers;

use App\Models\LoginModel;

class LoginController extends BaseController
{
    public function index()
    {
        if (session()->get('userId')) {
            return redirect()->to(base_url('/'));
        }
        echo view('view_login');
    }

    public function register()
    {
        echo view('view_register');
    }

    public function saveregister()
    {
        $model = new LoginModel();

        $data = array(
            'pelanggan_email' => $this->request->getPost('email'),
            'pelanggan_nama' => $this->request->getPost('nama'),
            'pelanggan_password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'pelanggan_nohp' => $this->request->getPost('nohp'),
            'pelanggan_alamat' => $this->request->getPost('alamat'),
        );

        $model->registerSave($data);
        session()->setFlashdata('success', 'Berhasil daftar data');
        return redirect()->to('login');
    }

    public function ceklogin()
    {
        $model = new LoginModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->cekLogin($email);

        if ($user) {
            if (password_verify($password, $user['user_password'])) {
                session()->set('userId', $user['user_id']);
                session()->set('userNama', $user['user_nama']);
                session()->set('userEmail', $user['user_email']);
                session()->set('userLevel', $user['user_level']);
                return redirect()->to('/');
            } else {
                session()->setFlashdata('message', 'Password salah');
                return redirect()->to('login');
            }
        } else {
            $pelanggan = $model->cekLoginPelanggan($email);

            if ($pelanggan) {
                if (password_verify($password, $pelanggan['pelanggan_password'])) {
                    session()->set('userId', $pelanggan['pelanggan_id']);
                    session()->set('userNama', $pelanggan['pelanggan_nama']);
                    session()->set('userEmail', $pelanggan['pelanggan_email']);
                    session()->set('userLevel', 3);
                    return redirect()->to('/');
                } else {
                    session()->setFlashdata('message', 'Password salah');
                    return redirect()->to('login');
                }
            } else {
                session()->setFlashdata('message', 'Email tidak ditemukan');
                return redirect()->to('login');
            }
        }
    }

    public function logout()
    {
        session()->remove('userId');
        session()->remove('userNama');
        session()->remove('userEmail');
        session()->remove('userLevel');
        session()->setFlashdata('success', 'Berhasil keluar');
        return redirect()->to('login');
    }
}
