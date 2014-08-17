<?php
class Test extends Admin_Controller {

    function __construct()
    {
        parent::__construct();
    }
    
    function index(){
        $data['users'] = new User();
        if(@$_GET['search'])$data['users']->where("line_id like '%".$_GET['search']."%'");
        $data['users']->order_by('id','desc')->get_page();
        $this->template->append_metadata(js_checkbox('approve'));
        $this->template->build('admin/index',$data);
    }
    
    function delete($id){
        $user = new User($id);
        $user->delete();
        
        $user_app = new User_app();
        $user_app->where('user_id', $id)->get();
        $user_app->delete_all();
        
        $jam = new Jam();
        $jam->where('user_id', $id)->get();
        $jam->delete_all();
        
        set_notify('success', lang('delete_data_complete'));
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    function approve($id)
    {
        if($_POST)
        {
            $user = new User($id);
            $user->from_array($_POST);
            $user->save();
        }
    }
}
?>