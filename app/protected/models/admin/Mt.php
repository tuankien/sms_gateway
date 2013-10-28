<?php
class Mt extends MtPeer {

    var $className = __CLASS__;

    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function dumpAllCpToArray($label='', $cpList = null)
    {
        $array = array();
        if($label)
            $array[''] = $label;
        $criteria = new CDbCriteria();
        $criteria->select = "id, name";
        $criteria->order = "id";
        if($cpList!=null)
        {
            $criteria->condition = "id in (".$cpList.")";
        }
        $items = Cp::model()->findAll($criteria);
        foreach($items as $item)
        {
            $array[$item->id] = $item->name;
        }
        return $array;
    }

    public static function dumpStatusToArray($label = '')
    {
        $array = array();
        if($label) $array[''] = $label;
        $array[self::STATUS_SUCCESS] = Yii::t('BackEnd', 'Success');
        $array[self::STATUS_FAILURE] = Yii::t('BackEnd', 'Failure');
        return $array;
    }

    public function getStatusLabel() {
        switch($this->status) {
            case Mt::STATUS_SUCCESS:
                $label = Yii::t('BackEnd', 'Success');
                break;
            case Mt::STATUS_FAILURE:
                $label = Yii::t('BackEnd', 'Failure');
                break;
            case Mt::STATUS_INVAILID_SMSC:
                $label = Yii::t('BackEnd', 'STATUS_INVAILID_SMSC');
                break;
            case Mt::STATUS_CONNECT_KANNEL_ERROR:
                $label = Yii::t('BackEnd', 'Error connect to kannel');
                break;
            case Mt::STATUS_EXCEPTED_MAXLENGTH:
                $label = Yii::t('BackEnd', 'Error excepted max lenght');
                break;
        }
        return $label;
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

        $criteria->order = "id DESC";

		$criteria->compare('id',$this->id,true);

		$criteria->compare('cp_id',$this->cp_id);

		$criteria->compare('smsc',$this->smsc,true);

        $criteria->compare('sms_id',$this->sms_id,true);

		$criteria->compare('subject',$this->subject,true);

		$criteria->compare('content',$this->content,true);

		$criteria->compare('sender',$this->sender,true);

		if ($this->send_time)
        {
            $date = explode('-', $this->send_time);
            if(isset($date[1]) && ($date[1]!=$date[0])) {
                $criteria->addCondition('DATE(send_time)>=STR_TO_DATE("'.trim($date[0]).'","%d/%m/%Y")');
                $criteria->addCondition('DATE(send_time)<=STR_TO_DATE("'.trim($date[1]).'","%d/%m/%Y")');
            }else {
                $criteria->addCondition('DATE(send_time)=STR_TO_DATE("'.trim($date[0]).'","%d/%m/%Y")');
            }
        }
        
		$criteria->compare('receiver',$this->receiver,true);

		$criteria->compare('status',$this->status);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>Yii::app()->params['pageSize']),
		));
	}
}
?>