<?php
//echo "load";
/**
 * Smsc class
 */
class SmscUtils {
    // const
    const MAX_LENGTH = 320;

    // SMS Type
    const TYPE_TEXT = 0;
    const TYPE_WAPPUSH = 1;

    // SMS Charset
    const CHARSET_LATIN = 1;    // length = 7 or 8 bits,
    const CHARSET_UTF8 = 2;     // length = 16 bits

    public static $kannelHost = "localhost";
    public static $kannelUser = "admin";
    public static $kannelPass = "paswd";
    public static $countryCode = "084";
    public static $checkCountryCode = true;
    public static $timeOut = 5; // request timeout in seconds

    /**
     *    
     * @param string $sender
     * @param string $reciever
     * @param string $content
     * @param int $charge
     * @param int $msg_type (0: TEXT, 1: WAPPUSH)
     * @param string $subject
     * @param int $sms_id
     * @param string $smscval
     * @return int (0: Could not connect to kannel, 1: Except max lenght, 202: Success, Other: Failure)
     */
    public static function sendMt($sender, $reciever, $content, $charge, $msg_type, $subject, $sms_id, $smscval, $charset=self::CHARSET_LATIN)
    {
        if($sender[0] == "+") $sender = substr ($sender, 1, strlen ($sender)-1);
        
        if(self::$checkCountryCode) $reciever = self::checkCountryCode($reciever, self::$countryCode);

        // validate input params
//        if((strlen($content) + strlen($subject)) > self::MAX_LENGTH )
//        {
//            //echo Yii::t('BackEnd', 'LENGTH > Max value allow');
//            $msg = Yii::t('BackEnd', 'LENGTH > Max value allow');
//            Yii::log("LENGTH > Max value allow", "trace");
//            return 1;
//        }

        // send sms by sms_type
        switch ($msg_type)
        {
            case self::TYPE_WAPPUSH:
            {
                $fields = array(
                    'from' => $sender,
                    'to' => $reciever,
                    'smsc' => $smscval,
                    'link' => $content,
                    'title' => $subject
                );
                $result = self::sendWapPush($fields);
                break;
            }
            case self::TYPE_TEXT:
            {
                $fields = array(
                    'from' => $sender,
                    'to' => $reciever,
                    'smsc' => $smscval,
                    'text' => urlencode($content)
                );
                
                // support charset utf8
                if($charset == self::CHARSET_UTF8)
                {
                    $fields['coding'] = 2;
                    $fields['charset'] = "UTF-8";
                }
                $result = self::sendText($fields);
                break;
            }
        }
        
        return $result;
    }

    /**
     *
     * @param <type> $fields
     * @return <string>
     */
    public static function sendText($input = array())
    {
        $request = "http://".self::$kannelHost.':'.Yii::app()->params['smsBoxPort'].'/cgi-bin/sendsms?username='.self::$kannelUser.'&password='.self::$kannelPass;

        $urlString = "";
        foreach($input as $key=>$value)
        {
            $urlString .= "&".$key."=".$value;
        }

        $request .= $urlString;
        
        Yii::log("SendText: request=".$request, "trace");
        $return = self::sendSmsToKannel($request);
        Yii::log("Return: ".$return, "trace");
        
        return $return;
    }

