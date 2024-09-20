<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class UserController extends Controller
{
    private $notification;

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
}
?>