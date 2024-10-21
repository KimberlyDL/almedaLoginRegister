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
        $data = $this->db->table('loginreg')->limit(10)->get()->result();
        return $data;
    }

    public function getUsers()
    {
        return $this->db->table('loginreg')->get_all();
    }

    public function insert($data)
    {
        $data = array(
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'token' => 'unverified',
        );

        $this->db->table('loginreg')->insert($data);
    }

    public function getUser($id)
    {
        return $this->db->table('loginreg')->where('id', $id)->get();
    }

    public function getUserByEmail($email)
    {
        return $this->db->table('loginreg')->where('email', $email)->get();
    }

    public function update($id, $data)
    {
        return $this->db->table('loginreg')->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->db->table('loginreg')->where('id', $id)->delete();
    }

    public function generateOTP($userId)
    {
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiry = date('Y-m-d H:i:s', strtotime('+15 minutes'));
        $this->db->table('loginreg')->where('id', $userId)->update([
            'otp' => $otp,
            'otp_expiry' => $expiry
        ]);
        return $otp;
    }

    public function verifyOTP($userId, $otp)
    {
        $user = $this->db->table('loginreg')
            ->where('id', $userId)
            ->where('otp', $otp)
            ->get();  // Assuming get() returns an array directly

        if (!empty($user)) {
            $this->db->table('loginreg')
                ->where('id', $userId)
                ->update([
                    'token' => 'verified',
                    'otp' => null,
                    'otp_expiry' => null
                ]);
            return true;
        }

        return false;
    }

    public function regenerateOTP($userId)
    {
        // Clear the current OTP and expiration
        $this->db->table('loginreg')->where('id', $userId)->update([
            'otp' => null,
            'otp_expiry' => null
        ]);

        // Generate new OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiry = date('Y-m-d H:i:s', strtotime('+15 minutes'));

        // Update the new OTP and its expiry time
        $this->db->table('loginreg')->where('id', $userId)->update([
            'otp' => $otp,
            'otp_expiry' => $expiry,
            'token' => 'unverified' // Set status back to unverified
        ]);

        return $otp;
    }


}