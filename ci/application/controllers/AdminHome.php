<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminHome extends MY_Controller {

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
			else $this->load->view('products',array('data'=>$data));
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
	public function loadProducts()
	{	
		$this->load->view('products',$this->getData());
	}
	public function loadDiscounts()
	{
		$this->load->view('discounts',$this->getData());
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

	function generateProductCode($length = 6) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		while($this->db->get_where('products',array('code'=>$randomString))->num_rows()>0)
		{
			$randomString=generateProductCode($length = 6) ;
		}

		//return $randomString;
		echo json_encode(array('result'=>$randomString));
	}
	

	public function uploadFile()
	{
		//print_r($_FILES);
		try {
			if (
				!isset($_FILES['file']['error']) ||
				is_array($_FILES['file']['error'])
			) {
				throw new RuntimeException('Invalid parameters.');
			}
		
			switch ($_FILES['file']['error']) {
				case UPLOAD_ERR_OK:
					break;
				case UPLOAD_ERR_NO_FILE:
					throw new RuntimeException('No file sent.');
				case UPLOAD_ERR_INI_SIZE:
				case UPLOAD_ERR_FORM_SIZE:
					throw new RuntimeException('Exceeded filesize limit.');
				default:
					throw new RuntimeException('Unknown errors.');
			}
		
			//$filepath = sprintf('files/%s_%s', uniqid(), $_FILES['file']['name']);
		//	echo $_FILES['file']['tmp_name'];
			//print_r($_FILES);
			
			
			$filepath=sprintf('assets/images/products/%s_%s',uniqid(),$_FILES['file']['name']);
			$filename=explode('/',$filepath)[sizeof(explode('/',$filepath))-1];
			
			$info = getimagesize($_FILES['file']['tmp_name']);
			if (!move_uploaded_file($_FILES['file']['tmp_name'],$filepath) || $info === FALSE || ($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) {
				throw new RuntimeException('Failed to move uploaded file.');
			}
		
			// All good, send the response
			//echo base_url().'assets/images/email/'.$filename;
			echo json_encode([
				//'status' => 'ok',
				'location' => base_url().'assets/images/products/'.$filename
			]);
				
			// $con=mysqli_connect("localhost","root","","tailor");
			// if (mysqli_connect_errno())
			// {
			// 	echo "Failed to connect to MySQL: " . mysqli_connect_error();
			// }			
			// $sql="INSERT INTO `gallery`( `file_name`) VALUES ('$filepath')";
			// //echo $sql;
			// mysqli_query($con,$sql);
			// mysqli_close($con);

		} catch (RuntimeException $e) {
			// Something went wrong, send the err message as JSON
			http_response_code(400);
		
			echo json_encode([
				'status' => 'error',
				'message' => $e->getMessage()
			]);
		}
	}

	public function insertProduct()
	{
		//var_dump($this->input->post());
		$disc=0.0;
		$price=$this->input->post('price');

		if($price>=112 && $price<=115)
		{
		  $disc=0.25/100;
		}
		if($price>120)
		{
		  $disc=0.5/100;
		}
		$data=array(
			'name'=>$this->input->post('name'),
			'price'=>$this->input->post('price'),
			'description'=>$this->input->post('description'),
			'code'=>$this->input->post('code'),
			'image'=>$this->input->post('image'),
			'discount'=>$disc
		);
		$res=$this->db->insert('products',$data);
		echo json_encode(array('result'=>$res));
	}
	public function addDiscount()
	{
	//	die();
		$pid=$this->input->post('id');
		$data=array('discount'=>$this->input->post('percent')/100);

		//$this->db->update('products', $data, array('id' => $pid))
		$this->db->update('products',$data,array('id'=>$pid));
		echo json_encode(array('result'=>1));
		
	}

}
