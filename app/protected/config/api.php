<?php
return CMap::mergeArray(
    require(dirname(__FILE__).'/main.php'),
    array(
        'id' => 'api',
        'name'=>'SMS GW - API',
        'controllerPath'=>_APP_PATH_.DIRECTORY_SEPARATOR."protected".DIRECTORY_SEPARATOR."controllers".DIRECTORY_SEPARATOR."api",
        'viewPath'=>_APP_PATH_.DIRECTORY_SEPARATOR."protected".DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR."api",

        // autoloading model and component classes
        'import'=>array(
            'application.components.api.*',
            'application.models.api.*',
        ),
        
        // application components
        'components'=>array(
            'urlManager'=>array(
                'urlSuffix'=>'.html',
                'rules'=>array(
                    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                ),
            ),
        ),
        
        // modules
        'modules'=>array(),

        'params' => array(
            'timeOut'=>'1',
        ),

    )
);
