<?php
class Stickers extends Public_Controller {

    function __construct()
    {
        parent::__construct();
		ini_set('memory_limit', '-1');
    }
    
	function inc_home(){
		$data['stickers_update'] = new Sticker();
        $data['stickers_update']->where('sticker_code < 1000000 and status = "approve"')->order_by('id desc')->get(5);
        // $data['stickers_update']->where('status = "approve"')->order_by("id", "random")->get(6);
		// $data['stickers_update']->where('status = "approve"')->order_by("updated", "desc")->get(6);
		$this->load->view('inc_home',$data);
	}
	
    function index(){
    	$this->template->set_theme('line')->set_layout('home');
		
		// $sql = "select t.id, t.cover, t.title, t.slug, t.created, count(v.id) as vote
				// from themes t
				// join sticker_views v on v.sticker_id = t.id
				// where t.status <> 'draft'
				// and v.type = 'theme'
				// group by t.id, t.cover, t.title, t.slug, t.created
				// order by vote desc, t.updated desc
				// limit 6";
		// $data['themes'] = $this->db->query($sql)->result();
        $data['themes'] = new Theme();
        $data['themes']->where('status = "approve"')->order_by('id','desc')->get(6);
        
    	$data['stickers_update'] = new Sticker();
        $data['stickers_update']->where('sticker_code < 1000000 and status = "approve"')->order_by('id','desc')->get(5);
		
		$data['stickers_promote'] = new Sticker();
		$data['stickers_promote']->where("start_date <= date(sysdate()) and (end_date >= date(sysdate()) or end_date = date('0000-00-00')) and status = 'approve'")->order_by("id", "random")->get(6);
		
		// สติกเกอร์ไลน์ต่างประเทศ
		$sql = "select s.id, s.cover, s.title, s.slug, s.category, s.sticker_code, s.created, count(v.id) as vote
				from stickers s
				join sticker_views v on v.sticker_id = s.id
				where s.category <> 'global'
				and s.status <> 'draft'
				and s.sticker_code < 1000000
				group by s.id, s.cover, s.title, s.slug, s.category, s.sticker_code, s.created
				order by vote desc, s.updated desc
				limit 6";
		$data['stickers_japan'] = $this->db->query($sql)->result();
        // $data['stickers_japan'] = new Sticker();
        // $data['stickers_japan']->where('sticker_code < 1000000 and category <> "global" and status = "approve"')->order_by('threedays','desc')->get(6);
        
        
        $sql = "select s.id, s.cover, s.title, s.slug, s.category, s.sticker_code, s.created, count(v.id) as vote
				from stickers s
				join sticker_views v on v.sticker_id = s.id
				where s.category = 'global'
				and s.status <> 'draft'
				and s.sticker_code < 1000000
				group by s.id, s.cover, s.title, s.slug, s.category, s.sticker_code, s.created
				order by vote desc, s.updated desc
				limit 6";
		$data['stickers_global'] = $this->db->query($sql)->result();
        // $data['stickers_global'] = new Sticker();
        // $data['stickers_global']->where('sticker_code < 1000000 and category = "global" and status = "approve"')->order_by('threedays','desc')->get(6);
		
		
		$sql = "select s.id, s.cover, s.title, s.slug, s.category, s.sticker_code, s.created, count(v.id) as vote
				from stickers s
				join sticker_views v on v.sticker_id = s.id
				where s.status <> 'draft'
				and s.sticker_code > 999999
				group by s.id, s.cover, s.title, s.slug, s.category, s.sticker_code, s.created
				order by vote desc, s.updated desc
				limit 6";
		$data['creators'] = $this->db->query($sql)->result();
		// $data['creators'] = new Sticker();
		// $data['creators']->where('sticker_code > 999999 and status = "approve"')->order_by('threedays','desc')->get(6);
		
        $this->template->title('บริการรับฝากซื้อสติ๊กเกอร์ไลน์ ของแท้ ไม่มีหาย เชื่อถือได้ 100% ติดต่อไอดีไลน์ ratasak - line2me.in.th');
        meta_description("อัพเดทสติ๊กเกอร์ไลน์ใหม่ๆกว่า 1,000 ลาย ของแท้ ถูกลิขสิทธิ์ ไม่มีหาย เชื่อถือได้ 100% ติดต่อไอดีไลน์ ratasak");
        $this->template->build('index',$data);
		
		// $this->output->cache(10080);
    }
    
