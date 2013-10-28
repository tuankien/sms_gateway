<?php
/* 
 * Update Smsc
 */
$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', 'Smsc'),
    'link' => Yii::app()->createUrl("/smsc/index")
);

$this->moduleName = "Smsc";

$this->menu=array(
	array('label'=>Yii::t('BackEnd', 'List'), 'url'=>array('index'), 'visible'=>!UserAccess::checkAccess('SmscAdmin')),
	//array('label'=>Yii::t('BackEnd', 'Manage'), 'url'=>array('admin'), 'visible'=>UserAccess::checkAccess('SmscAdmin')),
    array('label'=>Yii::t('BackEnd', 'Save'), 'url'=>'javascript:void(0)', 'linkOptions'=>array('onclick'=>'document.getElementById(\'cp-group-form\').submit()')),
    array('label'=>Yii::t('BackEnd', 'Reset'), 'url'=>'javascript:void(0)', 'linkOptions'=>array('onclick'=>'document.getElementById(\'cp-group-form\').reset()')),
);

$this->slidebar = Backend::getModuleSlideBar('Setting', '/smsc/index');

$this->title = Yii::t('BackEnd', "Update").": #".$model->id;
?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>