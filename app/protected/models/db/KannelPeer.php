<?php

/**
 * This is the model class for table "kannel".
 *
 * The followings are the available columns in table 'kannel':
 * @property string $host
 * @property string $username
 * @property string $password
 * @property string $country_code
 */
class KannelPeer extends CActiveRecord
{
	var $className = __CLASS__;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return KannelPeer the static model class
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
		return 'kannel';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, host, country_code', 'required'),
			array('username, password, host', 'length', 'max'=>255),
            array('country_code', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('username, password, country_code', 'safe', 'on'=>'search'),
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

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('username',$this->username,true);

		$criteria->compare('password',$this->password,true);

		$criteria->compare('country_code',$this->host,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}