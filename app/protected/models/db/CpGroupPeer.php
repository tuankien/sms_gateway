<?php

/**
 * This is the model class for table "cp_group".
 *
 * The followings are the available columns in table 'cp_group':
 * @property string $id
 * @property string $name
 * @property string $sorder
 */
class CpGroupPeer extends CActiveRecord
{
	var $className = __CLASS__;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return CpGroupPear the static model class
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
		return 'cp_group';
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
			array('name', 'length', 'max'=>255),
			array('sorder', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, sorder', 'safe', 'on'=>'search'),
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