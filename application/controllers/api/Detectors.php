<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;



set_time_limit(0);
date_default_timezone_set('Asia/Jakarta');
setlocale (LC_TIME, 'id_ID');

class Detectors extends REST_Controller {

   
    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Detectors_model');      
    }

    //Menampilkan data
   



        
    function index_get($id=null) {
        $data = null;
       
        if ($id==null) {
            $data = $this->Group_area_model->get_all();
        }else{
        $data = $this->Group_area_model->get_by_id($id);
         
        }
      
        $this->response($data, 200);
        
    }




    function log_deteksi_get() {
        $data = [];

        $id_camera = $this->get('camera_id');
        $data_detector = $this->db->query("SELECT * FROM detectors where camera_id = $id_camera order by id desc ")->result();
        
    
        $data['detector_id'] = $data_detector[0]->id;
  
        if($this->get('object')!=null)
        $data['object'] = $this->get('object');

        if($this->get('counter')!=null)
        $data['counter'] = $this->get('counter');
  

        $data['timestamp'] = date('Y-m-d H:i');

 

        $insert = $this->db->insert('Camera_log', $data);

        $data['status'] = 'Ok';
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

        if($this->put('group_area_group_id')!=null)
        $data['group_area_group_id'] = $this->put('group_area_group_id');

        if($this->put('group_area_area_id')!=null)
        $data['group_area_area_id'] = $this->put('group_area_area_id');

        $update = $this->db->update('Group_area', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
	function index_delete() {
        $group_id = $this->delete('group_area_id');
        $data = [];
        $this->db->where('group_area_id', $group_id);
        $delete = $this->db->delete('group_area', $data);
        if ($delete) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
	//Hapus data

?>