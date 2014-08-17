<?php
class Sticker extends ORM {

    var $table = 'stickers';
	
	public $has_many = array('sticker_view');

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}
?>