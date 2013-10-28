<?php

/**
 * This is the model class for table "sms_service".
 *
 * The followings are the available columns in table 'sms_service':
 * @property integer $id
 * @property string $cp_id
 * @property string $smsc
 * @property string $keyword
 * @property integer $keyword_type
 * @property string $get_url
 * @property string $params
 * @property string $system_params
 * @property string $protocol
 * @property string $created_time
 * @property string $updated_time
 * @property string $updated_by
 * @property integer $status
 */
class SmsServicePeer extends CActiveRecord
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    const PROTOCOL_SOAP = 0;
    const PROTOCOL_HTTP = 1;

    const COMPARE_EQUAL   = 0;
    const COMPARE_BEGIN   = 1;
    
	var $className = __CLASS__;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return SmsServicePeer the static model class
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
		return 'sms_service';
	}

    public static function getService($keyword, $serviceNumber)
    {
        $condition = "(status=".self::STATUS_ENABLED.")";
        $condition .= " AND ((keyword=:keyword AND keyword_type=".SmsService::COMPARE_EQUAL.")";
        $condition .= " OR (LOCATE(keyword, :keyword)=1 AND keyword_type=".SmsService::COMPARE_BEGIN."))";
        $params = array(':keyword' => $keyword);
        if($smsServices = self::model()->findAll($condition, $params))
        {
            foreach($smsServices as $smsService)
            {
                if($smsService->smsc == 'ALL')
                {
                    return $smsService;
                }
                else
                {
                    $smscArr = explode(",", $smsService->smsc);
                    if(in_array($serviceNumber, $smscArr)) return $smsService;
                }
            }
        }

        // find sms services with * keyword
        $condition = "(status=".self::STATUS_ENABLED.") AND (keyword='*')";
        if($smsServices = self::model()->findAll($condition))
        {
            foreach($smsServices as $smsService)
            {
                if($smsService->smsc == 'ALL')
                {
                    return $smsService;
                }
                else
                {
                    $smscArr = explode(",", $smsService->smsc);
                    if(in_array($serviceNumber, $smscArr)) return $smsService;
                }
            }
        }

        return false;
    }
}