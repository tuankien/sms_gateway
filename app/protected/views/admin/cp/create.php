<?php   
$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', 'Cps management'),
    'link' => Yii::app()->createUrl("/cp/index")
);

$this->moduleName = "Cp";

$this->menu=array(
	array('label'=>Yii::t('BackEnd', 'List'), 'url'=>array('index'), 'visible'=>!UserAccess::checkAccess('CpAdmin')),
	array('label'=>Yii::t('BackEnd', 'Manage'), 'url'=>array('admin'), 'visible'=>UserAccess::checkAccess('CpAdmin')),
    array('label'=>Yii::t('BackEnd', 'Save'), 'url'=>'javascript:void(0)', 'linkOptions'=>array('onclick'=>'document.getElementById(\'cp-form\').submit()')),
    array('label'=>Yii::t('BackEnd', 'Reset'), 'url'=>'javascript:void(0)', 'linkOptions'=>array('onclick'=>'document.getElementById(\'cp-form\').reset()')),
);

$this->slidebar=array(
	array('label'=>Yii::t('BackEnd','Basic Infomation'), 'name'=>'basic-info', 'rel'=>'Cp-basic-info'),
);

$this->title = Yii::t('BackEnd', "Create").": ". Yii::t('BackEnd',"Cp");
?>

<?php echo $this->renderPartial('_form', array('model'=>$model,'modelSmsc'=>$modelSmsc,)); ?>