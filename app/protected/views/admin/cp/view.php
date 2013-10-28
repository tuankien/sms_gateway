<?php

$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', 'CP'),
    'link' => "#"
);

$this->moduleName = "Cp";

$this->menu=array(
    array('label'=>Yii::t('BackEnd', 'Create'), 'url'=>array('create'), 'visible'=>UserAccess::checkAccess('CpCreate')),
	array('label'=>Yii::t('BackEnd', 'Update'), 'url'=>array('update', 'id'=>$model->id), 'visible'=>UserAccess::checkAccess('CpUpdate')),
	array('label'=>Yii::t('BackEnd', 'Delete'), 'url'=>'#', 'visible'=>UserAccess::checkAccess('CpDelete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('application', 'Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('BackEnd', 'List'), 'url'=>array('index'), 'visible'=>!UserAccess::checkAccess('CpAdmin')),
	array('label'=>Yii::t('BackEnd', 'Manage'), 'url'=>array('admin'), 'visible'=>UserAccess::checkAccess('CpAdmin')),
);

$this->slidebar=array(
	array('label'=>Yii::t('BackEnd','Basic Infomation'), 'name'=>'basic-info', 'rel'=>'Cp-basic-info'),
);

$this->title = $model->name;
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
        array(
            'name'=>'group_id',
            'value'=> CpGroup::model()->findByPk($model->group_id)->name
        ),
		'username',
		'password',
		'smsc',
        array(
            'name'=>'admin_id',
            'value'=> AdminUser::model()->findByPk($model->admin_id)->username
        ),
		'created_time',
		'updated_time',
        array(
            'name'=>'created_by',
            'value'=> AdminUser::model()->findByPk($model->created_by)->username
        ),
		array(
            'name'=>'staus',
            'value'=> ($model->status == Cp::STATUS_ENABLED)? Yii::t('BackEnd', 'Enabled') : Yii::t('BackEnd', 'Disabled')
        ),
	),
)); ?>
