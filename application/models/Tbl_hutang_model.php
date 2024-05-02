<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_hutang_model extends CI_Model
{

    public $table = 'tbl_hutang';
    public $id = 'ID';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    
    public function order($key,$direction='desc')
    {
        $this->db->order_by($key,$direction);
        return $this;
    }

    public function join($table_name,$condition,$type = null)
    {
        $this->db->join($table_name,$condition,$type);
        return $this;
    }

    public function select($key='*')
    {
        $this->db->select($key);
        return $this;
    }

    function get_where($where)
    {
        $this->db->where($where);
        return $this->db->get($this->table)->result();
    }

    function where($where)
    {
        $this->db->where($where);
        return $this;
    }

    public function get_row_where($where)
    {
        $this->db->from($this->table);
        $this->db->where($where);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get()->row();
    }

    public function limit($limit)
    {
        $this->db->limit($limit);
        return $this;
    }


    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('ID', $q);
		$this->db->or_like('NOTRANSAKSI', $q);
		$this->db->or_like('KODESPL', $q);
		$this->db->or_like('TGLBELI', $q);
		$this->db->or_like('TOTALHUTANG', $q);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('ID', $q);
		$this->db->or_like('NOTRANSAKSI', $q);
		$this->db->or_like('KODESPL', $q);
		$this->db->or_like('TGLBELI', $q);
		$this->db->or_like('TOTALHUTANG', $q);
		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

