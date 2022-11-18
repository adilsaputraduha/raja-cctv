<?php

namespace App\Controllers;

use App\Models\PelangganModel;

class PelangganController extends BaseController
{
    public function index()
    {
        $model = new PelangganModel();
        $data = [
            'pelanggan' => $model->getPelanggan()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];
        echo view('view_pelanggan', $data);
    }

    public function save()
    {
        $rules = [
            'nama' => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'Nama harus diisi',
                    'max_length' => 'Kolom nama tidak boleh lebih dari 255 karakter'
                ]
            ],
            'nohp' => [
                'rules' => 'required|max_length[15]|min_length[8]',
                'errors' => [
                    'required' => 'Nohp harus diisi',
                    'max_length' => 'Kolom nohp tidak boleh lebih dari 15 karakter',
                    'min_length' => 'Kolom nohp setidaknya terdiri dari 8 karakter'
                ]
            ],
            'alamat' => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'Alamat harus diisi',
                    'max_length' => 'Kolom alamat tidak boleh lebih dari 255 karakter',
                ]
            ],
            'email' => [
                'rules' => 'required|max_length[100]|is_unique[tb_pelanggan.pelanggan_email]',
                'errors' => [
                    'is_unique' => 'Email sudah ada',
                    'required' => 'Email harus diisi',
                    'max_length' => 'Kolom email tidak boleh lebih dari 100 karakter'
                ]
            ],
        ];

        if ($this->validate($rules)) {
            $model = new PelangganModel();
            $data = array(
                'pelanggan_nama' => $this->request->getPost('nama'),
                'pelanggan_email' => $this->request->getPost('email'),
                'pelanggan_alamat' => $this->request->getPost('alamat'),
                'pelanggan_nohp' => $this->request->getPost('nohp'),
                'pelanggan_password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            );
            $model->savePelanggan($data);
            session()->setFlashdata('success', 'Berhasil menyimpan data');
            return redirect()->to('pelanggan');
        } else {
            session()->setFlashdata('failed', 'Gagal menyimpan data' . $this->validator->listErrors());
            return redirect()->to('pelanggan');
        }
    }

    public function edit()
    {
        $rules = [
            'nama' => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'Nama harus diisi',
                    'max_length' => 'Kolom nama tidak boleh lebih dari 255 karakter'
                ]
            ],
            'nohp' => [
                'rules' => 'required|max_length[15]|min_length[8]',
                'errors' => [
                    'required' => 'Nohp harus diisi',
                    'max_length' => 'Kolom nohp tidak boleh lebih dari 15 karakter',
                    'min_length' => 'Kolom nohp setidaknya terdiri dari 8 karakter'
                ]
            ],
            'alamat' => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'Alamat harus diisi',
                    'max_length' => 'Kolom alamat tidak boleh lebih dari 255 karakter',
                ]
            ],
        ];

        $id = $this->request->getPost('id');

        if ($this->validate($rules)) {
            $model = new PelangganModel();
            $data = array(
                'pelanggan_nama' => $this->request->getPost('nama'),
                'pelanggan_alamat' => $this->request->getPost('alamat'),
                'pelanggan_nohp' => $this->request->getPost('nohp'),
            );
            $model->updatePelanggan($data, $id);
            session()->setFlashdata('success', 'Berhasil mengedit data');
            return redirect()->to('pelanggan');
        } else {
            session()->setFlashdata('failed', 'Gagal mengedit data' . $this->validator->listErrors());
            return redirect()->to('pelanggan');
        }
    }

    public function delete()
    {
        $model = new PelangganModel();
        $id = $this->request->getPost('id');
        $model->deletePelanggan($id);
        session()->setFlashdata('success', 'Berhasil menghapus data');
        return redirect()->to('pelanggan');
    }

    public function reset()
    {
        $id = $this->request->getPost('id');

        $model = new PelangganModel();
        $data = array(
            'pelanggan_password' => password_hash('1234', PASSWORD_DEFAULT),
        );
        $model->updatePelanggan($data, $id);
        session()->setFlashdata('success', 'Berhasil reset data');
        return redirect()->to('pelanggan');
    }

    public function report()
    {
        $model = new PelangganModel();
        $data['pelanggan'] = $model->getPelanggan()->getResultArray();
        echo view('report/report_pelanggan', $data);
    }
}
