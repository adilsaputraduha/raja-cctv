<?php

namespace App\Controllers;

use App\Models\JenisModel;

class JenisController extends BaseController
{
    public function index()
    {
        $model = new JenisModel();
        $data = [
            'jenis' => $model->getJenis()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];
        echo view('view_jenis', $data);
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
        ];

        if ($this->validate($rules)) {
            $model = new JenisModel();
            $data = array(
                'jenis_nama' => $this->request->getPost('nama'),
            );
            $model->saveJenis($data);
            session()->setFlashdata('success', 'Berhasil menyimpan data');
            return redirect()->to('jenis');
        } else {
            session()->setFlashdata('failed', 'Gagal menyimpan data' . $this->validator->listErrors());
            return redirect()->to('jenis');
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
        ];

        $id = $this->request->getPost('id');

        if ($this->validate($rules)) {
            $model = new JenisModel();
            $data = array(
                'jenis_nama' => $this->request->getPost('nama'),
            );
            $model->updateJenis($data, $id);
            session()->setFlashdata('success', 'Berhasil mengedit data');
            return redirect()->to('jenis');
        } else {
            session()->setFlashdata('failed', 'Gagal mengedit data' . $this->validator->listErrors());
            return redirect()->to('jenis');
        }
    }

    public function delete()
    {
        $model = new JenisModel();
        $id = $this->request->getPost('id');
        $model->deleteJenis($id);
        session()->setFlashdata('success', 'Berhasil menghapus data');
        return redirect()->to('jenis');
    }

    public function report()
    {
        $model = new JenisModel();
        $data['jenis'] = $model->getJenis()->getResultArray();
        echo view('report/report_jenis', $data);
    }
}
