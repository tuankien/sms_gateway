<?php
/* 
 * View Kannel
 */
$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', 'Kannel'),
    'link' => Yii::app()->createUrl("/kannel/view")
);

$this->moduleName = "Kannel";

$this->menu=array(
	array('label'=>Yii::t('BackEnd', 'Update'), 'url'=>array('update'), 'visible'=>UserAccess::checkAccess('ConfigUpdate')),
);

$this->slidebar = Backend::getModuleSlideBar('Setting', '/kannel/view');


$this->title = $this->moduleName;

?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        'host',
		'username',
        'password',
		'country_code',
	),
));
?>
