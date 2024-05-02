<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;



set_time_limit(0);
date_default_timezone_set('Asia/Jakarta');
setlocale (LC_TIME, 'id_ID');

class User extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('User_model');
     
      
    }

    //Menampilkan data
   



        
    function index_get($id=null) {
        $data = null;
       
        if ($id==null) {
            $data = $this->User_model->get_all();
        }else{
        $data = $this->User_model->get_by_id($id);
         
        }
      
        $this->response($data, 200);
        
    }




    function index_post() {
        $data = [];

    if($this->post('user_group_id')!=null)
        $data['user_group_id'] = $this->post('user_group_id');
    if($this->post('user_username')!=null)
        $data['user_username'] = $this->post('user_username');
    if($this->post('user_password')!=null)
        $data['user_password'] = $this->post('user_password');
    if($this->post('user_nama')!=null)
        $data['user_nama'] = $this->post('user_nama');
    if($this->post('user_hak_akses')!=null)
        $data['user_hak_akses'] = $this->post('user_hak_akses');
    
        $insert = $this->db->insert('user', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }

    }

    //Update data
	function index_put() {
        $user_id = $this->put('user_id');
        $data = [];
        if($this->put('user_group_id')!=null)
            $data['user_group_id'] = $this->put('user_group_id');
        if($this->put('user_username')!=null)
            $data['user_username'] = $this->put('user_username');
        if($this->put('user_password')!=null)
            $data['user_password'] = $this->put('user_password');
        if($this->put('user_nama')!=null)
            $data['user_nama'] = $this->put('user_nama');
        if($this->put('user_hak_akses')!=null)
            $data['user_hak_akses'] = $this->put('user_hak_akses');
      
            $this->db->where('user_id', $user_id);
        $update = $this->db->update('user', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
	function index_delete() {
        $user_id = $this->delete('user_id');
        $data = [];
        $this->db->where('user_id', $user_id);
        $delete = $this->db->delete('user', $data);
        if ($delete) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
	//Hapus data

?>