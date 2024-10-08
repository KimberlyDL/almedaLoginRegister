<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class Client_model extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
    }

    public function get_last_ten_entries()
    {
        $data = $this->db->table('knidl_loginreg')->limit(10)->get()->result();
        return $data;
    }

    public function getUsers()
    {
        return $this->db->table('knidl_loginreg')->get_all();
    }

    public function insert($data)
    {
        $data = array(
            'knidl_name' => $data['name'],
            'knidl_email' => $data['email'],
            'knidl_password' => $data['password'],
            'knidl_token' => 'unverified',
        );

        $this->db->table('knidl_loginreg')->insert($data);
    }

    public function getUser($id)
    {
        return $this->db->table('knidl_loginreg')->where('id', $id)->get();
    }

    public function getUserByEmail($email)
    {
        return $this->db->table('knidl_loginreg')->where('knidl_email', $email)->get();
    }

    public function update($id, $data)
    {
        return $this->db->table('knidl_loginreg')->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->db->table('knidl_loginreg')->where('id', $id)->delete();
    }

    public function generateOTP($userId)
    {
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiry = date('Y-m-d H:i:s', strtotime('+15 minutes'));
        $this->db->table('knidl_loginreg')->where('id', $userId)->update([
            'knidl_otp' => $otp,
            'knidl_otp_expiry' => $expiry
        ]);
        return $otp;
    }

    public function verifyOTP($userId, $otp)
    {
        $user = $this->db->table('knidl_loginreg')
            ->where('id', $userId)
            ->where('knidl_otp', $otp)
            ->get();  // Assuming get() returns an array directly

        if (!empty($user)) {
            $this->db->table('knidl_loginreg')
                ->where('id', $userId)
                ->update([
                    'knidl_token' => 'verified',
                    'knidl_otp' => null,
                    'knidl_otp_expiry' => null
                ]);
            return true;
        }

        return false;
    }

    public function regenerateOTP($userId)
    {
        // Clear the current OTP and expiration
        $this->db->table('knidl_loginreg')->where('id', $userId)->update([
            'knidl_otp' => null,
            'knidl_otp_expiry' => null
        ]);

        // Generate new OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiry = date('Y-m-d H:i:s', strtotime('+15 minutes'));

        // Update the new OTP and its expiry time
        $this->db->table('knidl_loginreg')->where('id', $userId)->update([
            'knidl_otp' => $otp,
            'knidl_otp_expiry' => $expiry,
            'knidl_token' => 'unverified' // Set status back to unverified
        ]);

        return $otp;
    }


}