    public static function sendWapPush($fields)
    {
        $from = $fields['from'];
        $smsc_id = $fields['smsc'];
        $phone = $fields['to'];
        $push_url = htmlspecialchars($fields['link']);
        $text = $fields['title'];

        $host = self::$kannelHost;
        $port = Yii::app()->params['wapBoxPort'];
        $url  =  "http://$host:$port";

        $ppg_user = self::$kannelUser;
        $ppg_pass = self::$kannelPass;

        $wap_push_id = self::_getRandNumbers(5);
        $body =	"--multipart-boundary\r\n".
                "Content-type: application/xml\r\n\r\n".
                '<?xml version="1.0"?>'."\r\n".
                '<!DOCTYPE pap PUBLIC "-//WAPFORUM//DTD PAP 1.0//EN"'."\r\n".
                '"http://www.wapforum.org/DTD/pap_1.0.dtd" >'."\r\n".
                '<pap>'."\r\n".
                '<push-message push-id="'.$wap_push_id.'">'."\r\n\t".
                '<address address-value="WAPPUSH='.$phone.'/TYPE=PLMN@ppg.nokia.com"/>'."\r\n\t".
                '<quality-of-service delivery-method="unconfirmed" network="GSM" bearer="SMS"/>'.
                "\r\n</push-message>\r\n".
                "</pap>\r\n\r\n".
                "--multipart-boundary\r\n".
                "Content-type: text/vnd.wap.si\r\n\r\n".
                '<?xml version="1.0"?>'."\r\n".
                '<!DOCTYPE si PUBLIC "-//WAPFORUM//DTD SI 1.0//EN"'."\r\n".
                '"http://www.wapforum.org/DTD/si.dtd">'."\r\n".
                "<si>\r\n".
                '<indication action="signal-high" si-id="'.$wap_push_id.'" href="'. $push_url .'">'.$text.'</indication>'."\r\n".
                "</si>\r\n"."--multipart-boundary--\r\n";

        $post = "POST /wappush HTTP/1.1\r\n"."Host: $host:$port\r\n".
            "Authorization: Basic ".base64_encode("$ppg_user:$ppg_pass")."\r\n".
            "X-Kannel-SMSC: $smsc_id\r\n".
            "X-Kannel-From: $from\r\n".
            'Content-Type: multipart/related; boundary=multipart-boundary; type="application/xml"'.
            "\r\n".
            "Content-Length: ".strlen($body)."\r\n"."\r\n".$body;

        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt ($ch,CURLOPT_CUSTOMREQUEST , $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //execute
        $content = curl_exec($ch);
        $error   = curl_errno( $ch );
        $errmsg  = curl_error( $ch );

        if(!$error)
        {
            Yii::log("sendSmsToKannel: content = $post", "trace");
            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        }
        else
        {
            Yii::log("Error on sendSmsToKannel: url = $url, $errmsg", "trace");
            $status = 0;
        }

        //close connection
        curl_close($ch);

        return $status;
    }

    public static function sendWapPush2($fields)
    {
        $request = "http://".self::$kannelHost.':'.Yii::app()->params['smsBoxPort'].'/cgi-bin/sendsms'
             .'?username='.urlencode(self::$kannelUser)
             .'&password='.urlencode(self::$kannelPass)
             .self::wapPushEncode($fields);

        Yii::log("SendWapPush: request=".$request, "trace");
        $return = self::sendSmsToKannel($request);
        Yii::log("Return: ".$return, "trace");

        return $return;
    }

    public static function wapPushEncode($fields)
    {
        // udh with default dest port
        $fields['udh']  = '%06%05%04%0B%84%23%F0';

        if ( strtolower(substr($fields['link'], 0, 7)) == 'http://') {
            $fields['link'] = substr($fields['link'],7);
        }

        // some magics to encode SI to binary tag
        $fields['text'] = '%1B%06%01%AE%02%05%6A%00%45%C6%0C%03'.
            self::hexEncode($fields['link'], '%').'%00%01%03'.
            self::hexEncode($fields['title'], '%').'%00%01%01';

        unset ( $fields['title'], $fields['link'] );

        $string = "";
        while(list($k,$v) = each($fields)) {
          if ( $v != "" ) {
            $string .= "&$k=$v";
          }
        }
        return $string;
    }

    public static function hexEncode( $text, $joiner='' )
    {
        $ret = "";
        for ($l=0; $l<strlen($text); $l++) {
            $letter = substr($text, $l, 1);
            $ret .= sprintf("%s%02X", $joiner, ord($letter));
        }
        return $ret;
    }


    public static function checkCountryCode($phone, $countryCode) {
        // check country code
        $phoneLen = strlen($phone);
        $firstChar = substr($phone, 0, 1);
        if(($firstChar == "+") || ($firstChar == 0))
        {
            $phone = substr($phone, 1, $phoneLen-1);
        }
        
        // check country code
        $pos = strpos($phone, $countryCode);
        if($pos === 0)
        {
            $phone = "+".$phone;
        }
        elseif($pos === false)
        {
            $phone = "+".$countryCode.$phone;
        }
        
        return $phone;
    }

    private static function _assignRandValue($num)
    {
        // accepts 1 - 36
        switch($num)
        {
            case "1":
                $rand_value = "a";
                break;
            case "2":
                $rand_value = "b";
                break;
            case "3":
                $rand_value = "c";
                break;
            case "4":
                $rand_value = "d";
                break;
            case "5":
                $rand_value = "e";
                break;
            case "6":
                $rand_value = "f";
                break;
            case "7":
                $rand_value = "g";
                break;
            case "8":
                $rand_value = "h";
                break;
            case "9":
                $rand_value = "i";
                break;
            case "10":
                $rand_value = "j";
                break;
            case "11":
                $rand_value = "k";
                break;
            case "12":
                $rand_value = "l";
                break;
            case "13":
                $rand_value = "m";
                break;
            case "14":
                $rand_value = "n";
                break;
            case "15":
                $rand_value = "o";
                break;
            case "16":
                $rand_value = "p";
                break;
            case "17":
                $rand_value = "q";
                break;
            case "18":
                $rand_value = "r";
                break;
            case "19":
                $rand_value = "s";
                break;
            case "20":
                $rand_value = "t";
                break;
            case "21":
                $rand_value = "u";
                break;
            case "22":
                $rand_value = "v";
                break;
            case "23":
                $rand_value = "w";
                break;
            case "24":
                $rand_value = "x";
                break;
            case "25":
                $rand_value = "y";
                break;
            case "26":
                $rand_value = "z";
                break;
            case "27":
                $rand_value = "0";
                break;
            case "28":
                $rand_value = "1";
                break;
            case "29":
                $rand_value = "2";
                break;
            case "30":
                $rand_value = "3";
                break;
            case "31":
                $rand_value = "4";
                break;
            case "32":
                $rand_value = "5";
                break;
            case "33":
                $rand_value = "6";
                break;
            case "34":
                $rand_value = "7";
                break;
            case "35":
                $rand_value = "8";
                break;
            case "36":
                $rand_value = "9";
                break;
        }
        return $rand_value;
    }

    private static function _getRandNumbers($length)
    {
        if($length>0)
        {
            $rand_id="";
            for($i=1; $i<=$length; $i++)
            {
                mt_srand((double)microtime() * 1000000);
                $num = mt_rand(27,36);
                $rand_id .= self::_assignRandValue($num);
            }
        }
        return $rand_id;
    }


    public static function httpGet($url)
    {
        $timeOut = self::$timeOut;
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, $timeOut);

        //execute
        $content = curl_exec($ch);
        $error   = curl_errno( $ch );
        $errmsg  = curl_error( $ch );

        //close connection
        curl_close($ch);

        if($error) Yii::log("Error on httpGet: url = $url, $errmsg", "trace");

        return array(
            "error" => $error,
            "content" => $content,
            "error_msg" => $errmsg,
        );
    }

    public static function sendSmsToKannel($url) {
        $timeOut = self::$timeOut;
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, $timeOut);

        //execute
        $content = curl_exec($ch);
        $error   = curl_errno( $ch );
        $errmsg  = curl_error( $ch );

        if(!$error)
        {
            Yii::log("sendSmsToKannel: content = $content", "trace");
            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        }
        else
        {
            Yii::log("Error on sendSmsToKannel: url = $url, $errmsg", "trace");
            $status = 0;
        }
        
        //close connection
        curl_close($ch);

        return $status;
    }
}
?>
