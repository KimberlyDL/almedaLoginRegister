<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class RegisterUserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->library('email');
    }
    public function send()
    {
        $this->email->sender('deleon.kimberlynicole.9@gmail.com', 'Kimberly Nicole');
        $this->email->recipient('1d3.de.leon.kimberly.nicole.i@example.com');

        $this->email->subject('Email Test');
        $this->email->email_content('Testing the email class.');

        $this->email->send();
        
        $this->call->view('user/success');
    }
}
?>