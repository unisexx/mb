<?php
class Post extends ORM {
	
	public $table = 'posts';
	
	public $has_one = array('user');
	
	public function __construct($id = null)
	{
		parent::__construct($id);
	}
		
}