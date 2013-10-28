<?php
class InitDataCommand extends CConsoleCommand {
    public function getHelp() {
        echo "Init data for demo & benchmark reason";
    }
    public function run($args) {
        ini_set("max_execution_time", 36000);
        ini_set("memory_limit", "512M");
        
//        $action = $args[0];
//
//        switch ($action) {
//            case 'fontCategory':
//                $this->_fontCategory();
//                break;
//            case 'font':
//                $this->_font();
//                break;
//            case 'productCore':
//                $this->_productCore();
//                break;
//            case 'atw':
//                $this->_atw();
//                break;
//            case 'product':
//                $this->_product();
//                break;
//        }

        $total = 100000;
        $sesion = time();
        $start = 0;
        for($i=0;$i<$total;$i++) {
            $modelMo = new MoPeer();
            $modelMo->cp_id = 1;
            $modelMo->smsc = '111';
            $modelMo->sms_id = $i.$sesion;
            $modelMo->sender = '84904709199';
            $modelMo->send_time = new CDbExpression('NOW()');
            $modelMo->keyword = "ON";
            $modelMo->content = "ON";
            $modelMo->result = "";
            $modelMo->status = 4;
            $modelMo->insert();

            $modelMt =  new MtPeer();
            $modelMt->cp_id = 1;
            $modelMt->smsc = '111';
            $modelMt->sms_id = $i;
            $modelMt->subject = "";
            $modelMt->content = "This is test sms";
            $modelMt->sender = '111';
            $modelMt->send_time = new CDbExpression('NOW()');
            $modelMt->receiver = '84904709199';
            $modelMt->status = 0;
            $modelMt->insert();
        }
    }
}
?>