<?php
defined('BASEPATH') or exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;



set_time_limit(0);
date_default_timezone_set('Asia/Jakarta');
setlocale(LC_TIME, 'id_ID');

class IPcamera extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Camera_model');
       
    }

    //Menampilkan data


    function index_get($id = null)
    {
        $data = null;

        if ($id == null) {
            $data = $this->db->query("SELECT * FROM camera order by id desc ")->result();
        } else {
            $data = $this->db->query("SELECT * FROM camera where camera_id = $id  order by id desc ")->result();
        } 

        $this->response($data, 200);
    }



    function camera_get($id = null)
    {
        $id = $this->get('id');
        $data = null;

        if ($id == null) {
            $data = $this->db->query("SELECT * FROM camera order by id desc ")->result();
        } else {
            $data = $this->db->query("SELECT * FROM camera where id = $id  order by id desc ")->result();
        } 

        $this->response($data, 200);
    }

    function streamers_get($id = null)
    {
        $id = $this->get('id');
        $data = null;

        if ($id == null) {
            $data = $this->db->query("SELECT * FROM stremers order by id desc ")->result();
        } else {
            $data = $this->db->query("SELECT * FROM stremers where id = $id  order by id desc ")->result();
        } 

        $this->response($data, 200);
    }



    
  
    public function record_insert_get()
    {
        if ($this->get('camera_id') != null)
        $data['camera_id'] = $this->get('camera_id');

        if ($this->get('file_url') != null)
        $data['file_url'] = $this->get('file_url');

        if ($this->get('duration_sec') != null)
        $data['duration_sec'] = $this->get('duration_sec');
    
        if ($this->get('timestamp') != null)
        $data['timestamp'] = date('Y-m-d H:i');

        $insert = $this->db->insert('records', $data);
        $data['status'] = 'Ok';

        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    
    }

    function index_post()
    {

        $data = [];

        if ($this->post('id_presensce') != null)
            $data['id_presensce'] = $this->post('id_pr esensce');

        if ($this->post('Kaki_Simpang') != null)
            $data['Kaki_Simpang'] = $this->post('Kaki_Simpang');

        if ($this->post('Counting') != null)
            $data['Counting'] = $this->post('Counting');

        if ($this->post('serial') != null)
            $data['serial'] = $this->post('serial');

        $insert = $this->db->insert('Presence_detector', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Update data
    function index_put()
    {

    $id_presensce = $this->put('id_presensce');
    $data = [];

    if($this->put('Kaki_Simpang')!=null)
        $data['Kaki_Simpang'] = $this->put('Kaki_Simpang');
    if($this->put('Counting')!=null)
        $data['Counting'] = $this->put('Counting');
 
    if($this->put('serial')!=null)
        $data['serial'] = $this->put('serial');
      
        $this->db->where('id_presensce', $id_presensce);
        $update = $this->db->update('Presence_detector', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Hapus data
    function index_delete()
    {
        $id_presensce = $this->delete('id_presensce');
        $data = [];
        $this->db->where('id_presensce', $id_presensce);
        $delete = $this->db->delete('Presence_detector', $data);
        if ($delete) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    

}


