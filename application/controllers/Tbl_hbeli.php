<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_hbeli extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tbl_hbeli_model');
        $this->load->model('Tbl_dbeli_model');
        $this->load->model('Tbl_barang_model');
        $this->load->model('Tbl_stock_model');
        $this->load->model('Tbl_suplier_model');
        $this->load->model('Tbl_hutang_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'tbl_hbeli/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tbl_hbeli/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tbl_hbeli/index.html';
            $config['first_url'] = base_url() . 'tbl_hbeli/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tbl_hbeli_model->total_rows($q);
        $tbl_hbeli = $this->Tbl_hbeli_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbl_hbeli_data' => $tbl_hbeli,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('tbl_hbeli/tbl_hbeli_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_dbeli_model->get_by_id($id);
        if ($row) {
            $data = array(
			'ID' => $row->ID,
			'NOTRANSAKSI' => $row->NOTRANSAKSI,
			'KODEBRG' => $row->KODEBRG,
			'HARGABELI' => $row->HARGABELI,
			'QTY' => $row->QTY,
			'DISKON' => $row->DISKON,
			'DISKONRP' => $row->DISKONRP,
			'TOTALRP' => $row->TOTALRP,
	    );
            $this->load->view('tbl_dbeli/tbl_dbeli_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_hbeli'));
        }
    }
    
    function detailBeli($id)  {
        
        $row = $this->Tbl_hbeli_model->get_by_id($id);
        $nomorTransaksi = $row->NOTRANSAKSI;
        $lastIDTransaksi = $this->db->query("SELECT tbl_dbeli.ID from tbl_dbeli where NOTRANSAKSI = '$nomorTransaksi' ORDER BY ID DESC limit 1 ")->result();
        
        $this->read($lastIDTransaksi[0]->ID);
       
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_hbeli/create_action'),
	    'ID' => set_value('ID'),
	    'NOTRANSAKSI' => set_value('NOTRANSAKSI'),
	    'KODESPL' => set_value('KODESPL'),
	    'TGLBELI' => set_value('TGLBELI'),
	);
        $this->load->view('tbl_hbeli/tbl_hbeli_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
			'NOTRANSAKSI' => $this->input->post('NOTRANSAKSI',TRUE),
			'KODESPL' => $this->input->post('KODESPL',TRUE),
			'TGLBELI' => $this->input->post('TGLBELI',TRUE),
	    );

            $this->Tbl_hbeli_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tbl_hbeli'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_hbeli_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_hbeli/update_action'),
			'ID' => set_value('ID', $row->ID),
			'NOTRANSAKSI' => set_value('NOTRANSAKSI', $row->NOTRANSAKSI),
			'KODESPL' => set_value('KODESPL', $row->KODESPL),
			'TGLBELI' => set_value('TGLBELI', $row->TGLBELI),
	    );
            $this->load->view('tbl_hbeli/tbl_hbeli_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_hbeli'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('ID', TRUE));
        } else {
            $data = array(
			'NOTRANSAKSI' => $this->input->post('NOTRANSAKSI',TRUE),
			'KODESPL' => $this->input->post('KODESPL',TRUE),
			'TGLBELI' => $this->input->post('TGLBELI',TRUE),
	    );

            $this->Tbl_hbeli_model->update($this->input->post('ID', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_hbeli'));
        }
    }

 
    
    public function delete($id) 
    {
        $row = $this->Tbl_hbeli_model->get_by_id($id);

        if ($row) {
            $this->Tbl_hbeli_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_hbeli'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_hbeli'));
        }
    }

    public function ajax_addNewBarang()
    {

      
        $inputKodeBarang = $this->input->post('inputKodeBarang');
        $inputNamaBarang = $this->input->post('inputNamaBarang');
        $inputSatuanBarang = $this->input->post('inputSatuanBarang');
        $inputHargaBeli = $this->input->post('inputHargaBeli');
        // =============================================================
        $inputKodeSupplier = $this->input->post('inputKodeSupplier');
        $inputnamaSupplier = $this->input->post('inputnamaSupplier');
        $isNewSupplier = $this->input->post('isNewSuplier');
        // =============================================================
        $inputQuantity = $this->input->post('inputQuantity');
        $inputDiskon = $this->input->post('inputDiskon');
        $inputPembayaran = $this->input->post('inputPembayaran');
        $lastIDTransaksi = $this->input->post('lastIDTransaksi');
        $totalDiskon = $this->input->post('totalDiskon');
        $totalRp = $this->input->post('totalRp');
        $hutang = $this->input->post('hutang');

        // $HutangData = $this->db->query("SELECT *from tbl_hutang where KODESPL = '$inputKodeSupplier' ORDER BY ID DESC limit 1 ")->result();

        // var_dump($HutangData[0]->KODESPL);
        // die;

        
      
        // =============================================================
        //Nomor transaksi formatnya ‘B’+TAHUN+BULAN+URUT (CONTOH ‘B202101001’) AKAN
        // BERTAMBAH BILA ADA TRANSAKSI BARU
        $nomorTransaksi = $this->getNomorTransaksi($lastIDTransaksi);
        $tanggal = date('Y-m-d H:i:s');


        // insert data barang

        $data = array(
			'KODEBRG' => $inputKodeBarang,
			'NAMABRG' => $inputNamaBarang,
			'SATUAN' => $inputSatuanBarang,
			'HARGABELI' => $inputHargaBeli,
	    );

        $this->Tbl_barang_model->insert($data);

        // ==============================================================
        // insert data supplier

        if ($isNewSupplier == 'true') {
            $data = array(
                'KODESPL' => $inputKodeSupplier,
                'NAMASPL' => $inputnamaSupplier,
            );
    
            $this->Tbl_suplier_model->insert($data);
        }

        // ==============================================================
        // insert data stok
        $data = array(
            'KODEBRG' => $inputKodeBarang,
			'QTYBELI' => $inputQuantity,
	    );

        $this->Tbl_stock_model->insert($data);
        
        // ==============================================================
        // insert data transaksi
        
            // insert hbeli
            $data = array(
                'NOTRANSAKSI' => $nomorTransaksi,
                'KODESPL' => $inputKodeSupplier,
                'TGLBELI' => $tanggal,
            );
            
            $this->Tbl_hbeli_model->insert($data);

            // insert dbeli
            $data = array(
                'NOTRANSAKSI' => $nomorTransaksi,
                'KODEBRG' => $inputKodeBarang,
                'HARGABELI' => $inputHargaBeli,
                'QTY' => $inputQuantity,
                'DISKON' => $inputDiskon,
                'DISKONRP' => $totalDiskon,
                'TOTALRP' => $totalRp,
            );

            $this->Tbl_dbeli_model->insert($data);

    
            if ($isNewSupplier == 'true') {
                // insert hutang
                $data = array(
                    'NOTRANSAKSI' => $nomorTransaksi,
                    'KODESPL' => $inputKodeSupplier,
                    'TGLBELI' => $tanggal,
                    'TOTALHUTANG' => $hutang,
                );
                
                $this->Tbl_hutang_model->insert($data);
               
            }else{
                // update hutang

                // query get hutang where inputKodeSupplier
                $HutangData = $this->db->query("SELECT *from tbl_hutang where KODESPL = '$inputKodeSupplier' ORDER BY ID DESC limit 1 ")->result();

                $noTransaksi = $HutangData[0]->NOTRANSAKSI;
                $kodeSup = $HutangData[0]->KODESPL;
                $tglBeli = $HutangData[0]->TGLBELI;
                $totalHutang = $HutangData[0]->TOTALHUTANG;
                $idhutang = $HutangData[0]->ID;

                $data = array(
                    
                    'NOTRANSAKSI' => $nomorTransaksi,
                    'KODESPL' => $inputKodeSupplier,
                    'TGLBELI' => $tglBeli,
                    'TOTALHUTANG' => $totalHutang + $hutang,
                );
        
                 $this->Tbl_hutang_model->update($idhutang, $data);
                
            }
    
            echo json_encode(array("status" => "added success"));

    }

    

    function getNomorTransaksi($lastTransaction) {

            if($lastTransaction == NULL){
                $lastTransaction = 'B202204000'; //jika tidak ada data transaksi sama sekali
            } 
    
            // Mendapatkan tanggal dan waktu saat ini
            $currentYear = date('Y');
            $currentMonth = date('m');

            // Mendapatkan tahun, bulan, dan urutan dari nomor transaksi terakhir
            $lastYear = substr($lastTransaction, 1, 4);
            $lastMonth = substr($lastTransaction, 5, 2);
            $lastNumber = substr($lastTransaction, 7);

            // Jika tahun atau bulan terakhir tidak sama dengan tahun atau bulan saat ini, reset urutan transaksi menjadi 001
            if ($lastYear != $currentYear || $lastMonth != $currentMonth) {
                $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            } else {
                // Jika tahun dan bulan sama, tambahkan 1 pada urutan transaksi terakhir
                $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            }

            // Membuat nomor transaksi baru
            $newTransaction = 'B' . $currentYear . $currentMonth . $newNumber;

            return $newTransaction;
           

    }

    public function _rules() 
    {
	$this->form_validation->set_rules('NOTRANSAKSI', 'notransaksi', 'trim|required');
	$this->form_validation->set_rules('KODESPL', 'kodespl', 'trim|required');
	$this->form_validation->set_rules('TGLBELI', 'tglbeli', 'trim|required');

	$this->form_validation->set_rules('ID', 'ID', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

