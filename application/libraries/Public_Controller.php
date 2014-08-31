<?php
class Public_Controller extends Master_Controller
{
	function __construct()
	{
		parent::__construct();
		
		header('Content-type: text/html; charset=UTF-8');
		$this->template->title('หาเพื่อน หาแฟน หากิ๊ก หาคู่ หาเพื่อนเล่นเกม แลกไอดีไลน์ - LINE2ME');
        
    	$this->template->set_theme('mb')->set_layout('home');
		
		// Set js
		$this->lang->load('admin');
		// $this->template->append_metadata(js_notify());
		// $this->template->append_metadata(js_lightbox());
		
		// Set Keywords , Description
		meta_description();
		$this->template->append_metadata( meta('keywords','โสด,เหงา,LINE,instagram,facebook,whatsapp,BBM,Sticker,Sticker LINE,สติ๊กเกอร์,ไลน์,Gift,ขายสติ๊กเกอร์ไลน์,ฝากซื้อสติ๊กเกอร์ไลน์,ไอดีไลน์ ratasak,สติ๊กเกอร์ไลน์ราคาถูก,หาเพื่อน,หาแฟน,หากิ๊ก,หาคู่,แลกไอดีไลน์,หาเพื่อนไลน์,หาเพื่อน LINE,หาเพื่อน instagram,หาเพื่อน facebook,หาเพื่อน whatsapp,หาเพื่อน BBM,หาเพื่อนชาย,หาเพื่อนหญิง,หาเพื่อนเกย์,หาเพื่อนทอม,หาเพื่อนดี้,หาเพื่อนสาวประเภทสอง,หาเพื่อนหน้าตาดี,หาเพื่อนเล่นเกม,คุ้กกี้รัน,cookie run'));
        
        //$this->output->cache(5);
	}
}
?>