	function all(){
		$this->template->set_theme('line')->set_layout('layout');
		$sticker = new Sticker();
        $sticker->where('status = "approve"');
		if(@$_GET['title']){ $sticker->where("title LIKE '%".$_GET['title']."%'"); }
		if($_GET['sort'] == 'new'){ // มาใหม่
			$sticker->order_by('id','desc');
		}elseif($_GET['sort'] == 'hot'){ // ยอดนิยม
			$sticker->order_by('threedays','desc');
		}elseif($_GET['sort'] == 'rand'){ // สุ่ม
			$sticker->order_by('id','random');
		}
		$data['stickers_global'] = $sticker->get_page($_GET['n']);
		$this->template->build('all',$data);
	}

	function thai(){
		$this->template->set_theme('line')->set_layout('layout');
		
		// if($_GET['sort'] != 'hot'){
			
			$data['stickers_global'] = new Sticker();
	        $data['stickers_global']->where('sticker_code < 1000000 and category = "global" and status = "approve"');
			if($_GET['sort'] == 'new'){ // มาใหม่
				$data['stickers_global']->order_by('id','desc');
			}elseif($_GET['sort'] == 'hot'){ // ยอดนิยม
				$data['stickers_global']->order_by('threedays','desc');
			}elseif($_GET['sort'] == 'rand'){ // สุ่ม
				$data['stickers_global']->order_by('id','random');
			}
			$data['stickers_global']->get_page($_GET['n']);
		
		// }else{
// 				
			// $sql = "select s.id, s.cover, s.title, s.slug, s.category, s.sticker_code, s.created, count(v.id) as vote
				// from stickers s
				// join sticker_views v on v.sticker_id = s.id
				// where s.category = 'global'
				// and s.status <> 'draft'
				// and s.sticker_code < 1000000
				// group by s.id, s.cover, s.title, s.slug, s.category, s.sticker_code, s.created
				// order by vote desc, s.updated desc";
			// $data['stickers_global'] = $this->db->query($sql)->result();
			// $stickers = new Sticker();
	        // $data['stickers_global'] = $stickers->sql_page($sql, $_GET['n']);
			// $data['pagination'] = $stickers->sql_pagination;
			// // echo $sql;
		// }
		
		$this->template->build('global',$data);
	}

	function oversea(){
		$this->template->set_theme('line')->set_layout('layout');
		
		// if($_GET['sort'] != 'hot'){
			
			$data['stickers_japan'] = new Sticker();
	        $data['stickers_japan']->where('sticker_code < 1000000 and category <> "global" and status = "approve"');
	        if($_GET['sort'] == 'new'){ // มาใหม่
				$data['stickers_japan']->order_by('id','desc');
			}elseif($_GET['sort'] == 'hot'){ // ยอดนิยม
				$data['stickers_japan']->order_by('threedays','desc');
			}elseif($_GET['sort'] == 'rand'){ // สุ่ม
				$data['stickers_japan']->order_by('id','random');
			}
			$data['stickers_japan']->get_page($_GET['n']);
			
		// }else{
// 				
			// $sql = "select s.id, s.cover, s.title, s.slug, s.category, s.sticker_code, s.created, count(v.id) as vote
				// from stickers s
				// join sticker_views v on v.sticker_id = s.id
				// where s.category <> 'global'
				// and s.status <> 'draft'
				// and s.sticker_code < 1000000
				// group by s.id, s.cover, s.title, s.slug, s.category, s.sticker_code, s.created
				// order by vote desc, s.updated desc";
			// $data['stickers_japan'] = $this->db->query($sql)->result();
			// $stickers = new Sticker();
	        // $data['stickers_japan'] = $stickers->sql_page($sql, $_GET['n']);
			// $data['pagination'] = $stickers->sql_pagination;
// 			
		// }

		$this->template->build('oversea',$data);
	}

	function creator(){
		$this->template->set_theme('line')->set_layout('layout');
		
		if($_GET['sort'] != 'hot'){
			
			$data['creators'] = new Sticker();
			$data['creators']->where('sticker_code > 999999 and status = "approve"');
			if($_GET['sort'] == 'new'){ // มาใหม่
				$data['creators']->order_by('id','desc');
			}elseif($_GET['sort'] == 'hot'){ // ยอดนิยม
				$data['creators']->order_by('threedays','desc');
			}elseif($_GET['sort'] == 'rand'){ // สุ่ม
				$data['creators']->order_by('id','random');
			}
			$data['creators']->get_page($_GET['n']);
			
			// $data['creators']->check_last_query();
		}else{
				
			$sql = "select s.id, s.cover, s.title, s.slug, s.category, s.sticker_code, s.created, count(v.id) as vote
				from stickers s
				join sticker_views v on v.sticker_id = s.id
				where s.status <> 'draft'
				and s.sticker_code > 999999
				group by s.id, s.cover, s.title, s.slug, s.category, s.sticker_code, s.created
				order by vote desc, s.updated desc";
			$data['creators'] = $this->db->query($sql)->result();
			$stickers = new Sticker();
	        $data['creators'] = $stickers->sql_page($sql, $_GET['n']);
			$data['pagination'] = $stickers->sql_pagination;
			
		}
			
		$this->template->build('creator',$data);
	}
	
