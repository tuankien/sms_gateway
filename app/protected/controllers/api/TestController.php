<?php
class TestController extends CController {
    public function actionIndex() {
        $username = "admin";
        $password = "123";
        $service_number = "888";
        $sender = "1231239139";
        $reciever= "12342342";
        $content = "111";
        $charge = '1';
        $msg_type = '2';
        $subject = '2342';
        $sms_id = '123';
        $smscval = "888";
        $client = new SoapClient("http://api.sms.gw/api/soap");
        echo $client->sendMT($username, $password, $service_number, $sender, $reciever, $content, $charge, $msg_type, $subject, $sms_id, $smscval);
    }

    public function actionTestSendMo() {
        $service_number = $_GET['service_number']?$_GET['service_number']:888;
        $sender = $_GET['sender']? $_GET['sender']:'8562098354325';
        $content = $_GET['content'];
        $keyword = $_GET['keyword'];
        $first_param = $_GET['first_param'];
        $last_param = $_GET['last_param'];
        $smsc = $_GET['smsc']? $_GET['smsc']:888;
        $sms_id = $_GET['sms_id']? $_GET['sms_id']:uniqid();
        $timeOut = Yii::app()->params['timeOut'];
        $ch = curl_init("http://localhost:8080/api/receiveMo?sender=$sender&service_number=$service_number&content=$content&keyword=$content&first_param=$first_param&last_param=$last_param&smsc=$smsc&sms_id=$sms_id&resent=0");
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, $timeOut);

        //execute
        $content = curl_exec($ch);
        $error   = curl_errno( $ch );
        $errmsg  = curl_error( $ch );

        if(!$error)
        {
            Yii::log("return: content = $content", "trace");
        }
        else
        {
            Yii::log("Error on sendSmsToKannel: url = $url, $errmsg", "trace");
        }

        //close connection
        curl_close($ch);
    }
}
?>