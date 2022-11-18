<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\PelangganModel;
use App\Models\PembayaranModel;
use App\Models\PemesananModel;

class PembayaranController extends BaseController
{
    public function index()
    {
        $model = new PembayaranModel();
        $userlogin = session()->get('userLevel');
        $iduser = session()->get('userId');

        if ($userlogin == 3) {
            $data = [
                'pembayaran' => $model->getPembayaranByUser($iduser)->getResultArray(),
            ];
            echo view('view_pembayaran', $data);
        } else {
            $data = [
                'pembayaran' => $model->getPembayaran()->getResultArray(),
            ];
            echo view('view_pembayaran', $data);
        }
    }

    public function add()
    {
        $userlogin = session()->get('userLevel');
        $iduser = session()->get('userId');

        if ($userlogin == 3) {
            $model = new PemesananModel();
            $data = [
                'detailpemesanan' => $model->getDataDetail(1)->getResultArray(),
                'pemesanan' => $model->getPemesananByStatusAndPelanggan($iduser)->getResultArray(),
                'validation' => \Config\Services::validation(),
            ];
            echo view('view_pembayaran_tambah', $data);
        } else {
            $model = new PemesananModel();
            $data = [
                'detailpemesanan' => $model->getDataDetail(1)->getResultArray(),
                'pemesanan' => $model->getPemesananByStatus()->getResultArray(),
                'validation' => \Config\Services::validation(),
            ];
            echo view('view_pembayaran_tambah', $data);
        }
    }

    public function update($id)
    {
        $model = new PemesananModel();
        $modelsatu = new PembayaranModel();
        $data = [
            'pembayaran' => $modelsatu->getDataDetailPembayaran($id)->getResultArray(),
            'detailpemesanan' => $model->getDataDetail($id)->getResultArray(),
            'validation' => \Config\Services::validation(),
            'nomor' => $id
        ];
        echo view('view_pembayaran_update', $data);
    }

    public function detailindex()
    {
        $id = $this->request->getPost('fakturpemesanan');

        $model = new PemesananModel();
        $data = [
            'detailpemesanan' => $model->getDataDetail($id)->getResultArray(),
        ];
        echo view('table_pembayaran', $data);
    }

    public function save()
    {
        $model = new PembayaranModel();

        $fileGambar = $this->request->getFile('buktipembayaran');

        if ($fileGambar->getError() == 4) {
            $fileName = 'default.png';
        } else {
            $fileName = $fileGambar->getRandomName();
            // Upload image
            $fileGambar->move('buktipembayaran/', $fileName);
        };

        $data = array(
            'pembayaran_faktur' => $this->request->getPost('fakturpemesanan'),
            'pembayaran_tanggal' => $this->request->getPost('tanggalpembayaran'),
            'pembayaran_bukti' => $fileName
        );
        $model->savePembayaran($data);

        $modelSatu = new PemesananModel();
        $id = $this->request->getPost('fakturpemesanan');

        $datasatu = array(
            'pemesanan_status' => 1,
        );
        $modelSatu->updatePemesanan($datasatu, $id);

        session()->setFlashdata('success', 'Berhasil menyimpan data');
        return redirect()->to('pembayaran');
    }

    public function edit()
    {
        $id = $this->request->getPost('idpembayaran');

        $model = new PembayaranModel();

        $fileGambar = $this->request->getFile('buktipembayaran');

        if ($fileGambar->getError() == 4) {
            $fileName = 'default.png';
        } else {
            $fileName = $fileGambar->getRandomName();
            // Upload image
            $fileGambar->move('buktipembayaran/', $fileName);
        };

        $data = array(
            'pembayaran_faktur' => $this->request->getPost('fakturpemesanan'),
            'pembayaran_tanggal' => $this->request->getPost('tanggalpembayaran'),
            'pembayaran_bukti' => $fileName
        );
        $model->updatePembayaran($data, $id);
        session()->setFlashdata('success', 'Berhasil mengedit data');
        return redirect()->to('pembayaran');
    }

    public function status()
    {
        $id = $this->request->getPost('id');

        $model = new PemesananModel();
        $data = array(
            'pemesanan_status' => $this->request->getPost('status'),
        );
        $model->updatePemesanan($data, $id);
        session()->setFlashdata('success', 'Berhasil ubah status');
        return redirect()->to('pemesanan');
    }

    public function batal()
    {
        $model = new PembayaranModel();
        $id = $this->request->getPost('id');
        $model->deletePembayaran($id);

        $modelSatu = new PemesananModel();
        $id = $this->request->getPost('fakturpemesanan');

        $datasatu = array(
            'pemesanan_status' => 0,
        );
        $modelSatu->updatePemesanan($datasatu, $id);

        session()->setFlashdata('success', 'Berhasil membatalkan pembayaran');
        return redirect()->to('pembayaran');
    }

    public function faktur($id)
    {
        $model = new PemesananModel();
        $modelsatu = new PembayaranModel();

        $data = [
            'pembayaran' => $modelsatu->getDataDetailPembayaran($id)->getResultArray(),
            'detailpemesanan' => $model->getDataDetail($id)->getResultArray(),
            'nomorpemesanan' => $id
        ];

        return view('report/report_faktur_pembayaran', $data);
    }
}
