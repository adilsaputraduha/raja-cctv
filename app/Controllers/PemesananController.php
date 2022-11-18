<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\PelangganModel;
use App\Models\PemesananModel;

class PemesananController extends BaseController
{
    public function index()
    {
        $model = new PemesananModel();
        $userlogin = session()->get('userLevel');
        $iduser = session()->get('userId');

        if ($userlogin == 3) {
            $data = [
                'pemesanan' => $model->getPemesananByUser($iduser)->getResultArray(),
            ];
            echo view('view_pemesanan', $data);
        } else {
            $data = [
                'pemesanan' => $model->getPemesanan()->getResultArray(),
            ];
            echo view('view_pemesanan', $data);
        }
    }

    public function add()
    {
        $generateRandom = rand(100, 999);
        $generateDate = date('Ymd');
        $generateInvoice = 'PS-' . $generateDate . "-" . $generateRandom;

        $model = new PemesananModel();
        $modelsatu = new PelangganModel();
        $modeldua = new ProdukModel();
        $data = [
            'detailpemesanan' => $model->getDataDetail($generateInvoice)->getResultArray(),
            'pelanggan' => $modelsatu->getPelanggan()->getResultArray(),
            'produk' => $modeldua->getProduk()->getResultArray(),
            'validation' => \Config\Services::validation(),
            'nomor' => $generateInvoice,
            'totalitem' => 0,
            'totalharga' => 0,
        ];
        echo view('view_pemesanan_tambah', $data);
    }

    public function update($id)
    {
        $model = new PemesananModel();
        $modelsatu = new PelangganModel();
        $modeldua = new ProdukModel();
        $data = [
            'pemesanan' => $model->getDataDetailPemesanan($id)->getResultArray(),
            'detailpemesanan' => $model->getDataDetail($id)->getResultArray(),
            'pelanggan' => $modelsatu->getPelanggan()->getResultArray(),
            'produk' => $modeldua->getProduk()->getResultArray(),
            'validation' => \Config\Services::validation(),
            'nomor' => $id
        ];
        echo view('view_pemesanan_update', $data);
    }

    public function detailindex()
    {
        $id = $this->request->getPost('fakturpemesanan');

        $model = new PemesananModel();
        $data = [
            'detailpemesanan' => $model->getDataDetail($id)->getResultArray(),
        ];
        echo view('table_pemesanan', $data);
    }

    public function detailsave()
    {
        $model = new PemesananModel();
        $data = array(
            'detail_pemesanan_faktur' => $this->request->getPost('fakturpemesanan'),
            'detail_pemesanan_produk' => $this->request->getPost('kodeproduk'),
            'detail_pemesanan_qty' => $this->request->getPost('qtyproduk'),
            'detail_pemesanan_jumlah' => $this->request->getPost('jumlahharga'),
        );
        $model->saveDetail($data);
    }

    public function detaildelete()
    {
        $model = new PemesananModel();
        $id = $this->request->getPost('detailid');
        $model->deleteDetail($id);
    }

    public function save()
    {
        $userlogin = session()->get('userLevel');
        $iduser = session()->get('userId');

        if ($userlogin == 3) {
            $model = new PemesananModel();
            $data = array(
                'pemesanan_faktur' => $this->request->getPost('fakturpemesanan'),
                'pemesanan_pelanggan' => $iduser,
                'pemesanan_tanggal' => $this->request->getPost('tanggalpemesanan'),
                'pemesanan_total_item' => $this->request->getPost('totalitem'),
                'pemesanan_total_harga' => $this->request->getPost('totalharga'),
                'pemesanan_status' => 0,
            );
            $model->savePemesanan($data);
        } else {
            $model = new PemesananModel();
            $data = array(
                'pemesanan_faktur' => $this->request->getPost('fakturpemesanan'),
                'pemesanan_pelanggan' => $this->request->getPost('idpelanggan'),
                'pemesanan_tanggal' => $this->request->getPost('tanggalpemesanan'),
                'pemesanan_total_item' => $this->request->getPost('totalitem'),
                'pemesanan_total_harga' => $this->request->getPost('totalharga'),
                'pemesanan_status' => 0,
            );
            $model->savePemesanan($data);
        }
    }

    public function edit()
    {
        $id = $this->request->getPost('fakturpemesanan');

        $model = new PemesananModel();
        $data = array(
            'pemesanan_pelanggan' => $this->request->getPost('idpelanggan'),
            'pemesanan_tanggal' => $this->request->getPost('tanggalpemesanan'),
            'pemesanan_total_item' => $this->request->getPost('totalitem'),
            'pemesanan_total_harga' => $this->request->getPost('totalharga'),
            'pemesanan_status' => 0,
        );
        $model->updatePemesanan($data, $id);
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

    public function faktur($id)
    {
        $model = new PemesananModel();

        $data = [
            'pemesanan' => $model->getDataDetailPemesanan($id)->getresultArray(),
            'detailpemesanan' => $model->getDataDetail($id)->getResultArray(),
            'nomorpemesanan' => $id
        ];

        return view('report/report_faktur_pemesanan', $data);
    }

    public function tambah($id, $harga)
    {
        $model = new PemesananModel();
        $modelsatu = new PelangganModel();
        $modeldua = new ProdukModel();
        $data = [
            'detailpemesanan' => $model->getDataDetail($id)->getResultArray(),
            'pelanggan' => $modelsatu->getPelanggan()->getResultArray(),
            'produk' => $modeldua->getProduk()->getResultArray(),
            'validation' => \Config\Services::validation(),
            'nomor' => $id,
            'totalitem' => 1,
            'totalharga' => $harga,
        ];
        echo view('view_pemesanan_tambah', $data);
    }
}
