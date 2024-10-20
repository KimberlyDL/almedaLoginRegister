<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class AuthSessionController extends Controller
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
        $this->call->view('login');
    }

    public function auth()
    {
        $email = $this->io->post('email');
        $password = $this->io->post('password');

        // Fetch user by email
        $client = $this->Client->getUserByEmail($email);

        if ($client && password_verify($password, $client['knidl_password'])) {

            // Check if the account is unverified
            if ($client['knidl_token'] == "unverified") {
                $currentTime = date('Y-m-d H:i:s');

                // Check if OTP has expired
                if ($client['knidl_otp_expiry'] < $currentTime) {
                    // OTP has expired, regenerate a new OTP
                    $otp = $this->Client->regenerateOTP($client['id']);

                    $subject = "Your OTP for Email Verification - LavaLust 4";
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
                            <p>Dear {$client['knidl_name']},</p>
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

                    // Send the new OTP via email
                    $this->sendEmailVerification($email, $subject, $content);

                    // Set session data for verification
                    $this->session->set_userdata('user_id_for_verification', $client['id']);
                    // Show unverified view with a message
                    $this->call->view('verifyEmail');
                    return;

                } else {
                    // OTP is still valid, prompt user to enter OTP
                    $this->session->set_userdata('user_id_for_verification', $client['id']);
                    $this->call->view('verifyEmail');
                    return;
                }
            } else {
                $this->session->set_userdata('id', $client['id']);
                $this->session->set_userdata('name', $client['knidl_name']);
                $this->session->set_userdata('email', $client['knidl_email']);
                $data['email'] = $this->session->userdata('email');

                redirect('upload');
                //$this->call->view('home', $data);
                return;
            }
        }

        // If email or password is incorrect, redirect to login
        $data['error'] = 'Invalid log in';
        redirect('', $data);
        return;
    }

    public function sendEmailVerification($recepient_email, $subject, $content)
    {

        $this->email->sender('deleon.kimberlynicole.9@gmail.com', 'Lavalust');
        $this->email->recipient($recepient_email);
        $this->email->subject($subject);
        $this->email->email_content($content, "html");
        $this->email->send();
    }

}
?>