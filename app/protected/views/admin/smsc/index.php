<?php
$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', 'Smsc management'),
    'link' => Yii::app()->createUrl("/smsc/index")
);

$this->moduleName = "Smsc";

$this->slidebar = Backend::getModuleSlideBar('Setting', '/smsc/index');

$this->menu=array(
    array('label'=>Yii::t('BackEnd', 'Delete'), 'itemOptions'=>array('style'=>'cursor:pointer', 'onclick'=>'deleteAll("form-admin", "'.Yii::app()->createUrl('/cpGroup/delete').'");')),
	//array('label'=>Yii::t('BackEnd', 'List'), 'url'=>array('index')),
	array('label'=>Yii::t('BackEnd', 'Create'), 'url'=>array('create')),
);

$this->title = Yii::t("BackEnd", "Manage").": ". Yii::t('BackEnd',"Smsc");
?>
<input type="hidden" id="moduleName" value="CpGroup"/>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cp-group-grid',
	'dataProvider'=>$dataProvider,
    'selectableRows' => 0,
	'columns'=>array(
		array(
            'name' => 'id',
            'header' => Yii::t('BackEnd', 'id'),
            'value' => '$data->id',
            'htmlOptions' => array('style'=>'text-align: center;'),
        ),
        array(
            'name' => 'smsc',
            'header' => Yii::t('BackEnd', 'smsc'),
            'value' => '$data->smsc',
            'htmlOptions' => array('style'=>'text-align: center;'),
        ),
        array(
            'header' => Yii::t('BackEnd', 'Cp name'),
            'value' => '$data->getCpName()',
            'htmlOptions' => array('style'=>'text-align: center;'),
        ),
        array(
			'class'=>'CButtonColumn',
            'template'=> UserAccess::checkAccess("designPatternUpdate")? '{view}{update}{delete}':'{view}{update}',
		),
	),
)); ?>