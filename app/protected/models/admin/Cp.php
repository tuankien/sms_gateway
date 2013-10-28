<?php
class Cp extends CpPeer {

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    var $className = __CLASS__;
    
    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('group_id',$this->group_id);

		$criteria->compare('username',$this->username,true);

		$criteria->compare('password',$this->password,true);

		$criteria->compare('smsc',$this->smsc,true);

		$criteria->compare('created_time',$this->created_time,true);

		$criteria->compare('updated_time',$this->updated_time,true);

		$criteria->compare('created_by',$this->created_by,true);

		$criteria->compare('status',$this->status);

		$criteria->compare('admin_id',$this->admin_id,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>Yii::app()->params['pageSize']),
		));
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