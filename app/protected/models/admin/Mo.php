<?php
class Mo extends MoPeer {
    var $className = __CLASS__;

    public static function dumpAllCpToArray($label = '', $cpList = null)
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

    public static function dumpAllSmscToArray($label='')
    {
        $array = array();
        if($label)
            $array[''] = $label;
        $criteria = new CDbCriteria();
        $criteria->select = "smsc";
        $criteria->order = "smsc";
        $items = Mo::model()->findAll($criteria);
        foreach($items as $item)
        {
            $array[$item->smsc] = $item->smsc;
        }
        return $array;
    }

    public static function dumpStatusToArray($label = '')
    {
        $array = array();
        if($label) $array[''] = $label;
        $array[self::STATUS_SUCCESS] = Yii::t('BackEnd', 'Success');
        $array[self::STATUS_FAILURE] = Yii::t('BackEnd', 'Failure');
        $array[self::STATUS_KEYWORDWRONG] = Yii::t('BackEnd', 'Keyword not found');
        $array[self::STATUS_REPLIED] = Yii::t('BackEnd', 'Replied');
        return $array;
    }

    public function getStatusLabel() {
        switch($this->status) {
            case Mo::STATUS_SUCCESS:
                $label = Yii::t('BackEnd', 'Success');
                break;
            case Mo::STATUS_FAILURE:
                $label = Yii::t('BackEnd', 'Failure');
                break;
            case Mo::STATUS_KEYWORDWRONG:
                $label = Yii::t('BackEnd', 'Keyword not found');
                break;
            case Mo::STATUS_REPLIED:
                $label = Yii::t('BackEnd', 'Replied');
                break;
        }
        return $label;
    }

    public function displayStatus() {
        switch($this->status) {
            case Mo::STATUS_SUCCESS:
                $label = Yii::t('BackEnd', 'Success');
                $color = "green";
                break;
            case Mo::STATUS_FAILURE:
                $label = Yii::t('BackEnd', 'Failure');
                $color = "red";
                break;
            case Mo::STATUS_KEYWORDWRONG:
                $label = Yii::t('BackEnd', 'Keyword not found');
                $color = "gray";
                break;
            case Mo::STATUS_REPLIED:
                $label = Yii::t('BackEnd', 'Replied');
                $color = "green";
                break;
        }
        return "<span style='color:$color' title='".htmlspecialchars($this->result)."'>$label</span>";
    }

    public function search()
	{   
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

        $criteria->order = "id DESC";

		$criteria->compare('id',$this->id,true);

        if($this->cp_id) $criteria->addCondition("cp_id in ({$this->cp_id})");

        $criteria->compare('smsc',$this->smsc,true);

		$criteria->compare('sms_id',$this->sms_id,true);

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

        $criteria->compare('content',$this->content,true);

        $criteria->compare('keyword',$this->keyword,true);

		$criteria->compare('status',$this->status);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>Yii::app()->params['pageSize']),
		));
	}
}
?>