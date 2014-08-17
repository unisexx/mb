<?php
class Notice extends ORM
{
    public $table = "notices";
    
    public $has_one = array("user");
    
    public function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}
?>