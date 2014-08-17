<?php
class Test extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
		// $this->template->set_theme('addfriend')->set_layout('index');
	}
	
	public function index($social = null)
	{
		$app_id = (@$_GET['app_id'] != "")?$_GET['app_id']:1;
		$sql = "select u.id, u.image, u.name, u.detail, u.sex_id, p.name as province, ap.placeholder, a.social_data, v.vote, s.title, s.color
		from users u
		join provinces p on p.id = u.province_id
		join user_apps a on a.user_id = u.id
		join apps ap on ap.id = a.app_id
		join sexs s on s.id = u.sex_id
		join ( select user_id, count(*) as vote from jams where created > NOW() - interval 7 day group by user_id order by vote desc ) v on v.user_id = u.id
		where a.app_id = $app_id
		and a.social_data != ''
		and u.image is not null
		and u.status != 'draft'
		order by v.vote desc
		limit 20";
		$data['topfriend'] = $this->db->query($sql)->result();
		
        $data['apps'] = new App();
        $data['apps']->where('status','approve')->order_by('orderlist','asc')->get();
        
        
        $data['app'] = new App($app_id);
        
        $data['users'] = new User();
        $data['users']->distinct();
        if(@$_GET['sex_id'])$data['users']->where('sex_id',$_GET['sex_id']);
        if(@$_GET['province_id'])$data['users']->where('province_id',$_GET['province_id']);
        if(@$_GET['image']){(@$_GET['image'] == 'image')?$data['users']->where('image != ""'):$data['users']->where('image is null');}
        if(@$app_id)$data['users']->where_related_user_app('app_id',$app_id);
        $data['users']->where_related_user_app('social_data != ""');
        // $data['users']->where_related_user_app('status','approve');
        $data['users']->where('status != "draft"');
        $data['users']->order_by('updated','desc')->get_page(10);
        
		
		$this->template->build('index', $data);
	}
	
	function inc_form(){
		$data['apps'] = new App();
		$data['apps']->where('status','approve')->order_by('orderlist','asc')->get();
		$this->load->view('inc_form',$data);
	}
	
	function save(){
        if($_POST){
            $user = new User($this->session->userdata('id'));
            $_POST['ip'] = $_SERVER['REMOTE_ADDR'];
            // $_POST['birth_date'] = Date2DB($_POST['birth_date']);
			$_POST['modified'] = date("Y-m-d H:i:s");
            $_POST['status'] = 'approve';
            if($_FILES['image']['name'])
            {
                $user->image = $user->upload($_FILES['image'],'uploads/user/big', 500, 500, 'x');
				$user->thumb('uploads/user/', 120, 120);
            }
            
            $user->from_array($_POST);
            $user->save();
			
			if($_FILES['image']['name'])
			{
				$post = new Post;
				$post->user_id = $user->id;
				$post->title = 'Profile Photo updated!';
				$post->msg = '<div style="text-align: center"><img src="uploads/user/big/'.$user->image.'" /></div>';
				$post->save();
			}
			
			// social data
			foreach($_POST['app_id'] as $key=>$item){
				if($_POST['app_id'][$key] != ""){
					$user_app = new User_app(@$_POST['user_app_id'][$key]);
					$user_app->user_id = $user->id;
					$user_app->app_id = $item;
					$user_app->social_data = @$_POST['social_data'][$key];
					$user_app->save();	
				}
			}
			
            set_notify('success', 'บันทึกข้อมูลเรียบร้อย');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
	
	function inc_topfriend(){
		$data['users'] = new User();
        
        $app_id = (@$_GET['app_id'] != "")?$_GET['app_id']:1;
        $data['app'] = new App($app_id);
        
        $data['users1'] = new User();
        $data['users1']->distinct();
        if(@$_GET['sex_id'])$data['users1']->where('sex_id',$_GET['sex_id']);
        if(@$_GET['province_id'])$data['users1']->where('province_id',$_GET['province_id']);
        // if(@$_GET['image']){(@$_GET['image'] == 'image')?$data['users']->where('image != ""'):$data['users']->where('image is null');}
        if(@$app_id)$data['users1']->where_related_user_app('app_id',$app_id);
        $data['users1']->where_related_user_app('social_data != ""');
        // $data['users']->where_related_user_app('status','approve');
        $data['users1']->where('sex_id', 2)->where("image != ''")->order_by('updated','desc')->get_page(20);
        
		// $data['users']->where('image !=', '')->where('sex_id', 2)->order_by('id','desc')->get(20);
		$sql = "select u.id, u.image, u.name, u.detail, u.sex_id, p.name as province, a.social_data, v.vote
		from users u
		join provinces p on p.id = u.province_id
		join user_apps a on a.user_id = u.id
		join ( select user_id, count(*) as vote from jams where created > NOW() - interval 30 day group by user_id order by vote desc limit 20) v on v.user_id = u.id
		where a.app_id = 1
		order by v.vote desc
		limit 20";
		$data['users1'] = $this->db->query($sql)->result();
		$this->load->view('inc_topfriend',$data);
	}
    
    function login()
    {
        if($_POST)
        {
            if(login($_POST['email'], $_POST['password']))
            {
                set_notify('success', 'ยินดีต้อนรับเข้าสู่ระบบค่ะ');
                redirect('test/profile');
            }
            else
            {
                set_notify('error', 'ชื่อผู้ใช้หรือรหัสผ่านผิดพลาดค่ะ');
                redirect($_SERVER['HTTP_REFERER']);
            }   
        }
        else
        {
            set_notify('error', 'กรุณาทำการล็อคอินค่ะ');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    
    function profile(){
        if(is_login()){
            $data['apps'] = new App();
            $data['apps']->where('status','approve')->order_by('orderlist','asc')->get();
            
            $data['user'] = new User($this->session->userdata('id'));
            $this->template->build('profile',$data);
        }else{
            redirect("test");
        }
    }
	
	function jam(){
         if($_POST){
             $jam = new Jam();
             $jam2 = $jam->get_clone();
             $jam3 = $jam->get_clone();
             
             $jam->where(array('user_id'=>$_POST['user_id'],'ip'=>$_SERVER['REMOTE_ADDR']))->get();
             if(!$jam->exists() or (is_login() and user_login()->level_id == 1))
             {
				$_POST['ip'] = $_SERVER['REMOTE_ADDR'];
				$jam2->from_array($_POST);
				$jam2->save();
             }
             else
             {
				$jam->delete();
             }
			 
			 // update profile
			 $user = new User($_POST['user_id']);
			 $_POST['modified'] = date("Y-m-d H:i:s");
			 $user->from_array($_POST);
	         $user->save();
             
             $counter = $jam3->where('user_id = '.$_POST['user_id'])->count();
             echo $counter;
         }
     }

    function notice_save(){
        if($_POST){
            $notice = new Notice();
            $_POST['ip'] = $_SERVER['REMOTE_ADDR'];
            $notice->from_array($_POST);
            $notice->save();
            set_notify('success', 'ส่งข้อมูลแจ้งลบเรียบร้อย');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    function hide($id){
        if($id){
            $user = new User($id);
            $_POST['status'] = "draft";
            $user->from_array($_POST);
            $user->save();
            set_notify('success', 'ซ่อนรายชื่อเรียบร้อย');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}
