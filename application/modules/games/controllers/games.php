<?php

class Games extends Public_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function topic()
	{
		$this->template->build('topic');
	}
	
	public function member($game)
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
		and u.status <> 'draft'";
		if(@$_GET['sex_id']) $sql .= ' and u.sex_id = '.$_GET['sex_id'];
        if(@$_GET['province_id']) $sql .= ' and u.province_id = '.$_GET['province_id'];
        if(@$_GET['image']){(@$_GET['image'] == 'image') ? $sql .= ' and u.image != ""' : $sql .= ' and u.image is null';}
        if(@$app_id) $sql .= ' and ua.app_id = 1';
		$sql .= ' order by u.updated desc';
        $users = new User();
        $data['users'] = $users->sql_page($sql, 10);
		$data['pagination'] = $users->sql_pagination;
		$data['total'] = $users->sql_page_total;
		$this->template->build('game/member', $data);
	}
	
	
}
