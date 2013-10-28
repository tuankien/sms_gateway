<?php
/* 
 * update kannel
 */
$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', 'Kannel'),
    'link' => Yii::app()->request->baseUrl.'/kannel/update.html',
);

$this->moduleName = "Config";

$this->menu=array(
	array('label'=>Yii::t('BackEnd', 'View'), 'url'=>array('view'), 'visible'=>UserAccess::checkAccess('ConfigAdmin')),
    array('label'=>Yii::t('BackEnd', 'Save'), 'url'=>'javascript:void(0)', 'linkOptions'=>array('onclick'=>'document.getElementById(\'config-form\').submit()')),
    array('label'=>Yii::t('BackEnd', 'Reset'), 'url'=>'javascript:void(0)', 'linkOptions'=>array('onclick'=>'document.getElementById(\'config-form\').reset()')),
);

$this->slidebar = Backend::getModuleSlideBar('Setting', '/kannel/view');

$this->title = Yii::t('BackEnd', "Update")." Kannel";
?>

<?php echo $this->renderPartial('_form', array('model'=>$model,'error' => $error,)); ?>