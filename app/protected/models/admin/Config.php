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

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
            array('name', 'specialCharacter'),
            array('name', 'unique'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			array('value, comment', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, value', 'safe', 'on'=>'search'),
		);
	}

    public function specialCharacter($attribute, $params){
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $this->name)) {
            $this->addError('name',Yii::t('BackEnd', 'Config name is not contained the special character and space.'));
        }
    }
}
?>