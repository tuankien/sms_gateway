<?php
class sendMoModel extends CFormModel {
    public $sender;
    public $service_number;
    public $content;
    public $keyword;
    public $first_param;
    public $last_param;
    public $smsc;
    public $sms_id;

    public function rules() {
        return array(
            //validate required fields
            array('sender, service_number, content, keyword, smsc', 'required'),
            array('first_param, last_param, sms_id', 'safe'),
        );
    }
}
?>