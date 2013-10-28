<?php

$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', 'CpGroup'),
    'link' => Yii::app()->createUrl("/cpGroup/index")
);

$this->moduleName = "CpGroup";

$this->menu=array(
	array('label'=>Yii::t('BackEnd', 'List'), 'url'=>array('index'), 'visible'=>!UserAccess::checkAccess('CpGroupAdmin')),
	array('label'=>Yii::t('BackEnd', 'Manage'), 'url'=>array('admin'), 'visible'=>UserAccess::checkAccess('CpGroupAdmin')),
    array('label'=>Yii::t('BackEnd', 'Save'), 'url'=>'javascript:void(0)', 'linkOptions'=>array('onclick'=>'document.getElementById(\'cp-group-form\').submit()')),
    array('label'=>Yii::t('BackEnd', 'Reset'), 'url'=>'javascript:void(0)', 'linkOptions'=>array('onclick'=>'document.getElementById(\'cp-group-form\').reset()')),
);

$this->slidebar=array(
	array('label'=>Yii::t('BackEnd','Basic Infomation'), 'name'=>'basic-info', 'rel'=>'CpGroup-basic-info'),
);

$this->title = Yii::t('BackEnd', "Update").": #".$model->id;
?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>