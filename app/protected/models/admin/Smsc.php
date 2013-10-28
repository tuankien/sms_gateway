<?php
/* 
*/
class Smsc extends SmscPeer
{
    var $className = __CLASS__;

    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function dumpAllToArray($label="")
    {
        $array = array();
        if($label)
            $array[''] = $label;
        $criteria = new CDbCriteria();
        $criteria->select = "id, smsc";
        $criteria->order = "id";
        $items = self::model()->findAll($criteria);
        foreach($items as $item)
        {
            $array[$item->smsc] = $item->smsc;
        }
        return $array;
    }

    public function getCpName() {
        $strCpName = "";
        $smsc = trim($this->smsc);
        $criteria = new CDbCriteria();
        $criteria->condition = "(smsc='ALL') OR (smsc LIKE '$smsc,%') OR (smsc LIKE '%,$smsc,%') OR (smsc LIKE '%,$smsc') OR (smsc='$smsc')";
        $criteria->group = "cp_id";
        if($smsServices = SmsService::model()->findAll($criteria))
        {
            foreach($smsServices as $smsService)
            {
                $cp = Cp::model()->findByPk($smsService->cp_id);
                $strCpName .= $cp->name.", ";
            }
            $strCpName = substr($strCpName, 0, -2);
        }
        return $strCpName;
    }
}
?>