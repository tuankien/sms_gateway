<?php
$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', "Settings"),
    'link' => "#"
);

$this->moduleName = "AdminUser";

$this->menu=array(
	array('label'=>Yii::t('BackEnd', 'Create'), 'url'=>array('create'), 'visible'=>UserAccess::checkAccess('AdminUserCreate')),
	array('label'=>Yii::t('BackEnd', 'Manage admin users'), 'url'=>array('admin'), 'visible'=>UserAccess::checkAccess('AdminUserAdmin')),
);

$this->slidebar = Backend::getModuleSlideBar('Setting', '/adminUser/index');

$this->title = Yii::t('BackEnd', 'List admin users');
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'admin-user-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'id',
		'username',
		'email',
		'first_name',
		'last_name',
        array(
            'name' => 'status',
            'value' => 'AdminUser::model()->getStatusLabel($data->status)',
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
