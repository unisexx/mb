<?php
class App extends ORM
{
	public $table = "apps";
	
	public $has_one = array("user");
	
	public function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}
?>