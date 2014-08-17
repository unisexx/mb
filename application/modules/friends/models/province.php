<?php
class Province extends ORM {

    var $table = 'provinces';
    
    public $has_many = array("user","friend");

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}
?>