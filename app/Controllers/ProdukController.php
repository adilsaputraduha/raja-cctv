<?php

namespace App\Controllers;

use App\Models\JenisModel;
use App\Models\ProdukModel;

class ProdukController extends BaseController
{
    public function index()
    {
        $model = new ProdukModel();
        $modelsatu = new JenisModel();
        $data = [
            'jenis' => $modelsatu->getJenis()->getResultArray(),
            'produk' => $model->getProduk()->getResultArray(),
            'validation' => \Config\Services::validation(),
        ];
        echo view('view_produk', $data);
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
            'harga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harga harus diisi',
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi harus diisi',
                ]
            ],
        ];

        if ($this->validate($rules)) {
            $model = new ProdukModel();

            $fileGambar = $this->request->getFile('gambar');

            if ($fileGambar->getError() == 4) {
                $fileName = 'default.png';
            } else {
                $fileName = $fileGambar->getRandomName();
                // Upload image
                $fileGambar->move('fotoproduk/', $fileName);
            };

            $data = array(
                'produk_nama' => $this->request->getPost('nama'),
                'produk_harga' => $this->request->getPost('harga'),
                'produk_jenis' => $this->request->getPost('jenis'),
                'produk_deskripsi' => $this->request->getPost('deskripsi'),
                'produk_gambar' => $fileName,
            );

            $model->saveProduk($data);
            session()->setFlashdata('success', 'Berhasil menyimpan data');
            return redirect()->to('produk');
        } else {
            session()->setFlashdata('failed', 'Gagal menyimpan data' . $this->validator->listErrors());
            return redirect()->to('produk');
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
            $model = new ProdukModel();

            $fileGambar = $this->request->getFile('gambar');

            if ($fileGambar->getError() == 4) {
                $fileName = $this->request->getPost('filelama');
            } else {
                $fileName = $fileGambar->getRandomName();
                // Upload image
                $fileGambar->move('fotoproduk/', $fileName);
            };

            $data = array(
                'produk_nama' => $this->request->getPost('nama'),
                'produk_harga' => $this->request->getPost('harga'),
                'produk_jenis' => $this->request->getPost('jenis'),
                'produk_deskripsi' => $this->request->getPost('deskripsi'),
                'produk_gambar' => $fileName,
            );

            $model->updateProduk($data, $id);
            session()->setFlashdata('success', 'Berhasil mengedit data');
            return redirect()->to('produk');
        } else {
            session()->setFlashdata('failed', 'Gagal mengedit data' . $this->validator->listErrors());
            return redirect()->to('produk');
        }
    }

    public function delete()
    {
        $model = new ProdukModel();
        $id = $this->request->getPost('id');
        $model->deleteProduk($id);
        session()->setFlashdata('success', 'Berhasil menghapus data');
        return redirect()->to('produk');
    }

    public function report()
    {
        $model = new ProdukModel();
        $data['produk'] = $model->getProduk()->getResultArray();
        echo view('report/report_produk', $data);
    }
}
