<?php
class SMSGWApplication extends CWebApplication{
    public function  init() {
        parent::init();

        $this->_loadConfig();
    }

    public function _loadConfig(){
        $params = $this->getParams();

        // config params
        if($configs = Config::model()->findAll())
        {
            foreach($configs as $config)
            {
                $params[$config->name] = $config->value;
            }
        }

    }
}
?>