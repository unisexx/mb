<?php
class Sticker_view extends ORM {

    var $table = 'sticker_views';
	
	public $has_one = array("sticker");

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}
?>