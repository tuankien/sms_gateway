<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	
    <table>
        <tr>
            <td  class="alignRight">
                <?php echo Yii::t('BackEnd','Username'); ?>
            </td>
            <td>
                <?php echo $form->textField($model,'username',array('size'=>25,'maxlength'=>255)); ?>
            </td>
            <td  class="alignRight">
                <?php echo Yii::t('BackEnd','Email'); ?>
            </td>
            <td>
                <?php echo $form->textField($model,'email',array('size'=>25,'maxlength'=>255)); ?>
            </td>
        </tr>
        <tr>
            <td  class="alignRight">
                <?php echo Yii::t('BackEnd','First name'); ?>
            </td>
            <td>
                <?php echo $form->textField($model,'first_name',array('size'=>25,'maxlength'=>255)); ?>
            </td>
            <td  class="alignRight">
                <?php echo Yii::t('BackEnd','Last name'); ?>
            </td>
            <td>
                <?php echo $form->textField($model,'last_name',array('size'=>25,'maxlength'=>255)); ?>
            </td>
            <td  class="alignRight">
                <?php echo Yii::t('BackEnd','Status'); ?>
            </td>
            <td>
                <?php echo $form->dropDownList($model,'status', AdminUser::model()->getStatusArray(Yii::t('BackEnd', '-- All --'))); ?>
            </td>
        </tr>
        <tr>
            <td  class="alignRight">
                <?php echo Yii::t('BackEnd','Phone'); ?>
            </td>
            <td>
                <?php echo $form->textField($model,'phone',array('size'=>25,'maxlength'=>255)); ?>
            </td>

            <td  class="alignRight">
                <?php echo Yii::t('BackEnd','Company'); ?>
            </td>
            <td>
                <?php echo $form->textField($model,'company',array('size'=>25,'maxlength'=>255)); ?>
            </td><td/>
            <td><?php echo CHtml::submitButton(Yii::t('Global', 'Search')); ?></td>
        </tr>
    </table>
<?php $this->endWidget(); ?>

</div><!-- search-form -->