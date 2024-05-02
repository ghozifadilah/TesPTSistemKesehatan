<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_dbeli extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tbl_dbeli_model');
        $this->load->model('Tbl_hbeli_model');
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
            $config['base_url'] = base_url() . 'tbl_dbeli/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tbl_dbeli/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tbl_dbeli/index.html';
            $config['first_url'] = base_url() . 'tbl_dbeli/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tbl_dbeli_model->total_rows($q);
        $tbl_dbeli = $this->Tbl_dbeli_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbl_dbeli_data' => $tbl_dbeli,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('tbl_dbeli/tbl_dbeli_list', $data);
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

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_dbeli/create_action'),
	    'ID' => set_value('ID'),
	    'NOTRANSAKSI' => set_value('NOTRANSAKSI'),
	    'KODEBRG' => set_value('KODEBRG'),
	    'HARGABELI' => set_value('HARGABELI'),
	    'QTY' => set_value('QTY'),
	    'DISKON' => set_value('DISKON'),
	    'DISKONRP' => set_value('DISKONRP'),
	    'TOTALRP' => set_value('TOTALRP'),
	);
        $this->load->view('tbl_dbeli/tbl_dbeli_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
			'NOTRANSAKSI' => $this->input->post('NOTRANSAKSI',TRUE),
			'KODEBRG' => $this->input->post('KODEBRG',TRUE),
			'HARGABELI' => $this->input->post('HARGABELI',TRUE),
			'QTY' => $this->input->post('QTY',TRUE),
			'DISKON' => $this->input->post('DISKON',TRUE),
			'DISKONRP' => $this->input->post('DISKONRP',TRUE),
			'TOTALRP' => $this->input->post('TOTALRP',TRUE),
	    );

            $this->Tbl_dbeli_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tbl_dbeli'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_dbeli_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_dbeli/update_action'),
			'ID' => set_value('ID', $row->ID),
			'NOTRANSAKSI' => set_value('NOTRANSAKSI', $row->NOTRANSAKSI),
			'KODEBRG' => set_value('KODEBRG', $row->KODEBRG),
			'HARGABELI' => set_value('HARGABELI', $row->HARGABELI),
			'QTY' => set_value('QTY', $row->QTY),
			'DISKON' => set_value('DISKON', $row->DISKON),
			'DISKONRP' => set_value('DISKONRP', $row->DISKONRP),
			'TOTALRP' => set_value('TOTALRP', $row->TOTALRP),
	    );
            $this->load->view('tbl_dbeli/tbl_dbeli_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_dbeli'));
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
			'KODEBRG' => $this->input->post('KODEBRG',TRUE),
			'HARGABELI' => $this->input->post('HARGABELI',TRUE),
			'QTY' => $this->input->post('QTY',TRUE),
			'DISKON' => $this->input->post('DISKON',TRUE),
			'DISKONRP' => $this->input->post('DISKONRP',TRUE),
			'TOTALRP' => $this->input->post('TOTALRP',TRUE),
	    );

            $this->Tbl_dbeli_model->update($this->input->post('ID', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_dbeli'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_dbeli_model->get_by_id($id);

        if ($row) {
            $this->Tbl_dbeli_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_dbeli'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_dbeli'));
        }
    }

    public function ajax_addStockBarang()
    {
       
       

        $LastTransaksi = $this->input->post('LastTransaksi');
        // ---------------------------------------------------
        $stock = $this->input->post('stock');
        $diskon = $this->input->post('diskon');
        $pembayaran = $this->input->post('pembayaran');
        $totalRp = $this->input->post('totalRp');
     
        // ---------------------------------------------------
      
        $kodeBrg = $LastTransaksi['stock'][0]['KODEBRG'];
        $kodesup = $LastTransaksi['transaksi'][0]['KODESPL'];
        $idHutang = $LastTransaksi['hutang'][0]['ID'];
        // ---------------------------------------------------
        // ubah Stock
        $finalStock = $LastTransaksi['stock'][0]['QTYBELI'] + $stock;
        $this->Tbl_stock_model->get_by_id($kodeBrg);

        // ---------------------------------------------------

        if ($pembayaran < $totalRp) {
            $finalHutang = $LastTransaksi['hutang'][0]['TOTALHUTANG'] + ($totalRp - $pembayaran);
        }else{
            $finalHutang = $LastTransaksi['hutang'][0]['TOTALHUTANG'] - $totalRp;
        }

        if ($finalHutang < 0) {
            $finalHutang = 0;
        }

        $data = array(
            'QTYBELI' => $finalStock
        );
        
        $this->Tbl_stock_model->update($kodeBrg,$data);

        // ---------------------------------------------------

        $data = array(
			'NOTRANSAKSI' => $LastTransaksi['transaksi'][0]['NOTRANSAKSI'],
			'KODESPL' => $kodesup,
			'TGLBELI' => $LastTransaksi['transaksi'][0]['TGLBELI'],
			'TOTALHUTANG' => $finalHutang,
	    );

        $this->Tbl_hutang_model->update($idHutang, $data);

        // ---------------------------------------------------

        $data = array(
            'status' => 'stock update',
            'stock' => $finalStock,
        );

        echo json_encode($data);

    }

    public function _rules() 
    {
	$this->form_validation->set_rules('NOTRANSAKSI', 'notransaksi', 'trim|required');
	$this->form_validation->set_rules('KODEBRG', 'kodebrg', 'trim|required');
	$this->form_validation->set_rules('HARGABELI', 'hargabeli', 'trim|required');
	$this->form_validation->set_rules('QTY', 'qty', 'trim|required');
	$this->form_validation->set_rules('DISKON', 'diskon', 'trim|required');
	$this->form_validation->set_rules('DISKONRP', 'diskonrp', 'trim|required');
	$this->form_validation->set_rules('TOTALRP', 'totalrp', 'trim|required');

	$this->form_validation->set_rules('ID', 'ID', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

