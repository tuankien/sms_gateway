<?php
$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', "Settings"),
    'link' => "#"
);


$this->moduleName = "AdminUser";
$this->menu=array(
    array('label'=>Yii::t('BackEnd', 'Delete'), 'itemOptions'=>array('style'=>'cursor:pointer', 'onclick'=>'deleteAll("form-admin", "/adminUser/deleteAll");return false;')),
	array('label'=>Yii::t('BackEnd', 'List admin users'), 'url'=>array('index')),
	array('label'=>Yii::t('BackEnd', 'Create'), 'url'=>array('create')),
);

$this->slidebar = Backend::getModuleSlideBar('Setting', '/adminUser/index');

Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
    });
    $('.search-form form').submit(function(){
        $.fn.yiiGridView.update('admin-user-grid', {
            data: $(this).serialize()
        });
        return false;
    });
");
$this->title = Yii::t('BackEnd', "Manage admin users");
?>
<div class="search-form">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>
<?php echo CHtml::beginForm('#', 'post', array("id"=>"form-admin", "name"=>"frmAdmin")); ?>
<?php $this->widget('application.widgets.admin.GridView', array(
	'id'=>'admin-user-grid',
	'dataProvider'=>$model->search(),
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
<?php echo CHtml::endForm(); ?>