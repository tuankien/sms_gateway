<?php
/* 
 * SendSms
 */
class SendSmsController extends SBaseController
{    
    public $layout='main';

    public function  init()
    {
        Yii::import('application.components.api.SmscUtils', true);
    }

    public function actionIndex()
	{        
		if(isset($_POST['btn_sendsms']))
		{
            $msg = '';
            if(!empty($_POST['service_number']))
                $smscval = $_POST['service_number'];
            else
                $msg .= '<li>'.Yii::t('Backend', 'Number not blank').'</li>';

            if(!empty($_POST['reciever']))
                $reciever = $_POST['reciever'];
            else
                $msg .= '<li>'.Yii::t('Backend', 'Phone not blank').'</li>';

            if(isset($_POST['msg_type']))
                $msg_type = $_POST['msg_type'];
            else
                $msg .= '<li>'.Yii::t('Backend', 'type not blank').'</li>';

            if(!empty($_POST['content']))
            {
                $p = new CHtmlPurifier;
                $content = $_POST['content'];
            }
            else
                $msg .= '<li>'.Yii::t('Backend', 'content not blank').'</li>';

            if($_POST['msg_type'] == SmscUtils::TYPE_WAPPUSH && !empty($_POST['subject']))
            {
                $subject = $_POST['subject'];
            }
            elseif($_POST['msg_type'] == SmscUtils::TYPE_WAPPUSH && empty($_POST['subject']))
            {
                $msg .= '<li>'.Yii::t('Backend', 'subject not blank').'</li>';
            }

            if($msg != '')
                Yii::app()->user->setFlash('msg',$msg);
            else
            {
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

                $result = SmscUtils::sendMt($sender, $reciever, $content, $charge, $msg_type, $subject, $sms_id, $smscval, $_POST['charset']);
            }
        }

        $this->layout="detail";
		$this->render('index',array(
            'result'=> $result,
        ));
	}

    public static function dumpTypeToArray($label = '')
    {        
        $array = array();
        if($label) $array[''] = $label;
        $array[SmscUtils::TYPE_TEXT] = Yii::t('BackEnd', 'TEXT');
        $array[SmscUtils::TYPE_WAPPUSH] = Yii::t('BackEnd', 'WAP_PUSH');
        return $array;
    }

    public function actionTestSendMo() {
        $model = new sendMoModel();
        
        if($_POST)
		{
            $model->attributes = $_POST['sendMoModel'];

            if($model->validate())
            {
                if($model->content) $model->content = urlencode($model->content);
                if(!$model->sms_id) $model->sms_id = uniqid();
                
                // call CP service
                $timeOut = Yii::app()->params['timeOut'];
                $ch = curl_init("http://localhost:".Yii::app()->params['apiPort']."/api/receiveMo?sender={$model->sender}&service_number={$model->service_number}&content={$model->content}&keyword={$model->keyword}&first_param={$model->first_param}&last_param={$model->last_param}&smsc={$model->smsc}&sms_id={$model->sms_id}&resent=0");
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
                curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, $timeOut);

                //execute
                $content = curl_exec($ch);
                $error   = curl_errno( $ch );
                $errmsg  = curl_error( $ch );

                if(!$error)
                {
                    Yii::log("return: content = $content", "trace");
                    Yii::app()->user->setFlash('smsResult', $content);
                }
                else
                {
                    Yii::log("Error: url = $url, $errmsg", "trace");
                    Yii::app()->user->setFlash('smsResult', $errmsg);
                }

                //close connection
                curl_close($ch);
                $model = new sendMoModel();
            }
        }

        $this->layout="detail";
		$this->render('testSendMo',array(
			'model'=>$model,
		));
    }
}
?>
