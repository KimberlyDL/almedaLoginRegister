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
        $data = $this->db->table('users')->limit(10)->get()->result();
        return $data;
    }

    public function getUsers()
    {
        return $this->db->table('users')->get_all();
    }

    public function insert($data)
    {
        $data = array(
            'last_name' => $data['lname'],
            'first_name'  => $data['fname'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'address' => $data['address']
        );

        $this->db->table('users')->insert($data);
    }

    public function getUser($id) {
        return $this->db->table('users')->where('id', $id)->get();
    }

    public function update($id, $data) 
    {
        return $this->db->table('users')->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->db->table('users')->where('id', $id)->delete();
    }

}