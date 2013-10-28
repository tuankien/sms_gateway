<?php

/**
 * This is the model class for table "mt".
 *
 * The followings are the available columns in table 'mt':
 * @property string $int
 * @property integer $cp_id
 * @property string $smsc
 * @property string $sms_id
 * @property string $subject
 * @property string $content
 * @property string $sender
 * @property string $send_time
 * @property string $receiver
 * @property integer $status
 */
class MtPeer extends CActiveRecord
{
    const STATUS_SUCCESS = 0;
    const STATUS_FAILURE = 1;
    const STATUS_INVAILID_SMSC = 2;
    const STATUS_CONNECT_KANNEL_ERROR = 3;
    const STATUS_EXCEPTED_MAXLENGTH = 4;
    const CP_AUTHENTICATE_FAILED = 5;
    
	var $className = __CLASS__;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return MtPeer the static model class
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
		return 'mt';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cp_id, smsc, sms_id, content, receiver', 'required'),
			array('cp_id, status', 'numerical', 'integerOnly'=>true),
			array('smsc, sms_id', 'length', 'max'=>45),
			array('subject, content', 'length', 'max'=>255),
			array('sender, receiver', 'length', 'max'=>20),
			array('send_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cp_id, smsc, sms_id, subject, content, sender, send_time, receiver, status', 'safe', 'on'=>'search'),
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