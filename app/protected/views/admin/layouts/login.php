<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="vi_vn" />
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/data/images/favorite.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/data/images/favorite.ico" type="image/x-icon"/>

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/login.css" />
    <!--[if lt IE 7]>
    <style type="text/css">
    #logo a {
        background:none !important;
        filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo Yii::app()->request->baseUrl; ?>/data/images/logo.png');
        cursor: pointer;
    }
    </style>
    <![endif]-->
</head>
<body class="login-page">
    <div class="container">
        <div id="login-content" class="rounded-10">
            <div id="login-header">&nbsp;</div>
            <p id="login-title" class="rounded-5 clearfix"><?php echo Yii::t('Global', 'Login');?></p>
            <?php echo $content; ?>
        </div>
        
        <div id="login-footer">
            Copyright &copy; <?php echo date('Y'); ?> by Kiennt.<br/>
            All Rights Reserved.<br/>
        </div><!-- footer -->
    </div><!-- page -->
</body>
</html>