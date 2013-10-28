<?php

/**
 * This is the model class for table "cp".
 *
 * The followings are the available columns in table 'cp':
 * @property integer $id
 * @property string $name
 * @property integer $group_id
 * @property string $username
 * @property string $password
 * @property string $smsc
 * @property string $created_time
 * @property string $updated_time
 * @property string $created_by
 * @property integer $status
 * @property string $admin_id
 */
class CpPeer extends CActiveRecord
{
	var $className = __CLASS__;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return CpPeer the static model class
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
		return 'cp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, username, password, smsc, admin_id, group_id', 'required'),
			array('group_id, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('username', 'length', 'max'=>45),
			array('password', 'length', 'max'=>32),
			array('smsc', 'length', 'max'=>200),
			array('created_by', 'length', 'max'=>10),
			array('admin_id', 'length', 'max'=>11),
			array('created_time, updated_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, group_id, username, password, smsc, created_time, updated_time, created_by, status, admin_id', 'safe', 'on'=>'search'),
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