<?php
class Friends extends Admin_Controller {

    function __construct()
    {
        parent::__construct();
    }
    
    function index(){
        $data['friends'] = new Friend();
        if(@$_GET['search'])$data['friends']->where("line_id like '%".$_GET['search']."%'");
        $data['friends']->order_by('id','desc')->get_page();
        $this->template->append_metadata(js_checkbox('approve'));
        $this->template->build('admin/index',$data);
    }
    
    function delete($id){
        $friend = new Friend($id);
        $friend->delete();
        set_notify('success', lang('delete_data_complete'));
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    function approve($id)
    {
        if($_POST)
        {
            $friend = new Friend($id);
            $friend->from_array($_POST);
            $friend->save();
        }
    }
}
?>