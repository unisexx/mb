<?php
class Social extends Public_Controller
{
	public $apps = array('line', 'instagram', 'whatsapp');
	
	public function __construct()
	{
		parent::__construct();
		$this->template->set_layout('blank');
		ini_set('memory_limit', '-1');
	}
	
	public function index($social = 'line')
	{	 	
		$chk = empty($_GET['chk']) ? 7 : $_GET['chk'];
		$sql = "select u.id, u.image, count(j.id) as vote
		from users u
		join jams j on j.user_id = u.id
		where u.social_$social <> ''
		and j.created > NOW() - interval $chk day
		and u.image <> ''
		and u.status <> 'draft'
		and u.status <> 'hide'
		group by u.id, u.image
		order by vote desc, u.updated desc
		limit 20
		";
		$data['topfriend'] = $this->db->query($sql)->result();
		
		$data['social'] = $social;
        $data['apps'] = $this->apps;
        
		$sql = "select u.id, u.name, u.age, u.image, u.detail, u.sex_id, u.social_$social, u.game_cookierun, u.vote, provinces.name as province_name, sexs.title as sex_title, sexs.image as sex_image, sexs.color as sex_color
		from users u
		join sexs on sexs.id = u.sex_id
		join provinces on provinces.id = u.province_id
		where u.social_$social is not null 
		and u.social_$social <> ''
		and u.social_$social <> '-' 
		and u.name is not null
		and u.name <> ''  
		and u.status <> 'draft'
		and u.status <> 'hide'
		";
		if(@$_GET['sex_id']) $sql .= ' and u.sex_id = '.$_GET['sex_id'];
        if(@$_GET['province_id']) $sql .= ' and u.province_id = '.$_GET['province_id'];
        if(@$_GET['image']){(@$_GET['image'] == 'image') ? $sql .= ' and u.image != ""' : $sql .= ' and u.image is null';}
        if(@$app_id) $sql .= ' and ua.app_id = 1';
		$sql .= ' order by u.updated desc';
        $users = new User();
        $data['users'] = $users->sql_page($sql, 10);
		$data['pagination'] = $users->sql_pagination;
		
		/*
        $data['users']->distinct();
        if(@$_GET['sex_id'])$data['users']->where('sex_id',$_GET['sex_id']);
        if(@$_GET['province_id'])$data['users']->where('province_id',$_GET['province_id']);
        if(@$_GET['image']){(@$_GET['image'] == 'image')?$data['users']->where('image != ""'):$data['users']->where('image is null');}
        if(@$app_id)$data['users']->where_related_user_app('app_id',$app_id);
        $data['users']->where_related_user_app('social_data != ""');
        // $data['users']->where_related_user_app('status','approve');
        $data['users']->where('status != "draft"');
        $data['users']->order_by('updated','desc')->get_page(10);
		*/
        
		
		$this->template->build('index', $data);
	}

	public function view($social, $id = null)
	{
		$app = new App;
		$app->get_by_slug($social);
		$data['row'] = new User($id);
		if($data['row']->status == "draft"){
			redirect('http://www.addfriend.in.th/');
		}
		$data['social'] = $social;
		//$data['row']->where_related_user_app('app_id', $app->id);
		//$data['posts'] = new Post;
		//$data['posts']->where('user_id', $id)->order_by('id desc')->get();
        
        meta_description(strip_tags(str_replace($data['row']->detail, '"', '')));
		$this->template->build('view', $data);
	}

	public function timeline()
	{
		if(is_login()){
			$user_id = (empty($_GET['id'])) ? user_login()->id : $_GET['id'];
			$user = new User($user_id);
			
			$sex_id = null;
			switch($user->sex_id)
			{
				case 1: $sex_id = 2; break;
				case 2: $sex_id = 1; break;
				case 3: $sex_id = 4; break;
				case 4: $sex_id = 3; break;
				case 5: $sex_id = 5; break;
				case 6: $sex_id = 1; break;
			}
			$sql = "select users.id, users.name, users.age, users.sex_id, users.image, provinces.name as province_name, users.detail, posts.id as post_id, posts.title as post_title, posts.msg, posts.created,
			sexs.title as sex_title, sexs.image as sex_image, sexs.color as sex_color 
			from users
			join posts on posts.user_id = users.id
			join provinces on provinces.id = users.province_id
			join sexs on sexs.id = users.sex_id
			where users.age between $user->age - 5 and $user->age + 5
			and users.sex_id in ($sex_id)
			and users.status <> 'draft'
			order by posts.created desc";
			$post = new Post;
			$data['posts'] = $post->sql_page($sql, 10);
			$data['pagination'] = $post->sql_pagination;
			$this->template->build('timeline', $data);
		}
		else
		{
			redirect('line');
		}
	}
	
	function inc_form(){
		$data['apps'] = $this->apps;
		$this->load->view('inc_form',$data);
	}
	
