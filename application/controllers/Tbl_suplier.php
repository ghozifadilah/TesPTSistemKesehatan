<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_suplier extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tbl_suplier_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'tbl_suplier/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tbl_suplier/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tbl_suplier/index.html';
            $config['first_url'] = base_url() . 'tbl_suplier/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tbl_suplier_model->total_rows($q);
        $tbl_suplier = $this->Tbl_suplier_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbl_suplier_data' => $tbl_suplier,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('tbl_suplier/tbl_suplier_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_suplier_model->get_by_id($id);
        if ($row) {
            $data = array(
			'ID' => $row->ID,
			'KODESPL' => $row->KODESPL,
			'NAMASPL' => $row->NAMASPL,
	    );
            $this->load->view('tbl_suplier/tbl_suplier_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_suplier'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('tbl_suplier/create_action'),
	    'ID' => set_value('ID'),
	    'KODESPL' => set_value('KODESPL'),
	    'NAMASPL' => set_value('NAMASPL'),
	);
        $this->load->view('tbl_suplier/tbl_suplier_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
			'KODESPL' => $this->input->post('KODESPL',TRUE),
			'NAMASPL' => $this->input->post('NAMASPL',TRUE),
	    );

            $this->Tbl_suplier_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tbl_suplier'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_suplier_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Ubah',
                'action' => site_url('tbl_suplier/update_action'),
			'ID' => set_value('ID', $row->ID),
			'KODESPL' => set_value('KODESPL', $row->KODESPL),
			'NAMASPL' => set_value('NAMASPL', $row->NAMASPL),
	    );
            $this->load->view('tbl_suplier/tbl_suplier_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_suplier'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('ID', TRUE));
        } else {
            $data = array(
			'KODESPL' => $this->input->post('KODESPL',TRUE),
			'NAMASPL' => $this->input->post('NAMASPL',TRUE),
	    );

            $this->Tbl_suplier_model->update($this->input->post('ID', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_suplier'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_suplier_model->get_by_id($id);

        if ($row) {
            $this->Tbl_suplier_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_suplier'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_suplier'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('KODESPL', 'kodespl', 'trim|required');
	$this->form_validation->set_rules('NAMASPL', 'namaspl', 'trim|required');

	$this->form_validation->set_rules('ID', 'ID', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Tbl_suplier.php */
/* Location: ./application/controllers/Tbl_suplier.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2024-04-30 00:27:38 */
/* http://harviacode.com */