	function v1(){
		$this->template->set_theme('line')->set_layout('layout');
        $data['themes'] = new Theme();
        $data['themes']->where('status = "approve"')->order_by('id','desc')->get();
        
    	$data['stickers_update'] = new Sticker();
        $data['stickers_update']->where('sticker_code < 1000000 and status = "approve"')->order_by('id','desc')->get();
		
        $data['stickers_japan'] = new Sticker();
        $data['stickers_japan']->where('sticker_code < 1000000 and category <> "global" and status = "approve"')->order_by('sticker_code','desc')->get();
        
        $data['stickers_global'] = new Sticker();
        $data['stickers_global']->where('sticker_code < 1000000 and category = "global" and status = "approve"')->order_by('sticker_code','desc')->get();
		
		$data['creators'] = new Sticker();
		$data['creators']->where('sticker_code > 999999 and status = "approve"')->order_by('sticker_code','desc')->get();
		
        $this->template->title('บริการรับฝากซื้อสติ๊กเกอร์ไลน์ ของแท้ ไม่มีหาย เชื่อถือได้ 100% ติดต่อไอดีไลน์ ratasak - line2me.in.th');
        meta_description("อัพเดทสติ๊กเกอร์ไลน์ใหม่ๆกว่า 1,000 ลาย ของแท้ ถูกลิขสิทธิ์ ไม่มีหาย เชื่อถือได้ 100% ติดต่อไอดีไลน์ ratasak");
        $this->template->build('index',$data);
	}
    
    function view($slug=false){
        $this->template->set_theme('line')->set_layout('layout');
		
        $data['sticker'] = new Sticker();
        $data['sticker']->where('slug = "'.$slug.'" and status = "approve"')->get(1);
		$data['sticker']->counter();
		
		$view = new Sticker_view();
		$view->where("sticker_id = ".$data['sticker']->id." AND ip = '".$_SERVER['REMOTE_ADDR']."' AND type = 'sticker'")->order_by('id','desc')->get(1);
		
		// $view->check_last_query();
		if(empty($view->id)) // ถ้าไม่มีแถวนี้มาก่อนเลย
		{
				$sticker_view = new Sticker_view();
				$_POST['ip'] = $_SERVER['REMOTE_ADDR'];
				$_POST['sticker_id'] = $data['sticker']->id;
				$_POST['type'] = 'sticker';
				$sticker_view->from_array($_POST);
				$sticker_view->save();	
				
		}else{ // ถ้ามีแถวนี้แล้วให้เช็กเวลา เกิน 5 นาทีให้แอดได้
			$to_time = strtotime(date("Y-m-d H:i:s"));
			$from_time = strtotime($view->created);
			$diff_minute = round(abs($to_time - $from_time) / 60,2);
			
			if($diff_minute > 5){
				$sticker_view = new Sticker_view();
				$_POST['ip'] = $_SERVER['REMOTE_ADDR'];
				$_POST['sticker_id'] = $data['sticker']->id;
				$_POST['type'] = 'sticker';
				$sticker_view->from_array($_POST);
				$sticker_view->save();	
			}
		}
		
		// $sticker_view7 = new Sticker_view();
		// $sticker_view3 = $sticker_view7->get_clone();
		// $sticker_view7->query("SELECT COUNT(id) total7 FROM sticker_views WHERE sticker_id =".$data['sticker']->id." AND created > NOW() - interval 7 DAY");
		// $sticker_view3->query("SELECT COUNT(id) total3 FROM sticker_views WHERE sticker_id =".$data['sticker']->id." AND created > NOW() - interval 3 DAY");
		// $total_7day = $sticker_view7->total7;
		// $total_3day = $sticker_view3->total3;
// 		
		// $this->db->query("UPDATE stickers SET threedays = ".$total_3day.", sevendays = ".$total_7day." where id = ".$data['sticker']->id);
		
		// Deleting rows older than 7 days
		// $this->db->query("DELETE FROM sticker_views WHERE created < DATE_SUB(NOW(), INTERVAL 7 DAY)");
		
        $this->template->title('สติ๊กเกอร์ไลน์ '.$data['sticker']->title.' ของแท้ราคาถูกติดต่อไอดีไลน์ ratasak | line2me.in.th');
        meta_description('Sticker LINE: '.$data['sticker']->title.' สนใจสติ๊กเกอร์ไลน์ของแท้ราคาถูกติดต่อไอดีไลน์ ratasak');
        $this->template->build('view_test',$data);
		
		// $this->output->cache(10080);
    }

