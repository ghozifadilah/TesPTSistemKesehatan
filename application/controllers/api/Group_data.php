<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;



set_time_limit(0);
date_default_timezone_set('Asia/Jakarta');
setlocale (LC_TIME, 'id_ID');

class Group_data extends REST_Controller {

   
    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Group_data_model');      
    }

    //Menampilkan data
   



        
    function index_get($id=null) {
        $data = null;
       
        if ($id==null) {
            $data = $this->Group_data_model->get_all();
        }else{
        $data = $this->Group_data_model->get_by_id($id);
         
        }
      
        $this->response($data, 200);
        
    }




    function index_post() {
        $data = [];

        if($this->post('group_nama')!=null)
        $data['group_nama'] = $this->post('group_nama');
    
        $insert = $this->db->insert('group_data', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }

    }

    //Update data
	function index_put() {
        $group_id = $this->put('group_id');
        $data = [];
        if($this->put('group_nama')!=null)
            $data['group_nama'] = $this->put('group_nama');
            $this->db->where('group_id', $group_id);
        $update = $this->db->update('group_data', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
	function index_delete() {
        $group_id = $this->delete('group_id');
        $data = [];
        $this->db->where('group_id', $group_id);
        $delete = $this->db->delete('group_data', $data);
        if ($delete) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
	//Hapus data

?>