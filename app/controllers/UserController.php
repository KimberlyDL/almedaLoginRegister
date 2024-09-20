<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class UserController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->crud = lava_instance();
        $this->call->model('User_model');
        $this->call->library('Form_validation');
    }

    public function index()
    {
        $data['users'] = $this->User_model->getUsers();
        $this->call->view('index', $data);
    }

    public function create()
    {
        $this->call->view('user/create');
    }

    public function site()
    {
        echo site_url('error');
    }

    public function post()
    {
        if ($this->form_validation->submitted()) {
            $this->form_validation
                ->name('fname')
                ->required()
                ->min_length(2)
                ->max_length(30)
                ->name('lname')
                ->required()
                ->min_length(1)
                ->max_length(30)
                ->name('email')
                ->valid_email()
                ->name('gender')
                ->required()
                ->min_length(1)
                ->name('address')
                ->required()
                ->min_length(5)
                ->max_length(200);

            if ($this->form_validation->run()) {
                $data = array(
                    'lname' => $this->io->post['lname'],
                    'fname' => $this->io->post['fname'],
                    'email' => $this->io->post['email'],
                    'gender' => $this->io->post['gender'],
                    'address' => $this->io->post['address']
                );

                $this->User_model->insert($data);
                redirect('user/success');
            } else {
                $this->session->set_flashdata('errors', $this->form_validation->error());
                //echo $this->form_validation->error();
                redirect('user/create');
            }
        }
    }

    public function delete($data)
    {
        $this->User_model->delete($data);
        redirect('/success');
    }

    public function editset($id)
    {
        $data['users'] = $this->User_model->editset($id);
        $this->call->view("edit", $data);
    }
    public function edit()
    {
        if ($this->form_validation->submitted()) {
            $this->form_validation
                ->name('id')
                ->required()
                ->name('username')
                ->required()
                ->min_length(5)
                ->max_length(20)
                ->name('email')
                ->valid_email()
                ->name('password')
                ->required()
                ->min_length(5)
                ->name('repassword')
                ->matches('password')
                ->required()
                ->min_length(5);

            if ($this->form_validation->run()) {
                $id = $this->io->post('id');
                $username = $this->io->post('username');
                $email = $this->io->post('email');
                $password = md5($this->io->post('password'));

                $this->User_model->edit($id, $username, $email, $password);
                redirect('');

            } else {
                echo $this->form_validation->error();
            }
        }
    }

}
?>