<?php
class Notices extends Admin_Controller {

    function __construct()
    {
        parent::__construct();
    }
    
    function index(){
        $data['notices'] = new Notice();
        $data['notices']->order_by('id','desc')->get_page();
        $this->template->build('admin/notice',$data);
    }
    
    function delete($id){
        $user_app = new User_app();
        $user_app->where('user_id', $id)->get();
        $user_app->delete_all();
        
        $jam = new Jam();
        $jam->where('user_id', $id)->get();
        $jam->delete_all();
        
        $notice = new Notice();
        $notice->where('user_id', $id)->get();
        $notice->delete_all();
        
        $user = new User($id);
        $user->delete();
        
        set_notify('success', lang('delete_data_complete'));
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    function hide($id){
        if($id){
            $notice = new Notice();
            $notice->where('user_id', $id)->get();
            $notice->delete_all();
        
            $user = new User($id);
            $_POST['status'] = "draft";
            $user->from_array($_POST);
            $user->save();
            set_notify('success', 'ซ่อนรายชื่อเรียบร้อย');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    function delete_notice($id){
        if($id){
            $notice = new Notice();
            $notice->where('user_id', $id)->get();
            $notice->delete_all();
            set_notify('success', 'ลบการแจ้งเตือน');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}
?>