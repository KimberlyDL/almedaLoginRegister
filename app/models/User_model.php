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

    public function update()
    {
        $bind = array(
            'knidl_last_name' => $this->io->post['lname'],
            'knidl_first_name'  => $this->io->post['fname'],
            'knidl_email' => $this->io->post['email'],
            'knidl_gender' => $this->io->post['gender'],
            'knidl_address' => $this->io->post['address'],
        );

        $this->db->table('knidl_users')->where('id', $this->io->post('id'))->update($bind);
    }

    public function delete()
    {
        $this->db->table('table')->where('id', $this->io->post('id'))->delete();
    }


}