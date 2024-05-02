<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_stock extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tbl_stock_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'tbl_stock/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tbl_stock/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tbl_stock/index.html';
            $config['first_url'] = base_url() . 'tbl_stock/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tbl_stock_model->total_rows($q);
        $tbl_stock = $this->Tbl_stock_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbl_stock_data' => $tbl_stock,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('tbl_stock/tbl_stock_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_stock_model->get_by_id($id);
        if ($row) {
            $data = array(
			'KODEBRG' => $row->KODEBRG,
			'QTYBELI' => $row->QTYBELI,
	    );
            $this->load->view('tbl_stock/tbl_stock_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_stock'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_stock/create_action'),
	    'KODEBRG' => set_value('KODEBRG'),
	    'QTYBELI' => set_value('QTYBELI'),
	);
        $this->load->view('tbl_stock/tbl_stock_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
			'QTYBELI' => $this->input->post('QTYBELI',TRUE),
	    );

            $this->Tbl_stock_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tbl_stock'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_stock_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_stock/update_action'),
			'KODEBRG' => set_value('KODEBRG', $row->KODEBRG),
			'QTYBELI' => set_value('QTYBELI', $row->QTYBELI),
	    );
            $this->load->view('tbl_stock/tbl_stock_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_stock'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('KODEBRG', TRUE));
        } else {
            $data = array(
			'QTYBELI' => $this->input->post('QTYBELI',TRUE),
	    );

            $this->Tbl_stock_model->update($this->input->post('KODEBRG', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_stock'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_stock_model->get_by_id($id);

        if ($row) {
            $this->Tbl_stock_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_stock'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_stock'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('QTYBELI', 'qtybeli', 'trim|required');

	$this->form_validation->set_rules('KODEBRG', 'KODEBRG', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

