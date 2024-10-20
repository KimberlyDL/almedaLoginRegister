<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class UserController extends Controller
{

    public function __construct()
    {
        parent::__construct();
				
        $this->call->model('User_model');
    }
    public function create()
    {
        $this->call->view('user/create');
    }
    public function index()
    {
        $data = $this->User_model->getUsers();
        $this->call->view('user/index',['users' => $data]);
    }

    public function store()
    {
        $data = array(
            'lname' => $_POST['lname'],
            'fname' => $_POST['fname'],
            'email' => $_POST['email'],
            'gender' => $_POST['gender'],
            'address' => $_POST['address']
        );
        $isUserAdded = $this->User_model->insert($data);

        $this->call->view('user/index', ['users' => $this->User_model->getUsers()]);
    }

    public function delete($data)
    {
        $this->User_model->delete($data);
        redirect('/');
    }

    public function edit($id)
    {
        $user['user'] = $this->User_model->getUser($id);
        $this->call->view('user/edit',$user);
    }

    public function show($id)
    {
        $user['user'] = $this->User_model->getUser($id);
        $this->call->view('user/show',$user);
    }

    public function patch($id)
    {
        $data = [
			'knidl_first_name' => $_POST['knidl_first_name'],
			'knidl_last_name' => $_POST['knidl_last_name'],
			'knidl_email' => $_POST['knidl_email'],
			'knidl_gender' => $_POST['knidl_gender'],
			'knidl_address' => $_POST['knidl_address'],
		];
	
		if ($this->User_model->update($id, $data)) {
			redirect('/'); 
		} 
    }
    public function uploadForm()
    {
        return $this->call->view('user/upload');
    }
    public function upload()
    {
        $this->call->library('upload', $_FILES["userfile"]);
        $this->upload
            ->set_dir('public')
            ->allowed_extensions(array('jpg'))
            ->allowed_mimes(array('image/jpeg'))
            ->is_image();
        if ($this->upload->do_upload()) {
            $data['filename'] = $this->upload->get_filename();
            $name = $this->io->post('name');
            $recepient_email = $this->io->post('email');
            $subject = $this->io->post('subject');
            $content = $this->io->post('content');
            $path = realpath(__DIR__ . '/../../public/' . $this->upload->get_filename());
            $this->sendAttatchedEmail($name, $recepient_email, $subject, $content, $path);
            $this->call->view('successUpload', $data);
        } else {
            $data['errors'] = $this->upload->get_errors();
            $this->call->view('user/upload', $data);
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('');
    }

    public function sendAttatchedEmail($name, $recepient_email, $subject, $content, $path)
    {

        $fullContent = "Hello, <br><br>This is a sample email.<br>These are the email's contents: <br>" . $content;
        $this->email->sender($this->session->userdata('email'), $name);
        $this->email->recipient($recepient_email);
        $this->email->subject($subject);
        $this->email->email_content($fullContent, 'html');
        $this->email->attachment($path);
        $this->email->send();
    }

}
?>