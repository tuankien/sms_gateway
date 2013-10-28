<?php
/* 
 * Model AdminAccessAsign
 */

class AdminAccessAssigns extends AdminAccessAssignsPeer
{

	var $className = __CLASS__;
    
	/**
	 * Returns the static model of the specified AR class.
	 * @return AdminUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
