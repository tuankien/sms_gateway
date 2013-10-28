<?php
class SmsService extends SmsServicePeer {
    var $className = __CLASS__;

    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
?>