<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('login');
	}
	public function loadRegister()
	{
		//echo "asoidiosadaisjsaij";
		$this->load->view('register');
	}
	public function registerUser()
	{
		$name=$this->input->post('name')." ".$this->input->post('lastname');
		$email=$this->input->post('email');
		$password=sha1($this->input->post('password'));
		$query = $this->db->get_where('users', array('email' => $email));
		if($query->num_rows()>=1)
		{
			echo json_encode(array('result'=>'0'));
		}
		else{
			$data = array(
				'username' => $email,
				'name' => $name,
				'email' => $email,
				'password'=>$password
				);
			$this->db->insert('users',$data);			
			echo json_encode(array('result'=>'1'));
		}
	}

	public function loginUser()
	{
		$email=$this->input->post('email');
		$password=sha1($this->input->post('password'));
		$query=$this->db->get_where('users',array('email'=>$email,"password"=>$password));
		if($query->num_rows()>=1)
		{
			//open session
			
			
			$newdata = array(
				'name'  => $query->result_array()[0]['name'],
				'email'     => $query->result_array()[0]['email'],
				'type' => $query->result_array()[0]['type'],
				'logged_in' => TRUE
			);
		
			$this->session->set_userdata($newdata);
			if($query->result_array()[0]['type']=="NORMAL")
			echo json_encode(array('result'=>'1'));
			else if($query->result_array()[0]['type']=="ADMIN")
			{
				echo json_encode(array('result'=>'2'));
			}
			
		}
		else {
			echo json_encode(array('result'=>'0'));
		}
	}
}
