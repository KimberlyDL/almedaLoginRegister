<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_model extends Model {
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
    }

	public function get_last_ten_entries()
    {
        $data = $this->db->table('knidl_users')->limit(10)->get()->result();
        return $data;
    }

    public function getUsers()
    {
        return $this->db->table('knidl_users')->get_all();
    }

    public function insert($data)
    {
        $data = array(
            'knidl_last_name' => $data['lname'],
            'knidl_first_name'  => $data['fname'],
            'knidl_email' => $data['email'],
            'knidl_gender' => $data['gender'],
            'knidl_address' => $data['address']
        );

        $this->db->table('knidl_users')->insert($data);
    }

    public function getUser($id) {
        return $this->db->table('knidl_users')->where('id', $id)->get();
    }

    public function update($id, $data) 
    {
        return $this->db->table('knidl_users')->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->db->table('knidl_users')->where('id', $id)->delete();
    }

}