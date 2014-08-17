<?php
class User extends ORM
{
	public $table = "users";
	
	public $has_one = array("level","user_type","sex","province");
	
	public $has_many = array("user_app",'jam','notice', 'post');
	
	public function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}
?>