<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomePage extends MY_Controller {

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
    public function __construct()
    {
		parent::__construct();
		// if($this->is_logged_in()){
		// 	$type=$_SESSION['type'];
		// 	$query=$this->db->get_where('nav',array('user_type'=>$type));
		// 	$data=$query->result_array();
		// 	$this->load->view('blank',array('data'=>$data));
		// }
		
		// else $this->load->view('login');

    }


	public function index()
	{
		
		if($this->is_logged_in()){
			$type=$_SESSION['type'];
			$query=$this->db->get_where('nav',array('user_type'=>$type));
			$data=$query->result_array();
			var_dump($type);
			//die();
			if($type=="NORMAL")
			$this->load->view('purchase',array('data'=>$data));
			else $this->load->view('blank',array('data'=>$data));
		}
		
		else $this->load->view('login');
//		header('Location: '.base_url().'index.php/Welcome' );
	}
	public function logout()
	{
		if(isset($_SESSION))
		{
			session_destroy();
		}
		$this->load->view('login');
	}
	public function loadPurchase()
	{	
		$this->load->view('purchase',$this->getData());
	}
	public function loadTopup()
	{
		
		$this->load->view('topup',$this->getData());
	}

	public function loadHistory()
	{
		$this->load->view('history',$this->getData());
	}
	public function loadHistory2()
	{
		$this->load->view('history2',$this->getData());
	}

	public function getData()
	{

		if($this->is_logged_in()){
			$type=$_SESSION['type'];
			$query=$this->db->get_where('nav',array('user_type'=>$type));
			$data=$query->result_array();
			return array('data'=>$data);
		}
		
		else $this->load->view('login');		
	}
	public function addBalance()
	{
		$amount=$this->input->post('amount');
		$query=$this->db->get_where('users',array('email'=>$_SESSION['email']))->result_array()[0];
		$currentBalance=$query['balance'];
//		var_dump($this->db->last_query());
//		var_dump($currentBalance);
//		var_dump($_SESSION['email']);
//		die();
		$currentBalance+=$amount;
		$data=array('balance'=>$currentBalance);
		
		if($this->db->update('users', $data, array('email' => $_SESSION['email']))){

			$uid=$query['id'];

			$data=array(
				'uid'=>$uid,
				'type'=>'DEPOSIT',
				'amount'=>$amount,
				'date'=>date("Y-m-d h:i:sa")
			);
			$this->db->insert('transaction_history',$data);
			
			echo json_encode(array('result'=>'1'));

		}
		else{
			echo json_encode(array('result'=>'0'));
		}
	}
	public function purchaseProduct()
	{
		//echo 'in p';
		//var_dump($this->input->post());
		$query=$this->db->get_where('users',array('email'=>$_SESSION['email']))->result_array()[0];
		$oldAmount=0;
		$uid=$query['id'];
		$q=$this->db->get_where('products',array('id'=>$this->input->post('id')))->result_array()[0];
		$amount=$q['price'];
		$disc=0;
		if($amount>=112 && $amount<=115)
		{
		  $disc=0.25/100;
		}
		if($amount>120)
		{
		  $disc=0.5/100;
		}
		if($disc!=0)
		{
			$amount=$amount-($amount*$disc);
		}

		$balance=$query['balance'];
		if($balance<$amount)
		{			
			echo json_encode(array('result'=>'0'));
			die();
		}

		//var_dump($amount);die();;

		$data=array(
			'uid'=>$uid,
			'type'=>'PURCHASE',
			'amount'=>$amount,
			'date'=>date("Y-m-d h:i:sa"),
			'pid'=>$this->input->post('id')
		);
		$this->db->insert('transaction_history',$data);



		$oldAmount=$query['balance'];
//		var_dump($oldAmount);
		$oldAmount=$oldAmount-$amount;
//		var_dump($oldAmount);

		$data=array('balance'=>$oldAmount);		
		$this->db->update('users', $data, array('email' => $_SESSION['email']));
		echo json_encode(array('result'=>'1','balance'=>$oldAmount) );
	}
	public function getPurchaseHistory()
	{
		$query=$this->db->get_where('users',array('email'=>$_SESSION['email']))->result_array()[0];
		$uid=$query['id'];

		$d=$this->db->get_where('transaction_history',array('uid'=>$uid,"type"=>"PURCHASE"));
		echo json_encode($d->result());


	}

}
