<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <script type="text/javascript">baseUrl = '<?php echo Yii::app()->request->baseUrl;?>';</script>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/gridview.css" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <?php
        $cs=Yii::app()->clientScript;
        $cs->registerCoreScript('jquery');
        $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/admin/back.js');
        $cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/admin/loadpopup.js');
        $cs->registerScript('form','
                var LANG = $.parseJSON(\''.json_encode(include _APP_PATH_.'/protected/messages/'.Yii::app()->language."/JS.php").'\');
                var baseUrl="'.Yii::app()->request->baseUrl.'"',
            CClientScript::POS_HEAD
        );
    ?>
</head>
<body style="background: none;">
<div id="popup">
    <?php echo $content; ?>
</div><!-- page -->
</body>
</html>