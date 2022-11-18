<?php

namespace App\Controllers;

use App\Models\Report;

class ReportController extends BaseController
{
    public function index()
    {
        echo view('view_report');
    }

    public function reportpemesanan($tanggalawalpemesanan, $tanggalakhirpemesanan)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT pemesanan_faktur, pemesanan_pelanggan, pemesanan_tanggal, pemesanan_total_item, pemesanan_total_harga,
        pemesanan_status, pelanggan_nama 
        FROM tb_pemesanan
        JOIN tb_pelanggan ON pelanggan_id = pemesanan_pelanggan        
        WHERE pemesanan_tanggal BETWEEN '$tanggalawalpemesanan' and '$tanggalakhirpemesanan'");

        $data = [
            'pemesanan' => $query->getResultArray(),
            'tanggalawalpemesanan' => $tanggalawalpemesanan,
            'tanggalakhirpemesanan' => $tanggalakhirpemesanan,
        ];
        echo view('report/report_pemesanan', $data);
    }

    public function reportpemesananbulan($bulan, $tahun)
    {
        $namaBulan = '';

        if ($bulan == 1) {
            $namaBulan = 'Januari';
        } else if ($bulan == 2) {
            $namaBulan = 'Februari';
        } else if ($bulan == 3) {
            $namaBulan = 'Maret';
        } else if ($bulan == 4) {
            $namaBulan = 'April';
        } else if ($bulan == 5) {
            $namaBulan = 'Mei';
        } else if ($bulan == 6) {
            $namaBulan = 'Juni';
        } else if ($bulan == 7) {
            $namaBulan = 'Juli';
        } else if ($bulan == 8) {
            $namaBulan = 'Agustus';
        } else if ($bulan == 9) {
            $namaBulan = 'September';
        } else if ($bulan == 10) {
            $namaBulan = 'Oktober';
        } else if ($bulan == 11) {
            $namaBulan = 'November';
        } else if ($bulan == 12) {
            $namaBulan = 'Desember';
        }

        $db = \Config\Database::connect();
        $query = $db->query("SELECT pemesanan_faktur, pemesanan_pelanggan, pemesanan_tanggal, pemesanan_total_item, pemesanan_total_harga,
        pemesanan_status, pelanggan_nama 
        FROM tb_pemesanan
        JOIN tb_pelanggan ON pelanggan_id = pemesanan_pelanggan        
        WHERE MONTH(pemesanan_tanggal) = '$bulan' AND YEAR(pemesanan_tanggal) = '$tahun'");

        $data = [
            'pemesanan' => $query->getResultArray(),
            'bulan' => $namaBulan,
            'tahun' => $tahun,
        ];
        echo view('report/report_pemesanan_bulan', $data);
    }

    public function reportpemesanantahun($tahun)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT pemesanan_faktur, pemesanan_pelanggan, pemesanan_tanggal, pemesanan_total_item, pemesanan_total_harga,
        pemesanan_status, pelanggan_nama 
        FROM tb_pemesanan
        JOIN tb_pelanggan ON pelanggan_id = pemesanan_pelanggan        
        WHERE YEAR(pemesanan_tanggal) = '$tahun'");

        $data = [
            'pemesanan' => $query->getResultArray(),
            'tahun' => $tahun,
        ];
        echo view('report/report_pemesanan_tahun', $data);
    }

    public function reportpembayaran($tanggalawalpembayaran, $tanggalakhirpembayaran)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT pembayaran_faktur, pemesanan_pelanggan, pemesanan_tanggal, pemesanan_total_item, pemesanan_total_harga,
        pemesanan_status, pelanggan_nama, pembayaran_tanggal
        FROM tb_pembayaran
        JOIN tb_pemesanan ON pembayaran_faktur = pemesanan_faktur   
        JOIN tb_pelanggan ON pelanggan_id = pemesanan_pelanggan   
        WHERE pembayaran_tanggal BETWEEN '$tanggalawalpembayaran' and '$tanggalakhirpembayaran'");

        $data = [
            'pembayaran' => $query->getResultArray(),
            'tanggalawalpembayaran' => $tanggalawalpembayaran,
            'tanggalakhirpembayaran' => $tanggalakhirpembayaran,
        ];
        echo view('report/report_pembayaran', $data);
    }

    public function reportpembayaranbulan($bulan, $tahun)
    {
        $namaBulan = '';

        if ($bulan == 1) {
            $namaBulan = 'Januari';
        } else if ($bulan == 2) {
            $namaBulan = 'Februari';
        } else if ($bulan == 3) {
            $namaBulan = 'Maret';
        } else if ($bulan == 4) {
            $namaBulan = 'April';
        } else if ($bulan == 5) {
            $namaBulan = 'Mei';
        } else if ($bulan == 6) {
            $namaBulan = 'Juni';
        } else if ($bulan == 7) {
            $namaBulan = 'Juli';
        } else if ($bulan == 8) {
            $namaBulan = 'Agustus';
        } else if ($bulan == 9) {
            $namaBulan = 'September';
        } else if ($bulan == 10) {
            $namaBulan = 'Oktober';
        } else if ($bulan == 11) {
            $namaBulan = 'November';
        } else if ($bulan == 12) {
            $namaBulan = 'Desember';
        }

        $db = \Config\Database::connect();
        $query = $db->query("SELECT pembayaran_faktur, pemesanan_pelanggan, pemesanan_tanggal, pemesanan_total_item, pemesanan_total_harga,
        pemesanan_status, pelanggan_nama, pembayaran_tanggal
        FROM tb_pembayaran
        JOIN tb_pemesanan ON pembayaran_faktur = pemesanan_faktur   
        JOIN tb_pelanggan ON pelanggan_id = pemesanan_pelanggan   
        WHERE MONTH(pembayaran_tanggal) = '$bulan' AND YEAR(pembayaran_tanggal) = '$tahun'");

        $data = [
            'pembayaran' => $query->getResultArray(),
            'bulan' => $namaBulan,
            'tahun' => $tahun,
        ];
        echo view('report/report_pembayaran_bulan', $data);
    }

    public function reportpembayarantahun($tahun)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT pembayaran_faktur, pemesanan_pelanggan, pemesanan_tanggal, pemesanan_total_item, pemesanan_total_harga,
        pemesanan_status, pelanggan_nama, pembayaran_tanggal
        FROM tb_pembayaran
        JOIN tb_pemesanan ON pembayaran_faktur = pemesanan_faktur   
        JOIN tb_pelanggan ON pelanggan_id = pemesanan_pelanggan   
        WHERE YEAR(pembayaran_tanggal) = '$tahun'");

        $data = [
            'pembayaran' => $query->getResultArray(),
            'tahun' => $tahun,
        ];
        echo view('report/report_pembayaran_tahun', $data);
    }
}
