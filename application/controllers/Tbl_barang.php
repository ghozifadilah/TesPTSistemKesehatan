<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_barang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tbl_barang_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'tbl_barang/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tbl_barang/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tbl_barang/index.html';
            $config['first_url'] = base_url() . 'tbl_barang/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tbl_barang_model->total_rows($q);
        $tbl_barang = $this->Tbl_barang_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbl_barang_data' => $tbl_barang,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('tbl_barang/tbl_barang_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_barang_model->get_by_id($id);
        if ($row) {
            $data = array(
			'ID' => $row->ID,
			'KODEBRG' => $row->KODEBRG,
			'NAMABRG' => $row->NAMABRG,
			'SATUAN' => $row->SATUAN,
			'HARGABELI' => $row->HARGABELI,
	    );
            $this->load->view('tbl_barang/tbl_barang_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_barang'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('tbl_barang/create_action'),
	    'ID' => set_value('ID'),
	    'KODEBRG' => set_value('KODEBRG'),
	    'NAMABRG' => set_value('NAMABRG'),
	    'SATUAN' => set_value('SATUAN'),
	    'HARGABELI' => set_value('HARGABELI'),
	);
        $this->load->view('tbl_barang/tbl_barang_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
			'KODEBRG' => $this->input->post('KODEBRG',TRUE),
			'NAMABRG' => $this->input->post('NAMABRG',TRUE),
			'SATUAN' => $this->input->post('SATUAN',TRUE),
			'HARGABELI' => $this->input->post('HARGABELI',TRUE),
	    );

            $this->Tbl_barang_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tbl_barang'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_barang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Ubah',
                'action' => site_url('tbl_barang/update_action'),
			'ID' => set_value('ID', $row->ID),
			'KODEBRG' => set_value('KODEBRG', $row->KODEBRG),
			'NAMABRG' => set_value('NAMABRG', $row->NAMABRG),
			'SATUAN' => set_value('SATUAN', $row->SATUAN),
			'HARGABELI' => set_value('HARGABELI', $row->HARGABELI),
	    );
            $this->load->view('tbl_barang/tbl_barang_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_barang'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('ID', TRUE));
        } else {
            $data = array(
			'KODEBRG' => $this->input->post('KODEBRG',TRUE),
			'NAMABRG' => $this->input->post('NAMABRG',TRUE),
			'SATUAN' => $this->input->post('SATUAN',TRUE),
			'HARGABELI' => $this->input->post('HARGABELI',TRUE),
	    );

            $this->Tbl_barang_model->update($this->input->post('ID', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_barang'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_barang_model->get_by_id($id);

        if ($row) {
            $this->Tbl_barang_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_barang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_barang'));
        }
    }

    public function ajax_searchBarang()
    {
        $cari = $this->input->get('search');
    
      

        
        try {
        $query = "SELECT 
            tbl_barang.ID AS barang_id,
            tbl_barang.KODEBRG AS barang_kode,
            tbl_barang.NAMABRG AS barang_nama,
            tbl_barang.SATUAN AS barang_satuan,
            tbl_barang.HARGABELI AS barang_harga,
            tbl_stock.QTYBELI AS barang_qty
        FROM 
            tbl_barang
        JOIN 
            tbl_stock ON tbl_barang.KODEBRG = tbl_stock.KODEBRG
        WHERE 
            tbl_barang.NAMABRG LIKE '%".$cari."%' OR
            tbl_barang.KODEBRG LIKE '%".$cari."%'";

                $getBarang =  $this->db->query($query)->result();

                @$kodeBarang = $getBarang[0]->barang_kode;

                    // Query to join tbl_hbeli and tbl_dbeli
                    $query = "
                        SELECT hb.*, db.*
                        FROM tbl_hbeli hb
                        JOIN tbl_dbeli db ON hb.NOTRANSAKSI = db.NOTRANSAKSI
                        WHERE db.KODEBRG = '$kodeBarang'
                    ";

                $transaksi = $this->db->query($query)->result();

                @$kodeSupplier = $transaksi[0]->KODESPL;

                $hutang = $this->db->query("SELECT * FROM tbl_hutang WHERE KODESPL = '$kodeSupplier'")->result();

                $stock = $this->db->query("SELECT * FROM tbl_stock WHERE KODEBRG = '$kodeBarang'")->result();

                $data = array(
                    'getBarang' => $getBarang,
                    'transaksi' => $transaksi,
                    'hutang' => $hutang,
                    'stock' => $stock
                );

                echo json_encode($data);
        } catch (Exception $e) {
           echo 'no data';
        }
    }
    

    public function _rules() 
    {
	$this->form_validation->set_rules('KODEBRG', 'kodebrg', 'trim|required');
	$this->form_validation->set_rules('NAMABRG', 'namabrg', 'trim|required');
	$this->form_validation->set_rules('SATUAN', 'satuan', 'trim|required');
	$this->form_validation->set_rules('HARGABELI', 'hargabeli', 'trim|required');

	$this->form_validation->set_rules('ID', 'ID', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
