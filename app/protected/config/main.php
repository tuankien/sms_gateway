<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return CMap::mergeArray(
    require(dirname(__FILE__).'/local.php'),
    array(
        'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        'sourceLanguage'=>'code',
        'language'=>'vi_vn',

        // preloading 'log' component
        'preload'=>array('log'),

        // autoloading model and component classes
        'import'=>array(
            'application.models.db.*',
            'application.components.common.*',
        ),

        // application components
        'components'=>array(
            'user'=>array(
                // enable cookie-based authentication
                'allowAutoLogin'=>true,
            ),

//            'request'=>array(
//                'enableCsrfValidation'=>true,
//                'enableCookieValidation'=>true,
//            ),

//            'session'=>array(
//                'class'=>'system.web.CDbHttpSession',
//                'sessionTableName'=>'session',
//                'connectionID'=> 'db',
//            ),

            // enable URLs in path-format
            'urlManager'=>array(
                'urlFormat'=>'path',
                'showScriptName'=> false,
            ),

            'clientScript'=>array(
                'class'=>'application.extensions.minify.MinifyClientScript',
                'combineFiles'=>true,
                'compressCss'=>true,
                'compressJs'=>true,
            ),

            'log'=>array(
                'class'=>'CLogRouter',
                'routes'=>array(
                    array(
                        'class'=>'CFileLogRoute',
                        'levels'=>'error, warning, trace',
                    ),
                ),
            ),
        ),

        // module config
        'modules'=>array(),

        // application-level parameters that can be accessed
        // using Yii::app()->params['paramName']
        'params'=>array(
            'langArr'=>array('en_us'=> 'English', 'vi_vn' => 'Tiếng Việt'),
            'defaultLanguage'=>'vi_vn',
            'timeOut'=>'3',
            'systemParams' => array('sender', 'receiver', 'content', 'keyword', 'first_param', 'last_param', 'smsc', 'sms_id', 'coding', 'time', 'service_number'),
            'smsServiceProtocols'=>array(
                'SOAP' => 'SOAP',
                'HTTP'=> 'HTTP',
            )
        ),
    )
);
?>