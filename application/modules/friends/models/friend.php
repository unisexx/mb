<?php
class Friend extends ORM {

    var $table = 'friends';
    
    public $has_one = array("province","sex");

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}
?>