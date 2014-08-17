<?php
Class Pages extends Public_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->template->set_layout('blank');
        }   
        
        function index(){
            $data['pages'] = new Page();
			$data['pages2'] = $data['pages']->get_clone();
            $data['pages'] = $this->db->query("select distinct category from pages where status = 'approve'")->result();
            $this->template->build('index',$data);
        }
        
        function view($id){
            $data['page'] = new Page($id);
			
			$this->template->title($data['page']->title.' - LINE2ME');
            meta_description(word_limiter(strip_tags($data['page']->detail),10));
			
            $this->template->build('view',$data);
        }
        
    }
?>