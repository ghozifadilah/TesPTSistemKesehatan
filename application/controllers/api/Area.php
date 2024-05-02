<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;



set_time_limit(0);
date_default_timezone_set('Asia/Jakarta');
setlocale (LC_TIME, 'id_ID');

class Area extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Area_model');
     
      
    }

    //Menampilkan data
   



        
    function index_get($id=null) {
        $data = null;
       
        if ($id==null) {
            $data = $this->Area_model->get_all();
        }else{
        $data = $this->Area_model->get_by_id($id);
         
        }
      
        $this->response($data, 200);
        
    }




    function index_post() {
        $data = [];

        if($this->post('area_nama')!=null)
        $data['area_nama'] = $this->post('area_nama');
    
        $insert = $this->db->insert('area', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }

    }

    //Update data
	function index_put() {
        $area_id = $this->put('area_id');
        $data = [];
        if($this->put('area_nama')!=null)
            $data['area_nama'] = $this->put('area_nama');
        $this->db->where('area_id', $area_id);
        $update = $this->db->update('area', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
	function index_delete() {
        $area_id = $this->delete('area_id');
        $data = [];
        $this->db->where('area_id', $area_id);
        $delete = $this->db->delete('area', $data);
        if ($delete) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
	//Hapus data

?>