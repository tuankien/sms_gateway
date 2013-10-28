<?php
class Cp extends CpPeer {

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    var $className = __CLASS__;
    
    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function dumpStatusToArray($label = '')
    {
        $array = array();
        if($label) $array[''] = $label;
        $array[self::STATUS_ENABLED] = Yii::t('BackEnd', 'Enabled');
        $array[self::STATUS_DISABLED] = Yii::t('BackEnd', 'Disabled');
        return $array;
    }

    public static function dumpAllAdminIdToArray($label='')
    {
        $array = array();
        if($label)
            $array[''] = $label;
        $criteria = new CDbCriteria();
        $criteria->select = "id, username";
        $criteria->order = "id";
        $items = AdminUser::model()->findAll($criteria);
        foreach($items as $item)
        {
            $array[$item->id] = $item->username;
        }
        return $array;
    }

    /**
     * @todo dump all Cp group to array
     * @param <text> $label
     * @return <array>
     */
    public static function dumpAllCpToArray($label="")
    {
        $array = array();
        if($label)
            $array[''] = $label;
        $criteria = new CDbCriteria();
        $criteria->select = "id, name";
        $criteria->order = "id";
        $items = CpPeer::model()->findAll($criteria);
        foreach($items as $item)
        {
            $array[$item->id] = $item->name;
        }
        return $array;
    }
}
?>