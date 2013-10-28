<?php
// this config define local configuration variables
// other common variable is defined in main config
return array(
    // application components
    'components'=>array(
        'db'=>array(
            'class'=>'CDbConnection',
            'connectionString'=>'mysql:host=localhost;dbname=sms_gw',
            'username'=>'root',
            'password'=>'',
            'charset' => 'utf8',
            'enableProfiling'=>true
        ),
    ),
    'params' => array(
        'smsBoxPort' => '23013',
        'wapBoxPort' => '23015',
        'apiPort' => '8080',
        'languages' => array(
            'vi_vn' => 'Tiếng Việt',
            'en_us' => 'English',
        ),
    ),
);