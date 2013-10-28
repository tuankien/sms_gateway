<?php

/**
 * This is the model class for table "admin_user".
 *
 * The followings are the available columns in table 'admin_user':
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string $company
 * @property integer $status
 */
class AdminUserPeer extends CActiveRecord
{
	var $className = __CLASS__;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return AdminUserPeer the static model class
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
		return 'admin_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, email, password', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('username, email, password, first_name, last_name, phone, company', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, email, password, first_name, last_name, phone, company, status', 'safe', 'on'=>'search'),
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

		$criteria->compare('id',$this->id);

		$criteria->compare('username',$this->username,true);

		$criteria->compare('email',$this->email,true);

		$criteria->compare('password',$this->password,true);

		$criteria->compare('first_name',$this->first_name,true);

		$criteria->compare('last_name',$this->last_name,true);

		$criteria->compare('phone',$this->phone,true);

		$criteria->compare('company',$this->company,true);

		$criteria->compare('status',$this->status);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}