<?php
/* 
 * Duplicate User
 */
$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', "Admin user"),
    'link' => Yii::app()->request->baseUrl."/adminUser/index.html"
);

$this->menu=array(
	array('label'=>Yii::t('BackEnd', 'List admin users'), 'url'=>array('index'), 'visible'=>!UserAccess::checkAccess('AdminUserAdmin')),
	array('label'=>Yii::t('BackEnd', 'Manage admin users'), 'url'=>array('admin'), 'visible'=>UserAccess::checkAccess('AdminUserAdmin')),
    array('label'=>Yii::t('BackEnd', 'Save'), 'url'=>'javascript:void(0)', 'linkOptions'=>array('onclick'=>'document.getElementById(\'admin-user-form\').submit();return false;')),
    array('label'=>Yii::t('BackEnd', 'Reset'), 'url'=>'javascript:void(0)', 'linkOptions'=>array('onclick'=>'document.getElementById(\'admin-user-form\').reset();return false;')),
);

$this->slidebar=array(
	array('label'=>Yii::t('BackEnd','Basic information'), 'name'=>'basic-info', 'rel'=>'AdminUser-basic-info'),
);

$this->title = Yii::t('BackEnd', 'Duplicate admin user').': '.$model->id;
?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