	// function view_test($slug=false){
        // $this->template->set_theme('line')->set_layout('layout');
        // $data['sticker'] = new Sticker();
        // $data['sticker']->where('slug = "'.$slug.'"')->get(1);
		// $data['sticker']->counter();
// 				
        // $this->template->title('Sticker LINE: '.$data['sticker']->title.' - สนใจสติ๊กเกอร์ไลน์ราคาถูกติดต่อไอดีไลน์ ratasak | line2me.in.th');
        // meta_description('Sticker LINE: '.$data['sticker']->title.' สนใจสติ๊กเกอร์ไลน์ของแท้ราคาถูกติดต่อไอดีไลน์ ratasak');
        // $this->template->build('view_test',$data);
// 		
		// // $this->output->cache(10080);
    // }

	function view_rand(){
		$sticker = new Sticker();
		$sticker->where("status = 'approve'")->order_by('id','random')->get(1);
		$slug = $sticker->slug;
		redirect('sticker/'.$slug);
	}

	function themes(){
		$this->template->set_theme('line')->set_layout('layout');
		
		if($_GET['sort'] != 'hot'){
			
			$data['themes'] = new Theme();
			$data['themes']->where('status = "approve"');
			if($_GET['sort'] == 'new'){ // มาใหม่
				$data['themes']->order_by('id','desc');
			}elseif($_GET['sort'] == 'hot'){ // ยอดนิยม
				$data['themes']->order_by('counter','desc');
			}elseif($_GET['sort'] == 'rand'){ // สุ่ม
				$data['themes']->order_by('id','random');
			}
			$data['themes']->get_page($_GET['n']);
		
		}else{
			
		
			$sql = "select t.id, t.cover, t.title, t.slug, t.created, count(v.id) as vote
					from themes t
					join sticker_views v on v.sticker_id = t.id
					where t.status <> 'draft'
					and v.type = 'theme'
					group by t.id, t.cover, t.title, t.slug, t.created
					order by vote desc, t.updated desc";
			$themes = new Theme();
	        $data['themes'] = $themes->sql_page($sql, $_GET['n']);
			$data['pagination'] = $themes->sql_pagination;
		
		}
		$this->template->build('themes',$data);
	}

    function theme($slug=false){
        $this->template->set_theme('line')->set_layout('layout');
        $data['theme'] = new Theme();
        $data['theme']->where('slug = "'.$slug.'"')->get(1);
        $data['theme']->counter();
		
		$sticker_view = new Sticker_view();
		$_POST['ip'] = $_SERVER['REMOTE_ADDR'];
		$_POST['sticker_id'] = $data['theme']->id;
		$_POST['type'] = 'theme';
		$sticker_view->from_array($_POST);
		$sticker_view->save();
		
        $this->template->title('Theme LINE: '.$data['theme']->title.' - สนใจธีมไลน์ราคาถูกติดต่อไอดีไลน์ ratasak | line2me.in.th');
        meta_description('Theme LINE: '.$data['theme']->title.' สนใจธีมไลน์ของแท้ราคาถูกติดต่อไอดีไลน์ ratasak');
        $this->template->build('theme_test',$data);
		
		// $this->output->cache(10080);
    }
    
    function lists(){
    	$this->template->set_theme('line')->set_layout('layout');
        $data['stickers'] = new Sticker();
        $data['stickers']->where('status = "approve"')->order_by('title','asc')->get();
        $this->load->view('lists',$data);
    }

	function form_search(){
		$this->load->view('form_search');
	}
    
    // function download($id){
        // $line = new Sticker($id);
        // $line->counter();
        // $this->load->helper('download');
        // $data = file_get_contents($line->preview);
        // $name = basename($line->preview);
        // force_download($name, $data); 
    // }
	
	function promote(){
		$data['paids'] = new Sticker();
		$data['paids']->where("start_date <= date(sysdate()) and (end_date >= date(sysdate()) or end_date = date('0000-00-00')) and status = 'approve'")->order_by("id", "random")->get(6);
		$this->load->view('promote',$data);
		
		// $this->output->cache(10);
	}
}
?>