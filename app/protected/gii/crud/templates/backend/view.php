<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n";
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
?>

$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', '<?php echo $this->modelClass;?>'),
    'link' => "#"
);

$this->moduleName = "<?php echo $this->modelClass ?>";

$this->menu=array(
    array('label'=>Yii::t('BackEnd', 'Create'), 'url'=>array('create'), 'visible'=>UserAccess::checkAccess('<?php echo $this->modelClass;?>Create')),
	array('label'=>Yii::t('BackEnd', 'Update'), 'url'=>array('update', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>), 'visible'=>UserAccess::checkAccess('<?php echo $this->modelClass;?>Update')),
	array('label'=>Yii::t('BackEnd', 'Delete'), 'url'=>'#', 'visible'=>UserAccess::checkAccess('<?php echo $this->modelClass;?>Delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>),'confirm'=>Yii::t('application', 'Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('BackEnd', 'List'), 'url'=>array('index'), 'visible'=>!UserAccess::checkAccess('<?php echo $this->modelClass;?>Admin')),
	array('label'=>Yii::t('BackEnd', 'Manage'), 'url'=>array('admin'), 'visible'=>UserAccess::checkAccess('<?php echo $this->modelClass;?>Admin')),
);

$this->slidebar=array(
	array('label'=>Yii::t('BackEnd','Basic Infomation'), 'name'=>'basic-info', 'rel'=>'<?php echo $this->modelClass; ?>-basic-info'),
);

$this->title = <?php echo "\$model->{$nameColumn}"; ?>;
?>

<?php echo "<?php"; ?> $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
<?php
foreach($this->tableSchema->columns as $column)
	echo "\t\t'".$column->name."',\n";
?>
	),
)); ?>
