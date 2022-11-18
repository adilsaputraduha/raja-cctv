<?php

namespace App\Controllers;

use App\Models\PelangganModel;
use App\Models\UserModel;
use App\Models\PemesananModel;
use App\Models\ProdukModel;

class HomeController extends BaseController
{
	public function index()
	{
		$generateRandom = rand(100, 999);
		$generateDate = date('Ymd');
		$generateInvoice = 'PS-' . $generateDate . "-" . $generateRandom;

		$modelUser = new UserModel();
		$modelPelanggan = new PelangganModel();
		$modelProduk = new ProdukModel();
		$modelPemesanan = new PemesananModel();

		$rowUser = $modelUser->getUser();
		$rowPelanggan = $modelPelanggan->getPelanggan();
		$rowProduk = $modelProduk->getProduk();
		$rowPemesanan = $modelPemesanan->getPemesanan();

		$data = [
			'user' => count($rowUser->getResult()),
			'pelanggan' => count($rowPelanggan->getResult()),
			'produk' => count($rowProduk->getResult()),
			'pemesanan' => count($rowPemesanan->getResult()),
			'produklooping' => $modelProduk->getProduk()->getResultArray(),
			'nomor' => $generateInvoice
		];
		return view('view_home', $data);
	}

	public function pesansekarang()
	{
		$model = new PemesananModel();
		$data = array(
			'detail_pemesanan_faktur' => $this->request->getPost('invoice'),
			'detail_pemesanan_produk' => $this->request->getPost('idproduk'),
			'detail_pemesanan_qty' => 1,
			'detail_pemesanan_jumlah' => $this->request->getPost('hargaproduk'),
		);
		$model->saveDetail($data);
		return redirect()->to('pemesanan/tambah/' . $this->request->getPost('invoice') . '/' . $this->request->getPost('hargaproduk'));
	}
}
