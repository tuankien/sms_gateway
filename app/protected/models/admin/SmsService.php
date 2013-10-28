<?php
class SmsService extends SmsServicePeer {
    var $className = __CLASS__;

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
			array('cp_id, smsc, keyword, get_url, protocol', 'required'),
            array('keyword', 'validateServiceKeyword'),
            array('method_name', 'required', 'on' => 'soap'),
			array('keyword_type, status', 'numerical', 'integerOnly'=>true),
			array('cp_id, updated_by', 'length', 'max'=>10),
			array('smsc', 'length', 'max'=>200),
			array('keyword, get_url, system_params', 'length', 'max'=>255),
            array('params', 'length', 'max'=>500),
			array('protocol', 'length', 'max'=>5),
			array('created_time, updated_time, method_name', 'safe'),
            array('method_name', 'required', 'on'=>'soap'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cp_id, smsc, keyword, keyword_type, get_url, system_params, protocol, created_time, updated_time, updated_by, status', 'safe', 'on'=>'search'),
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
            "cp" => array(self::BELONGS_TO, 'Cp', 'cp_id'),
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

		$criteria->compare('cp_id',$this->cp_id,true);

		$criteria->compare('smsc',$this->smsc,true);

		$criteria->compare('keyword',$this->keyword,true);

		$criteria->compare('keyword_type',$this->keyword_type);

		$criteria->compare('get_url',$this->get_url,true);

        $criteria->compare('params',$this->params,true);

		$criteria->compare('system_params',$this->system_params,true);

		$criteria->compare('protocol',$this->protocol,true);

		$criteria->compare('created_time',$this->created_time,true);

		$criteria->compare('updated_time',$this->updated_time,true);

		$criteria->compare('updated_by',$this->updated_by,true);

		$criteria->compare('status',$this->status);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>Yii::app()->params['pageSize']),
		));
	}

    public function beforeSave() {
        // smsc
        if(strtoupper($this->smsc) === 'ALL') $this->smsc = "ALL";
        elseif($this->smsc != '')
        {
            $tmpSmsc = explode(',', $this->smsc);
            $smsc = array();
            foreach($tmpSmsc as $k =>$value)
            {
                $value = trim($value);
                if(!in_array($value, $smsc))
                {
                    array_push($smsc, $value);
                    if(!$findSmsc = Smsc::model()->find('smsc=:smsc', array(':smsc'=>$value)))
                    {
                        $thisSmsc =  new Smsc();
                        $thisSmsc->id = 0;
                        $thisSmsc->smsc = trim($value);
                        $thisSmsc->insert();
                    }
                }
            }
            if(!empty($smsc))
            {
                $this->smsc = implode(", ", $smsc);
            }
        }

        // system params
        if(strtoupper($this->system_params) === 'ALL') $this->system_params = "ALL";
        elseif($this->system_params != "")
        {
            $tmpParams = explode(",", $this->system_params);
            $systemParams = array();
            foreach($tmpParams as $param)
            {
                $param = trim($param);
                if(in_array($param, Yii::app()->params['systemParams']) && !in_array($param, $systemParams))
                {
                    array_push($systemParams, $param);
                }
            }
            if(!empty($systemParams))
            {
                $this->system_params = implode(", ", $systemParams);
            }
            else
            {
                $this->system_params = '';
            }
        }

        $this->updated_time = date('Y-m-d H:m:s');
        $this->updated_by  = Yii::app()->user->id;

        return parent::beforeSave();
    }
    
    /**
     * @todo dump all Cp group to array
     * @param <text> $label
     * @return <array>
     */
    public static function dumpAllCpToArray($label="")
    {
        $array = array();
        if($label)
            $array[''] = $label;
        $criteria = new CDbCriteria();
        $criteria->select = "id, name";
        $criteria->order = "id";
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
        $array[self::STATUS_ENABLED] = Yii::t('BackEnd', 'Enabled');
        $array[self::STATUS_DISABLED] = Yii::t('BackEnd', 'Disabled');
        return $array;
    }

    /**
     * @todo dump all Cp group to array
     * @param <text> $label
     * @return <array>
     */
    public static function dumpProtocolToArray($label="")
    {
        $array = array();
        if($label) $array[''] = $label;
        $protocols = Yii::app()->params['smsServiceProtocols'];
        foreach ($protocols as $protocol)
        {
            $array[$protocol] = $protocol;
        }
        return $array;
    }


    public static function dumpCompareKeywordToArray($label = '')
    {
        $array = array();
        if($label) $array[''] = $label;
        $array[self::COMPARE_EQUAL] = Yii::t('BackEnd', 'compare');
        $array[self::COMPARE_BEGIN] = Yii::t('BackEnd', 'compare_begin');
        return $array;
    }

    public function getCompareKeywordLabel($compare=0)
    {
        if(!$compare) $compare = $this->keyword_type;
        switch ($compare) {
            case self::COMPARE_EQUAL:
                $label = Yii::t('BackEnd', 'compare');
                break;
            case self::COMPARE_BEGIN:
                $label = Yii::t('BackEnd', 'compare_begin');
                break;
        }
        return $label;
    }

    public function validateServiceKeyword($attribute,$params)
    {
        $this->keyword = trim($this->keyword);
        Yii::log("validateServiceKeyword {$this->keyword}", "trace");
        $duplicate = false;
        $id = ($this->id)? $this->id:0;
        $smsServices = SmsService::model()->findAll("(id <> $id) AND (keyword=:keyword AND keyword_type=".SmsService::COMPARE_EQUAL.") OR (LOCATE(keyword, :keyword)=1 AND keyword_type=".SmsService::COMPARE_BEGIN.")", array(':keyword' => $this->keyword));
        if($smsServices)
        {
            if(strtoupper($this->smsc) == "ALL")
            {
                $duplicate = true;
            }
            else
            {
                foreach($smsServices as $smsService)
                {
                    if($smsService->smsc == 'ALL')
                    {
                        $duplicate = true;
                        break;
                    }
                    else
                    {
                        $smsc1 = explode(",", $this->smsc);
                        foreach($smsc1 as $key => $value) $smsc1[$key] = trim($value);
                        $smsc2 = explode(",", $smsService->smsc);
                        $smscCompare = array_intersect($smsc1, $smsc2);
                        if(!empty($smscCompare))
                        {
                            Yii::log("Duplicate smsc ".var_export($smscCompare, true), "trace");
                            $duplicate = true;
                            break;
                        }
                    }
                }
            }
        }

        if($duplicate) $this->addError('keyword', Yii::t("Backend", "This keyword is already in used")." <a href='javascript:void(0)' onclick='searchSmsService(\"{$this->keyword}\", \"{$this->smsc}\")'>".Yii::t("BackEnd", "Detail")."</a>");
    }

    public static function getServices($keyword, $smsc)
    {
        $result = array();
        $smsServices = SmsService::model()->findAll("(keyword=:keyword AND keyword_type=".SmsService::COMPARE_EQUAL.") OR (keyword LIKE :keyword2 AND keyword_type=".SmsService::COMPARE_BEGIN.")", array(':keyword' => $keyword, ':keyword2' => $keyword."%"));
        if($smsServices)
        {
            if(strtoupper($smsc) == "ALL")
            {
                $result = $smsServices;
            }
            else
            {
                foreach($smsServices as $smsService)
                {
                    if($smsService->smsc == 'ALL')
                    {
                        array_push($result, $smsService);
                    }
                    else
                    {
                        $smsc1 = explode(",", $smsc);
                        foreach($smsc1 as $key => $value) $smsc1[$key] = trim($value);
                        $smsc2 = explode(",", $smsService->smsc);
                        $smscCompare = array_intersect($smsc1, $smsc2);
                        if(!empty($smscCompare))
                        {
                            array_push($result, $smsService);
                        }
                    }
                }
            }
        }
        
        return $result;
    }
}
?>
