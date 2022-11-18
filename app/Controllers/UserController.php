<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data = [
            'user' => $model->getUser()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];
        echo view('view_user', $data);
    }

    public function save()
    {
        $rules = [
            'email' => [
                'rules' => 'required|max_length[100]|is_unique[tb_user.user_email]',
                'errors' => [
                    'is_unique' => 'Email sudah ada',
                    'required' => 'Email harus diisi',
                    'max_length' => 'Kolom email tidak boleh lebih dari 100 karakter'
                ]
            ],
            'nama' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Nama harus diisi',
                    'max_length' => 'Kolom nama tidak boleh lebih dari 100 karakter'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[4]|max_length[100]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'max_length' => 'Kolom password tidak boleh lebih dari 100 karakter',
                    'min_length' => 'Kolom password setidaknya terdiri dari 4 karakter'
                ]
            ],
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Level harus diisi'
                ]
            ]
        ];

        if ($this->validate($rules)) {
            $model = new UserModel();
            $data = array(
                'user_email' => $this->request->getPost('email'),
                'user_nama' => $this->request->getPost('nama'),
                'user_password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'user_level' => $this->request->getPost('level')
            );
            $model->saveUser($data);
            session()->setFlashdata('success', 'Berhasil menyimpan data');
            return redirect()->to('user');
        } else {
            session()->setFlashdata('failed', 'Gagal menyimpan data' . $this->validator->listErrors());
            return redirect()->to('user');
        }
    }

    public function edit()
    {
        $rules = [
            'nama' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Nama harus diisi',
                    'max_length' => 'Kolom nama tidak boleh lebih dari 100 karakter'
                ]
            ],
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Level harus diisi'
                ]
            ]
        ];

        $id = $this->request->getPost('id');

        if ($this->validate($rules)) {
            $model = new UserModel();
            $data = array(
                'user_nama' => $this->request->getPost('nama'),
                'user_level' => $this->request->getPost('level')
            );
            $model->updateUser($data, $id);
            session()->setFlashdata('success', 'Berhasil menyimpan data');
            return redirect()->to('user');
        } else {
            session()->setFlashdata('failed', 'Gagal mengedit data' . $this->validator->listErrors());
            return redirect()->to('user');
        }
    }

    public function delete()
    {
        $model = new UserModel();
        $id = $this->request->getPost('id');
        $model->deleteUser($id);
        session()->setFlashdata('success', 'Berhasil menghapus data');
        return redirect()->to('user');
    }

    public function report()
    {
        $model = new UserModel();
        $data['user'] = $model->getUser()->getResultArray();
        echo view('report/report_user', $data);
    }
}
