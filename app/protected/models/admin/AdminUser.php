<?php
class AdminUser extends AdminUserPeer {
    const STATUS_ACTIVED = 0;
    const STATUS_LOGGEDIN = 1;
    const STATUS_INACTIVED = 2;

    var $className = __CLASS__;
    var $full_name;

    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, email', 'required'),
            array('password', 'required', 'on'=>'create, duplicate'),

			array('status', 'numerical', 'integerOnly'=>true),
			array('username, email, password, first_name, last_name, phone, company', 'length', 'max'=>255),
            array('username', 'unique'),
            array('email', 'unique'),
            array('email', 'email'),
            array('password', 'length', 'min'=>6),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, email, password, first_name, last_name, phone, company, status', 'safe', 'on'=>'search'),
		);
	}

    public function getFullName() {
        if($this->full_name) return $this->full_name;
        if((!$this->first_name) && (!$this->last_name)) return '';
        if(Yii::app()->language == 'en_us')
        {
            $this->full_name = trim($this->last_name." ".$this->first_name);
        }
        else
        {
            $this->full_name = trim($this->first_name." ".$this->last_name);
        }

        return $this->full_name;
    }

    public function getStatusLabel($status){
        $statusArray = array(
            self::STATUS_ACTIVED => Yii::t('BackEnd', 'Actived'),
            self::STATUS_LOGGEDIN => Yii::t('BackEnd', 'Logged in'),
            self::STATUS_INACTIVED => Yii::t('BackEnd', 'Deactive')
        );
        return $statusArray[$status];
    }

    public function getStatusArray($label = ''){
        if($label) $statusArray[''] = $label;
        $statusArray[self::STATUS_ACTIVED] = Yii::t('BackEnd', 'Actived');
        $statusArray[self::STATUS_LOGGEDIN] = Yii::t('BackEnd', 'Logged in');
        $statusArray[self::STATUS_INACTIVED] = Yii::t('BackEnd', 'Deactive');

        return $statusArray;
    }
}
?>