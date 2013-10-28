<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="vi_vn" />
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW" />    
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/ie.css" media="screen, projection" />
    <![endif]-->

    <!--[if lt IE 7]>
    <style type="text/css">
    #logo a {
        background:none !important;
        filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo Yii::app()->request->baseUrl; ?>/data/images/logo.png');
        cursor: pointer;
    }
    #sidebar ul li span span.error {
        background:none !important;
        filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo Yii::app()->request->baseUrl; ?>/css/admin/images/icon_error.png');
    }
    </style>
    <![endif]-->
    <?php
        $YII_CSRF_TOKEN = "";
        if(Yii::app()->request->enableCsrfValidation) $YII_CSRF_TOKEN = Yii::app()->request->getCsrfToken();
        $cs=Yii::app()->clientScript;

        // css
        $cs->registerCssFile(Yii::app()->request->baseUrl."/css/admin/main.css");
        $cs->registerCssFile(Yii::app()->request->baseUrl."/css/admin/form.css");
        $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/admin/back.js', CClientScript::POS_END);
        $cs->registerScript('form','
            var LANG = $.parseJSON(\''.json_encode(include _APP_PATH_.'/protected/messages/'.Yii::app()->language."/JS.php").'\');
            var YII_CSRF_TOKEN = "'.$YII_CSRF_TOKEN.'";
            var baseUrl="'.Yii::app()->request->baseUrl.'"',
            CClientScript::POS_HEAD
        );
    ?>
</head>
<body>
<div class="wrapper">
    <div id="header">
        <div class="container">
            <div id="user-login-bar">
                <?php echo Yii::t('BackEnd', 'Hi, {username}', array('{username}'=>'<a href="'.Yii::app()->request->baseUrl.'/adminUser/'.Yii::app()->user->id.'.html">'.Yii::app()->user->name.'</a>'))?> |
                <a href="<?php echo Yii::app()->request->baseUrl?>/site/logout"><?php echo Yii::t('Global', "Logout")?></a>
            </div>            
        </div>
    </div>
    <!-- end header -->

    <div id="mainmenu" class="clearfix">
        <div class="container clearfix">
            <?php
            $this->widget('application.widgets.admin.slideTopMenu.SlideTopMenu', array(
                'items'=>Backend::getMainMenu(),
            ));

            // For CsrfValidation
            if(Yii::app()->request->enableCsrfValidation)
            {
                echo CHtml::hiddenField('YII_CSRF_TOKEN', $YII_CSRF_TOKEN, array('id'=>'YII_CSRF_TOKEN'));
            }
            ?>
        </div>
    </div>
    <!-- end mainmenu -->

    <div class="container clearfix">
        <?php if(Yii::app()->user->getFlash('message')):  ?>
            <p class="errorMessage center"><?php echo Yii::app()->user->getFlash('message'); ?></p>
        <?php endif;?>
        <?php echo $content; ?>
    </div>

    <div id="footer">
        Copyright &copy; <?php echo date('Y'); ?> by Vega Corp.<br/>
        All Rights Reserved.<br/>
    </div><!-- footer -->
</div><!-- page -->
</body>
</html>