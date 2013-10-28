<?php
$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', "Admin user"),
    'link' => Yii::app()->request->baseUrl."/adminUser/index.html"
);

$this->menu=array(
    array('label'=>Yii::t('BackEnd', 'Duplicate'), 'url'=>array('duplicate', 'id'=>$model->id), 'visible'=>UserAccess::checkAccess('AdminUserCreate')),
	array('label'=>Yii::t('BackEnd', 'Update'), 'url'=>array('update', 'id'=>$model->id), 'visible'=>UserAccess::checkAccess('AdminUserUpdate')),
	array('label'=>Yii::t('BackEnd', 'Delete'), 'url'=>'#', 'visible'=>UserAccess::checkAccess('AdminUserDelete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('BackEnd', 'Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('BackEnd', 'List admin users'), 'url'=>array('index'), 'visible'=>UserAccess::checkAccess('AdminUserIndex') && !UserAccess::checkAccess('AdminUserAdmin')),
	array('label'=>Yii::t('BackEnd', 'Manage admin users'), 'url'=>array('admin'), 'visible'=>UserAccess::checkAccess('AdminUserAdmin')),
);

$this->slidebar=array(
	array('label'=>Yii::t('BackEnd','Basic information'), 'name'=>'basic-info', 'rel'=>'AdminUser-basic-info'),
);

$this->title = Yii::t('BackEnd', 'Detail information').': #'.$model->id;
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'email',
		array(
            'name' => 'password',
            'value' => '*******',
        ),
		'first_name',
		'last_name',
		'phone',
		'company',
		array(
            'name' => 'status',
            'value' => AdminUser::model()->getStatusLabel($model->status),
        ),
	),
)); ?>
