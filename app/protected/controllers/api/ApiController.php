<?php
class ApiController extends CController
{
    public function actions()
    {   
        return array(
            'soap'=>array(
                'class'=>'CWebServiceAction',
            ),
        );
    }

    /**
     *
     * Call sendMT via SOAP
     * @param string $username
     * @param string $password
     * @param string $service_number
     * @param string $sender
     * @param string $reciever
     * @param string $content
     * @param int $charge
     * @param string $msg_type
     * @param string $subject
     * @param string $sms_id
     * @param string $smsc
     * @return string 'ok' on success, error message on failure
     * @soap
     */
    public function sendMt($username, $password, $service_number, $sender, $reciever, $content, $charge, $msg_type, $subject, $sms_id, $smscval)
    {
        Yii::log("_sendMt($username, $password, $service_number, $sender, $reciever, $content, $charge, $msg_type, $subject, $sms_id, $smscval)", "trace");

        $sender = $service_number;
        $cp = Cp::model()->find("username=:username AND password=:password", array(':username'=>$username, ':password'=>$password));
        if(!$cp)
        {
            $result = array(
                'code' => Mt::CP_AUTHENTICATE_FAILED,
                'message' => "CP authenticate failed",
            );
            
            return implode("|", $result);;
        }
        elseif($cp->smsc != 'ALL')
        {
            $smsc = explode(',', $cp->smsc);
            if(!in_array($service_number, $smsc))
            {
                $result = array(
                    'code' => Mt::STATUS_INVAILID_SMSC,
                    'message' => "Invailid service number",
                );
                return implode("|", $result);;
            }
        }

        $result = $this->_sendMt($sender, $reciever, $content, $charge, $msg_type, $subject, $sms_id, $smscval);
        return implode("|", $result);;
    }

    /**
     *
     * @param receiveMoRequestType $parametes
     * @return receiveMoResponseType
     * @soap
     */
    public function receiveMo($parameters=array()) {
        //receiveMo($username, $password, $service_number, $sender, $content, $keyword, $first_param, $last_param, $sms_id, $smsc)
        return new receiveMoResponseType();
    }

    // call sendMT via HTTP
    public function actionSendMt()
    {
        $username = $_GET['username'];
        $password = $_GET['password'];
        $service_number = $_GET['service_number'];
        $sender = $_GET['service_number']; //$_GET['sender'];
        $reciever = $_GET['reciever'];
        $content = $_GET['content'];
        $charge =  $_GET['charge'];
        $msg_type = $_GET['msg_type'];
        $subject = $_GET['subject'];
        $sms_id = $_GET['sms_id'];
        $smscval = $_GET['smsc'];

        Yii::log("_sendMt($username, $password, $service_number, $sender, $reciever, $content, $charge, $msg_type, $subject, $sms_id, $smscval)", "trace");
        $cp = Cp::model()->find("username=:username AND password=:password", array(':username'=>$username, ':password'=>$password));
        if(!$cp)
        {
            $result = array(
                'code' => Mt::CP_AUTHENTICATE_FAILED,
                'message' => "CP authenticate failed",
            );
            $this->_return($result);
        }
        elseif($cp->smsc != 'ALL')
        {
            $smsc = explode(',', $cp->smsc);
            if(!in_array($service_number, $smsc))
            {
                $result = array(
                    'code' => Mt::STATUS_INVAILID_SMSC,
                    'message' => "Invailid smsc",
                );
                $this->_return($result);
            }
        }

        $result = $this->_sendMt($sender, $reciever, $content, $charge, $msg_type, $subject, $sms_id, $smscval);
        $this->_return($result);
    }

    /**
     * call receiveMo via HTTP
     */

