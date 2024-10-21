<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class RegisterUserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->helper('url');
        $this->call->library('session');
        $this->call->library('email');
        $this->call->model('Client_model', 'Client');
    }

    public function index()
    {
        $this->call->view('register');
    }

    public function post()
    {
        $name = $this->io->post('name');
        $email = $this->io->post('email');
        $password = $this->io->post('password');

        $data = array(
            "name" => $name,
            "email" => $email,
            "password" => password_hash($password, PASSWORD_DEFAULT),
        );
        $this->Client->insert($data);

        $client = $this->Client->getUserByEmail($email);

        if ($client) {

            $otp = $this->Client->generateOTP($client['id']);

            $subject = "Email Verification OTP - LavaLust 4";
            $content = "
                <html>
                <head>
                    <style>
                        body { font-family: Arial, sans-serif; }
                        .container { padding: 20px; }
                        .otp { font-size: 18px; font-weight: bold; color: #2c3e50; }
                        .signature { margin-top: 30px; }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <p>Dear {$client['name']},</p>
                        <p>We hope this message finds you well.</p>
                        <p>To complete your email verification, please use the following One-Time Password (OTP):</p>
                        <p class='otp'>{$otp}</p>
                        <p>This OTP is valid for the next 15 minutes. Please do not share this code with anyone.</p>
                        <p>If you did not request this verification, kindly disregard this message.</p>
                        <div class='signature'>
                            <p>Thank you for choosing LavaLust 4.</p>
                            <p>Warm regards,<br><strong>LavaLust Support Team</strong><br>Your Company Name<br>Company Address<br>Contact Information</p>
                        </div>
                    </div>
                </body>
                </html>
            ";

            $this->sendEmailVerification($client['email'], $subject, $content);
        
            $this->session->set_userdata('user_id_for_verification', $client['id']);
        
            // // Show unverified view
            // $data['email'] = $client['email'];
            $this->call->view('verifyEmail');
            return;
        }

    }


    public function otpVerification() {
        $this->call->view('verifyEmail');
        return;
    }

    public function verifyAccount()
    {
        $userId = $this->session->userdata('user_id_for_verification');
        $otp = $this->io->post('otp');

        if ($this->Client->verifyOTP($userId, $otp)) {
            $this->session->unset_userdata('user_id_for_verification');

            $data['success'] = 'Your account has been successfully created! You may now log in using your credentials.';
            $this->call->view('successmessage', $data);
        } else {
            $data['error'] = 'Invalid or expired OTP. Please try again.';

            $this->call->view('verifyEmail', $data);
            return;
        }
    }

    public function sendEmailVerification($recepient_email,$subject,$content)
    {
       
        $this->email->sender('ellierosealmeda@gmail.com', 'Lavalust');
        $this->email->recipient($recepient_email);
        $this->email->subject($subject);
        $this->email->email_content($content,"html");
        $this->email->send();
    }
}
?>