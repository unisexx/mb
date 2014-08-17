<?php
class User_app extends ORM
{
	public $table = "user_apps";
	
    public $has_one = array("user");
    
	public function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}
?>