    public function actionReceiveMo()
    {
        // $_GET
        $_GET['sender'] = trim($_GET['sender']);
        if($_GET['sender'][0] == "+") $_GET['sender'] = substr ($_GET['sender'], 1, strlen ($_GET['sender'])-1);
        if($_GET['service_number'][0] == "+") $_GET['service_number'] = substr ($_GET['service_number'], 1, strlen ($_GET['service_number'])-1);

        //
        $smsc = trim($_GET["smsc"]);
        $serviceNumber = trim($_GET["service_number"]);
        $sms_id = trim($_GET['sms_id']);
        $sender = trim($_GET['sender']);
        $keyword = trim(urldecode($_GET['keyword']));
        $content = trim(urldecode($_GET['content']));

        // lay tham so he thong tu request
        foreach(Yii::app()->params['systemParams'] as $val) {
            $systemParams[$val] = trim($_GET[$val]);
        }

        // kiem tra dich vu tuong ung voi keyword truyen vao
        if(!$smsService = SmsService::getService($keyword, $serviceNumber))
        {
            $result = array(
                'code' => Mo::STATUS_KEYWORDWRONG,
                'message' => "Not found",
            );

            // save MO to log
            $this->_saveMo(0, $serviceNumber, $sms_id, $sender, $keyword, $content, Mo::STATUS_KEYWORDWRONG);

            // send sms notification to user
            if(isset(Yii::app()->params['sms_service_invailid']) && (Yii::app()->params['sms_service_invailid']))
            {
                $receiver = $sender;
                $this->_sendMt($serviceNumber, $receiver, Yii::app()->params['sms_service_invailid'], 0, SmscUtils::TYPE_TEXT, '', $sms_id, $smsc);
            }
            
            $this->_return($result);
            exit(0);
        }

        // xay dung tham so dinh kem trong request gui toi dich vu
        $cp_id = $smsService->cp_id;
        $input = array();
        if($smsService->params != "")
        {
            $uriParams = explode("&", $smsService->params);
            foreach($uriParams as $uriParam)
            {
                $param = explode("=", $uriParam);
                if(is_array($param) && $param[0] && $param[1]) $input[$param[0]] = $param[1];
            }
        }

        // tham so he thong
        if($smsService->system_params != "")
        {
            if($smsService->system_params != "ALL") // all params
            {
                $paramsName = explode(",", $smsService->system_params);
                foreach($paramsName as $key => $paramName)
                {
                    $paramsName[$key] = trim($paramName);
                }

                foreach($systemParams as $paramName => $value)
                {
                    if(!in_array($paramName, $paramsName)) unset($systemParams[$paramName]);
                }
            }
            
            foreach($systemParams as $paramName => $value)
            {
                $input[$paramName] = $value;
            }
        }
        
        Yii::log("Execute sms service: ".serialize($smsService), "trace");
        Yii::log("input: ".serialize($input), "trace");

        if($smsService->protocol == 'SOAP')
        {
            $timeOut = 5;   // connection timeout in seconds
            //ini_set('soap.wsdl_cache_enabled', 0);
            ini_set('default_socket_timeout', $timeOut);
            try
            {
                $client=new SoapClient($smsService->get_url,
                        array(
                            'trace' => true,
                            'features' => SOAP_USE_XSI_ARRAY_TYPE,
                            'connection_timeout' => $timeOut,
                        )
                );

                Yii::log("Call soap: URL: {$smsService->get_url}, METHOD: ".$smsService->method_name.", inputs".serialize($input), "trace");
                $result = $client->__soapCall($smsService->method_name, array('parameters' => (object) $input));
                //Yii::log("Call soap: ".$smsService->method_name.", inputs".serialize($input), "trace");
                $result = array(
                    'code' => Mo::STATUS_SUCCESS,
                    'message' => "Successful",
                    'detail' => $result->return,
                );
            }
            catch (Exception $e)
            {
                Yii::log($e->getMessage(), "error");
                $result = array(
                    'code' => Mo::STATUS_FAILURE,
                    'message' => "Exception on call soap function",
                    'detail' => $e->getMessage(),
                );
            }
        }
        elseif($smsService->protocol =='HTTP')
        {
            $url = $smsService->get_url;
            $uri = "";
            foreach($input as $key=>$value)
            {
                $uri .= $key."=".urlencode($value)."&";
            }
            if($uri != "")
            {   
                $uri = substr($uri, 0, -1);
                $url = strpos($url, "?")? $url."&".$uri : $url."?".$uri;
            }
            
            $result = SmscUtils::httpGet($url);


            if(!$result['error'])
            {
                $result = array(
                    'code' => Mo::STATUS_SUCCESS,
                    'message' => "Successful",
                    'detail' => $result['content'],
                );
            }
            else
            {
                $result = array(
                    'code' => Mo::STATUS_FAILURE,
                    'message' => "Failed",
                    'detail' => $result['error_msg'],
                );
            }
        }

        // save MO to log
        $this->_saveMo($smsService->cp_id, $serviceNumber, $sms_id, $sender, $keyword, $content, $result['code'], $result['detail']);

        // output return value
        unset($result['detail']);
        $this->_return($result);
    }