	function save(){
        if($_POST){
        	$captcha = $this->session->userdata('captcha');
			if(($_POST['captcha'] == $captcha) && !empty($captcha)){
				
				$user = new User($this->session->userdata('id'));
				if(empty($user->id))
				{
					$u = new User;
					$u->get_by_email($_POST['email']);
					if($u->id) redirect('/');
				}
	            $_POST['ip'] = $_SERVER['REMOTE_ADDR'];
	            // $_POST['birth_date'] = Date2DB($_POST['birth_date']);
				$_POST['modified'] = date("Y-m-d H:i:s");
	            $_POST['status'] = 'active';
	            if($_FILES['image']['name'])
	            {
	            	@unlink('uploads/user/'.$user->image);
					@unlink('uploads/user/big/'.$user->image);
	                $user->image = $user->upload($_FILES['image'],'uploads/user/big', 400, 400, 'y');
					$user->thumb('uploads/user/', 120, 120);
	            }
	            
	            $user->from_array($_POST);
	            $user->save();
				
				/*
				if($_FILES['image']['name'] && is_file('uploads/user/big/'.$user->image))
				{
					$post = new Post;
					$post->user_id = $user->id;
					$post->title = 'Profile Photo updated!';
					$post->msg = '<div style="text-align: center"><img src="uploads/user/big/'.$user->image.'" class="img-responsive" /></div>';
					$post->save();
				}
				*/
				
				// social data
				/*
				foreach($_POST['app_id'] as $key=>$item){
					if($_POST['app_id'][$key] != ""){
						$user_app = new User_app(@$_POST['user_app_id'][$key]);
						$user_app->user_id = $user->id;
						$user_app->app_id = $item;
						$user_app->social_data = @$_POST['social_data'][$key];
						$user_app->save();	
					}
				}
				*/
	            set_notify('success', 'บันทึกข้อมูลเรียบร้อย');
			}else{
				set_notify('error','กรอกรหัสไม่ถูกต้อง');
				redirect($_SERVER['HTTP_REFERER']);
			}
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

	function update_profile(){
        if($_POST){
			$user = new User($this->session->userdata('id'));
			if(empty($user->id))
			{
				$u = new User;
				$u->get_by_email($_POST['email']);
				if($u->id) redirect('/');
			}
            $_POST['ip'] = $_SERVER['REMOTE_ADDR'];
			$_POST['modified'] = date("Y-m-d H:i:s");
            $_POST['status'] = empty($_POST['status']) ? 'hide' : 'active';
            if($_FILES['image']['name'])
            {
            	@unlink('uploads/user/'.$user->image);
				@unlink('uploads/user/big/'.$user->image);
                $user->image = $user->upload($_FILES['image'],'uploads/user/big', 400, 400, 'y');
				$user->thumb('uploads/user/', 120, 120);
            }
            $user->from_array($_POST);
            $user->save();
            set_notify('success', 'บันทึกข้อมูลเรียบร้อย');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
	
	function inc_topfriend(){
		//$data['users'] = new User();
        
        //$app_id = (@$_GET['app_id'] != "")?$_GET['app_id']:1;
        //$data['app'] = new App($app_id);
        
		/*
        $data['users1'] = new User();
        $data['users1']->distinct();
        if(@$_GET['sex_id'])$data['users1']->where('sex_id',$_GET['sex_id']);
        if(@$_GET['province_id'])$data['users1']->where('province_id',$_GET['province_id']);
        // if(@$_GET['image']){(@$_GET['image'] == 'image')?$data['users']->where('image != ""'):$data['users']->where('image is null');}
        if(@$app_id)$data['users1']->where_related_user_app('app_id',$app_id);
        $data['users1']->where_related_user_app('social_data != ""');
        // $data['users']->where_related_user_app('status','approve');
        $data['users1']->where('sex_id', 2)->where("image != ''")->order_by('updated','desc')->get_page(20);
        */
		// $data['users']->where('image !=', '')->where('sex_id', 2)->order_by('id','desc')->get(20);
		$sql = "select u.id, u.image, u.name, u.age, u.detail, u.sex_id, p.name as province, a.social_data, v.vote
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
            	$user = new User(user_login()->id);
				$user->last_login = date('Y-m-d H:i:s');
				$user->save();
                set_notify('success', 'ยินดีต้อนรับเข้าสู่ระบบค่ะ');
                redirect('social/profile');
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
            $data['apps'] = $this->apps;
            
            $data['user'] = new User($this->session->userdata('id'));
            $this->template->build('profile',$data);
        }else{
            redirect("social");
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
				
				$user = new User($_POST['user_id']);
				$user->vote = $user->jam->count();
				$user->save();
             }
             else
             {
				$jam->delete();
             }
			 
			 // update profile
			 //$user = new User($_POST['user_id']);
			 //$_POST['modified'] = date("Y-m-d H:i:s");
			 //$user->from_array($_POST);
	         //$user->save();
             
             //$counter = $jam3->where('user_id = '.$_POST['user_id'])->count();
             $user = new User($_POST['user_id']);
             // echo $user->vote;
			 $this->output->set_output($user->vote);
         }
     }

    function notice_save(){
        if($_POST && !empty($_POST['user_id'])){
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
	
	public function delete($id)
	{
		if(is_login() && user_login()->level_id == 1 && !empty($id))
		{
			$u = new User($id);
			@unlink('uploads/user/'.$u->image);
			@unlink('uploads/user/big/'.$u->image);
			$u->delete();
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function delete_img()
	{
		if($_POST && is_login() && user_login()->level_id == 1)
		{
			$u = new User($id);
			@unlink('uploads/user/'.$u->image);
			@unlink('uploads/user/big/'.$u->image);
			$u->image = '';
			$u->save();
		}
	}
	
	public function delete_all_img($id)
	{
		if($id && is_login() && user_login()->level_id == 1)
		{
			$user = new User($id);
			foreach($user->post as $post)
			{
				preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $post->msg, $fullpath);
				$img = basename($fullpath[1]);
				@unlink('uploads/user/'.$img);
				@unlink('uploads/user/big/'.$img);
				$post->delete();
			}
			$user->image = null;
			$user->save();
			redirect('line');
		}
	}
	
	public function total($id)
	{
		$data['result'] = $this->db->query("select count(id) as total from jams where user_id = $id group by user_id")->result();
		$this->load->view('total', $data);
	}
	
	function check_captcha()
	{
		if($this->session->userdata('captcha')==$_GET['captcha'])
		{
			$this->output->set_output("true");
		}
		else
		{
			$this->output->set_output("false");
		}
	}
	
	public function delete_draft()
	{
		if(is_login() && user_login()->level_id == 1)
		{
			$u = new User;
			$users = $u->where('status', 'draft')->get();
			foreach($users as $item)
			{
				@unlink('uploads/user/'.$item->image);
				@unlink('uploads/user/big/'.$item->image);
				$this->db->query('delete from users where id = '.$item->id);
			}
		}
	}
	
	public function delete_old()
	{
		if(is_login() && user_login()->level_id == 1)
		{
			//$users = $this->db->query("select image from users where year(created) = 2014 and  month(created) = 2 and day(created) = 27 and image <> ''");
			//$users = $this->db->query("select image from users where year(created) = 2013 and  month(created) = 2 and day(created) = 27 and image <> ''");
			$users = $this->db->query("select * from users where image <> '' and updated < NOW() - interval 20 day");
			foreach($users->result() as $item)
			{
				//echo img('uploads/user/big/'.$item->image).br();
				@unlink('uploads/user/'.$item->image);
				@unlink('uploads/user/big/'.$item->image);
				$this->db->query("update users set image = '' where id = $item->id");
				//$this->db->query('delete from users where id = '.$item->id);
			}
		}
	}

	public function game($game)
	{
		$social = 'line';
		$data['social'] = 'line';
		$data['game'] = $game;
		$sql = "select u.id, u.name, u.age, u.image, u.detail, u.sex_id, u.social_$social, u.game_cookierun, u.vote, provinces.name as province_name, sexs.title as sex_title, sexs.image as sex_image, sexs.color as sex_color
		from users u
		join sexs on sexs.id = u.sex_id
		join provinces on provinces.id = u.province_id
		where u.social_$social is not null 
		and u.social_$social <> ''
		and u.social_$social <> '-'
		and u.game_$game = 1 
		and u.name is not null
		and u.name <> ''  
		and u.status <> 'draft'
		and u.status <> 'hide'
		";
		if(@$_GET['sex_id']) $sql .= ' and u.sex_id = '.$_GET['sex_id'];
        if(@$_GET['province_id']) $sql .= ' and u.province_id = '.$_GET['province_id'];
        if(@$_GET['image']){(@$_GET['image'] == 'image') ? $sql .= ' and u.image != ""' : $sql .= ' and u.image is null';}
        if(@$app_id) $sql .= ' and ua.app_id = 1';
		$sql .= ' order by u.updated desc';
        $users = new User();
        $data['users'] = $users->sql_page($sql, 10);
		$data['pagination'] = $users->sql_pagination;
		$data['total'] = $users->sql_page_total;
		$this->template->build('game/list', $data);
	}
	
	public function join_game($game)
	{
		if(is_login())
		{
			$u = new User(user_login()->id);
			$u->{'game_'.$game} = 1;
			$u->save();
			set_notify('success', 'คุณได้เข้าร่วมกลุ่มแล้ว');
		}
		else
		{
			set_notify('error', 'คุณยังไม่ได้ Login');
		}
		redirect($game);
	}
	
	public function left_game($game)
	{
		if(is_login())
		{
			$u = new User(user_login()->id);
			$u->{'game_'.$game} = 0;
			$u->save();
			set_notify('success', 'คุณได้ออกจากกลุ่มแล้ว');
		}
		else
		{
			set_notify('error', 'คุณยังไม่ได้ Login');
		}
		redirect($game);
	}
	
	function sidebar(){
		$this->load->view('sidebar');
	}
}
