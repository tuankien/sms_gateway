<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n";
?>

$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', '<?php echo $this->modelClass;?>'),
    'link' => "#"
);

$this->moduleName = "<?php echo $this->modelClass ?>";

$this->menu=array(
	array('label'=>Yii::t('BackEnd', 'List'), 'url'=>array('index'), 'visible'=>!UserAccess::checkAccess('<?php echo $this->modelClass;?>Admin')),
	array('label'=>Yii::t('BackEnd', 'Manage'), 'url'=>array('admin'), 'visible'=>UserAccess::checkAccess('<?php echo $this->modelClass;?>Admin')),
    array('label'=>Yii::t('BackEnd', 'Save'), 'url'=>'javascript:void(0)', 'linkOptions'=>array('onclick'=>'document.getElementById(\'<?php echo $this->class2id($this->modelClass)?>-form\').submit()')),
    array('label'=>Yii::t('BackEnd', 'Reset'), 'url'=>'javascript:void(0)', 'linkOptions'=>array('onclick'=>'document.getElementById(\'<?php echo $this->class2id($this->modelClass) ?>-form\').reset()')),
);

$this->slidebar=array(
	array('label'=>Yii::t('BackEnd','Basic Infomation'), 'name'=>'basic-info', 'rel'=>'<?php echo $this->modelClass; ?>-basic-info'),
);

$this->title = Yii::t('BackEnd', "Update").": #".$model->id;
?>


<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>