    private function _sendMt($sender, $reciever, $content, $charge, $msg_type, $subject, $sms_id, $smscval) {
        // get kannel info
        $kannel = KannelPeer::model()->find();

        if(!$kannel)
        {
            Yii::log("Could not find kannel info in DB", "error");
        }
        else
        {
            SmscUtils::$kannelHost = $kannel->host;
            SmscUtils::$kannelUser = $kannel->username;
            SmscUtils::$kannelPass = $kannel->password;
            SmscUtils::$countryCode = $kannel->country_code;
        }

        $reciever = SmscUtils::checkCountryCode($reciever, SmscUtils::$countryCode);
        SmscUtils::$checkCountryCode = false;
        $result = SmscUtils::sendMt($sender, $reciever, $content, $charge, $msg_type, $subject, $sms_id, $smscval);
        if($result == 202)
        {
            $result = array(
                'code' => Mt::STATUS_SUCCESS,
                'message' => "Success",
            );
        }
        elseif($result == 0)    // Could not connect to kannel
        {
            $result = array(
                'code' => Mt::STATUS_CONNECT_KANNEL_ERROR,
                'message' => "Could not connect to kannel",
            );
        }
        elseif($result == 1)    // Except
        {
            $result = array(
                'code' => Mt::STATUS_EXCEPTED_MAXLENGTH,
                'message' => "Message too long",
            );
        }
        else
        {
            $result = array(
                'code' => Mt::STATUS_FAILURE,
                'message' => "Failed",
            );
        }

        // save MT for log
        $modelMt =  new Mt();
        $modelMt->cp_id = $cp->id;
        $modelMt->smsc = $smscval;
        $modelMt->sms_id = $sms_id;
        $modelMt->subject = $subject;
        $modelMt->content = $content;
        $modelMt->sender = $sender;
        $modelMt->send_time = new CDbExpression('NOW()');
        $modelMt->receiver = $reciever;
        $modelMt->status = $result['code'];
        $modelMt->insert();

        // update status for associated mo
        if(($modelMt->status == Mt::STATUS_SUCCESS) && ($modelMt->sms_id))
        {
            $moRecord = Mo::model()->findByAttributes(array("sms_id" => $modelMt->sms_id));
            if($moRecord && ($moRecord->status != Mo::STATUS_KEYWORDWRONG))
            {
                $moRecord->status = Mo::STATUS_REPLIED;
                $moRecord->update();
            }
        }

        // return value
        return $result;
    }

    /**
     * save mo record
     * @param INT $cp_id
     * @param STRING $smsc
     * @param STRING $sms_id
     * @param STRING $sender
     * @param STRING $keyword
     * @param STRING $content
     * @param INT $status
     * @param STRING $result
     */
    private function _saveMo($cp_id, $smsc, $sms_id, $sender, $keyword, $content, $status, $result="")
    {
        // checking for replied message
        if($sms_id && ($status != Mo::STATUS_KEYWORDWRONG))
        {
            $mtRecord = Mt::model()->findByAttributes(array("sms_id" => $sms_id));
            if($mtRecord)
            {
                $status = Mo::STATUS_REPLIED;
            }
        }

        // insert into table Mo
        $modelMo =  new Mo();
        $modelMo->cp_id = $cp_id;
        $modelMo->smsc = $smsc;
        $modelMo->sms_id = $sms_id;
        $modelMo->sender = $sender;
        $modelMo->send_time = new CDbExpression('NOW()');
        $modelMo->keyword = $keyword;
        $modelMo->content = $content;
        $modelMo->result = $result;
        $modelMo->status = $status;

        $modelMo->insert();
    }

    /**
     * response HTTP request
     * @param struct $result
     */
    private function _return($result) {
        echo implode("|", $result);
        Yii::app()->end();
    }
}

/**
 * define type of mo request data
 */
class receiveMoRequestType {
     /**
     * @var string $username
     * @soap
     */
    public $username;
    /**
     * @var string $passwords
     * @soap
     */
    public $password;
    /**
     * @var string $service_number
     * @soap
     */
    public $service_number;
    /**
     * @var string $sender
     * @soap
     */
    public $sender;
    /**
     * @var string $content
     * @soap
     */
    public $content;
    /**
     * @var string $keyword
     * @soap
     */
    public $keyword;
    /**
     * @var string $first_param
     * @soap
     */
    public $first_param;

    /**
     * @var string $last_param
     * @soap
     */
    public $last_param;
    /**
     * @var string $sms_id
     * @soap
     */
    public $sms_id;
    /**
     * @var string $smsc
     * @soap
     */
    public $smsc;
}

/**
 * define type of mo response data
 */
class receiveMoResponseType {
     /**
     * @var string $username
     * @soap
     */
    public $return;
}
?>
