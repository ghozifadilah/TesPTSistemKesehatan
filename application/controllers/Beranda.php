<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Beranda extends CI_Controller
{

    public function __construct()
	{
		parent::__construct();

		$this->load->model('tbl_barang_model');
		$this->load->model('tbl_dbeli_model');
		$this->load->model('tbl_hbeli_model');
		$this->load->model('tbl_hutang_model');
		$this->load->model('tbl_stock_model');
		$this->load->model('Tbl_suplier_model');

		

		date_default_timezone_set('Asia/Jakarta');

	}

    public function index()
    {
		
		
		if ($this->session->userdata('id') == null) redirect('/login', 'refresh');


		// data barang
		$dataBarang = $this->db->query("SELECT tbl_barang.*, tbl_stock.QTYBELI
		FROM tbl_barang
		INNER JOIN tbl_stock ON tbl_barang.KODEBRG = tbl_stock.KODEBRG ORDER BY tbl_barang.ID DESC ")->result();

		// data suplier
		$query = "
		SELECT tbl_suplier.*, tbl_hutang.*
		FROM tbl_suplier
		INNER JOIN tbl_hutang ON tbl_suplier.KODESPL = tbl_hutang.KODESPL
		";
	
		$suplier = $this->db->query($query)->result();

		// -------------------------------------------------------------------
		// Transaksi Terakhir
		$lastIDTransaksi = $this->db->query("SELECT tbl_hbeli.ID,tbl_hbeli.NOTRANSAKSI from tbl_hbeli ORDER BY tbl_hbeli.ID DESC limit 1 ")->result();
		$lastIDTransaksi = @$lastIDTransaksi[0]; // jika tidak ada data transaksi maka akan diisi dengan null
		$query = "
			SELECT hb.*, db.*
			FROM tbl_hbeli hb
			JOIN tbl_dbeli db ON hb.NOTRANSAKSI = db.NOTRANSAKSI
			ORDER BY db.ID DESC
		";

		$transaksi = $this->db->query($query)->result();

		$data = array(
			'daftarBarang' => $dataBarang,
			'lastIDTransaksi' => $lastIDTransaksi,
			'listTransaksi' => $transaksi,
			'suplier' => $suplier
		);


		$this->load->view('home',$data);
		
	
    }

  
}


