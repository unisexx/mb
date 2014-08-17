<?php
class Radios extends Public_Controller
{
		
	function __construct()
	{
		parent::__construct();
	}
		
	function index($id=false){
		$data['radio'] = new Radio($id);
		
		$data['radios'] = new Radio();
		$data['radios']->order_by('id','asc')->get();
		$this->template->build('index',$data);
	}
	
	function listen($id=false){
		$data['radio'] = new Radio($id);
		$this->template->build('listen',$data);
	}
	
}
?>