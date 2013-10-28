<?php
class Config extends ConfigPeer {
    var $className = __CLASS__;

	/**
	 * Returns the static model of the specified AR class.
	 * @return ConfigPeer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
?>