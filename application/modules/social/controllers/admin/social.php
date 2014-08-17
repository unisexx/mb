<?php

class Social extends Admin_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function list_many($social = 'line')
	{
		$sql = "select social_$social as social, count(social_line) as total
		from users
		where social_$social <> ''
		group by social_line having total > 1
		order by total desc";
		$items = $this->db->query($sql)->result();
		foreach($items as $item)
		{
			$users = $this->db->query("select id, image from users where social_$social = '$item->social' order by id desc")->result();
			foreach($users as $key => $u)
			{
				if($key > 0)
				{
					echo 'Deleted ID: '.$u->id.'<br />';
					@unlink('uploads/user/'.$u->image);
					@unlink('uploads/user/big/'.$u->image);
					$this->db->query("delete from users where id = $u->id");
				}
				else 
				{
					echo 'Keep ID: '.$u->id.'<br />';	
				}
				
			}
			echo '<hr />';
		}
	}
}
