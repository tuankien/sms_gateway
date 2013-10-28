<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Kannel extends KannelPeer
{
    var $className = __CLASS__;

    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

?>
