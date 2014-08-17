<?php
class Friends extends Public_Controller {

    function __construct()
    {
        parent::__construct();
    }
    
    function index(){
        $data['friends'] = new Friend();
        if(@$_GET['sex_id'])$data['friends']->where('sex_id',$_GET['sex_id']);
        if(@$_GET['province_id'])$data['friends']->where('province_id',$_GET['province_id']);
        if(@$_GET['image']){
            (@$_GET['image'] == 'image')?$data['friends']->where('image != ""'):$data['friends']->where('image is null');
        }
		$data['friends']->where("status = 'approve'")->order_by('id','desc')->get_page(10);
        $this->template->build('index',$data);
    }
    
    // function inc_home(){
        // $data['friends'] = new Friend();
        // if(@$_GET['sex_id'])$data['friends']->where('sex_id',$_GET['sex_id']);
        // if(@$_GET['province_id'])$data['friends']->where('province_id',$_GET['province_id']);
        // if(@$_GET['image']){
            // (@$_GET['image'] == 'image')?$data['friends']->where('image != ""'):$data['friends']->where('image is null');
        // }
        // $data['friends']->where("status = 'approve'")->order_by('id','desc')->get_page(10);
        // $this->load->view('inc_home',$data);
    // }
    
    function inc_home(){
        $app_id = (@$_GET['app_id'] != "")?$_GET['app_id']:1;
        $data['app'] = new app($app_id);
        
        $data['users'] = new User();
        $data['users']->distinct();
        if(@$_GET['sex_id'])$data['users']->where('sex_id',$_GET['sex_id']);
        if(@$_GET['province_id'])$data['users']->where('province_id',$_GET['province_id']);
        if(@$_GET['image']){(@$_GET['image'] == 'image')?$data['users']->where('image != ""'):$data['users']->where('image is null');}
        if(@$app_id)$data['users']->where_related_user_app('app_id',$app_id);
        $data['users']->where_related_user_app('social_data != ""');
        $data['users']->where_related_user_app('status','approve');
        $data['users']->where("status = 'approve'")->order_by('updated','desc')->get_page(10);
        // $data['users']->check_last_query();
        $this->load->view('inc_home',$data);
    }
    
    function form(){
        $this->template->build('form');
    }
    
    function save(){
        if($_POST)
        {
            $captcha = $this->session->userdata('captcha');
            if(($_POST['captcha'] == $captcha) && !empty($captcha)){
                $friend = new Friend();
				
				$friend_old_data = $friend->get_clone();
				$friend_old_data->where("line_id = '".$_POST['line_id']."'")->update('status', 'draft');
				
                $_POST['status'] = 'approve';
				$_POST['ip'] = $_SERVER['REMOTE_ADDR'];
                if($_FILES['image']['name'])
                {
                    $friend->image = $friend->upload($_FILES['image'],'uploads/friend/',90,90);
                }
                $friend->from_array($_POST);
                $friend->save();
                set_notify('success', lang('save_data_complete'));
            }else{
                set_notify('error','กรอกรหัสไม่ถูกต้อง');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
        redirect('home');
    }
}
?>