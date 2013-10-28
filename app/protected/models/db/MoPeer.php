<?php

/**
 * This is the model class for table "mo".
 *
 * The followings are the available columns in table 'mo':
 * @property string $id
 * @property string $cp_id
 * @property string $smsc
 * @property string $sms_id
 * @property string $sender
 * @property string $send_time
 * @property string $content
 * @property string result
 * @property integer $status
 */
class MoPeer extends CActiveRecord
{
    const STATUS_FAILURE = 1;
    const STATUS_SUCCESS = 0;
    const STATUS_KEYWORDWRONG = 2;
    const STATUS_REPLIED = 4;

	var $className = __CLASS__;

    /**
	 * Returns the static model of the specified AR class.
	 * @return MoPeer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cp_id, smsc, sms_id, sender, content', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('cp_id', 'length', 'max'=>10),
			array('smsc, sender', 'length', 'max'=>20),
			array('sms_id', 'length', 'max'=>45),
			array('content, keyword, result', 'length', 'max'=>255),
			array('send_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cp_id, smsc, sms_id, sender, send_time, content, status, keyword', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'cp' => array(self::BELONGS_TO, 'Cp', 'cp_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return Common::loadMessages("BackEnd");
	}
}