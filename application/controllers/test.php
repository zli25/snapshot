<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$img_base='';

class Test extends CI_Controller 
{
	function sayhello()
	{
		echo 'Hello World!';
	}
	
	function addfield()
	{
		$this->load->model("test_model");
		$this->test_model->add_series_no();
	}
	
	/*function showurl()
	{
		$this->load->helper('url');
		echo base_url();
	}*/
	
	function ShowMarkedImg()
	{	
		$this->load->model("test_model");
		//$this->test_model->show_marked_img();

		
		
		$data['rows'] = $this->test_model->show_marked_img();
		$this->load->view("marked_images", $data);
		
	}
	
	function showimg()
	{
		$this->load->model("test_model");
		$data = $this->test_model->get_img();
		$img= array('img_base'=>$data[0], 'num_of_img'=>$data[1], 'answer'=>$data[2], 'is_marked'=>$data[3]);
		$this->load->view("test_view", $img);
		
	}
		
	function insert()
	{
		$this->load->model("test_model");
		$data = array("img_base"=>$_POST['Img_id'], "series_id"=>$_POST['Series_Id'], "X1"=>$_POST['X1'],"Y1"=>$_POST['Y1'],"X2"=>$_POST['X2'],"Y2"=>$_POST['Y2']);
		$this->test_model->insertdata($data);
	}
				
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */