<?php
class CpGroup extends CpGroupPeer{

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

		$criteria->compare('id',$this->id,true);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('sorder',$this->sorder,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>Yii::app()->params['pageSize']),
		));
	}

    /**
     * @todo dump all Cp group to array
     * @param <text> $label
     * @return <array>
     */
    public static function dumpAllCpGroupToArray($label="")
    {
        $array = array();
        if($label)
            $array[''] = $label;
        $criteria = new CDbCriteria();
        $criteria->select = "id, name";
        $criteria->order = "id";
        $items = CpGroupPeer::model()->findAll($criteria);
        foreach($items as $item)
        {
            $array[$item->id] = $item->name;
        }
        return $array;
    }

    /**
     * @todo dump all Cp group to array
     * @param <text> $label
     * @return <array>
     */
    public static function dumpAllCpGroup()
    {
        $array = array();
        $criteria = new CDbCriteria();
        $criteria->select = "id, name";
        $criteria->order = "id";
        $items = CpGroupPeer::model()->findAll($criteria);
        foreach($items as $item)
        {
            $array[] = $item;
        }
        return $array;
    }
}
?>