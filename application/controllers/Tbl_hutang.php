<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_hutang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tbl_hutang_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'tbl_hutang/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tbl_hutang/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tbl_hutang/index.html';
            $config['first_url'] = base_url() . 'tbl_hutang/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tbl_hutang_model->total_rows($q);
        $tbl_hutang = $this->Tbl_hutang_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbl_hutang_data' => $tbl_hutang,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('tbl_hutang/tbl_hutang_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_hutang_model->get_by_id($id);
        if ($row) {
            $data = array(
			'ID' => $row->ID,
			'NOTRANSAKSI' => $row->NOTRANSAKSI,
			'KODESPL' => $row->KODESPL,
			'TGLBELI' => $row->TGLBELI,
			'TOTALHUTANG' => $row->TOTALHUTANG,
	    );
            $this->load->view('tbl_hutang/tbl_hutang_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_hutang'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_hutang/create_action'),
	    'ID' => set_value('ID'),
	    'NOTRANSAKSI' => set_value('NOTRANSAKSI'),
	    'KODESPL' => set_value('KODESPL'),
	    'TGLBELI' => set_value('TGLBELI'),
	    'TOTALHUTANG' => set_value('TOTALHUTANG'),
	);
        $this->load->view('tbl_hutang/tbl_hutang_form', $data);
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
			'TOTALHUTANG' => $this->input->post('TOTALHUTANG',TRUE),
	    );

            $this->Tbl_hutang_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tbl_hutang'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_hutang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_hutang/update_action'),
			'ID' => set_value('ID', $row->ID),
			'NOTRANSAKSI' => set_value('NOTRANSAKSI', $row->NOTRANSAKSI),
			'KODESPL' => set_value('KODESPL', $row->KODESPL),
			'TGLBELI' => set_value('TGLBELI', $row->TGLBELI),
			'TOTALHUTANG' => set_value('TOTALHUTANG', $row->TOTALHUTANG),
	    );
            $this->load->view('tbl_hutang/tbl_hutang_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_hutang'));
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
			'TOTALHUTANG' => $this->input->post('TOTALHUTANG',TRUE),
	    );

            $this->Tbl_hutang_model->update($this->input->post('ID', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_hutang'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_hutang_model->get_by_id($id);

        if ($row) {
            $this->Tbl_hutang_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_hutang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_hutang'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('NOTRANSAKSI', 'notransaksi', 'trim|required');
	$this->form_validation->set_rules('KODESPL', 'kodespl', 'trim|required');
	$this->form_validation->set_rules('TGLBELI', 'tglbeli', 'trim|required');
	$this->form_validation->set_rules('TOTALHUTANG', 'totalhutang', 'trim|required');

	$this->form_validation->set_rules('ID', 'ID', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

