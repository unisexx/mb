<?php
class Sex extends ORM {

    var $table = 'sexs';
    
    public $has_many = array("user","friend");

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}
?>