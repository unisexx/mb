<?php
class Jam extends ORM
{
    public $table = "jams";
    
    public $has_one = array("user");
    
    public function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}
?>