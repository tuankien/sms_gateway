<?php
class Mt extends MtPeer {
    
    var $className = __CLASS__;

    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
?>