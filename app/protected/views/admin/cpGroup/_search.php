<div class="wide form">
    <table>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
    )); ?>

        <tr>
            <td class="alignRight">
                <?php echo Yii::t('BackEnd','id'); ?>
                <?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
            </td>
            <td>
                <?php echo Yii::t('BackEnd','name'); ?>
                <?php echo $form->textField($model,'name',array('size'=>40,'maxlength'=>255)); ?>
            </td>
             <td class="alignLeft">
                <?php echo Yii::t('BackEnd','sorder'); ?>
                <?php echo $form->textField($model,'sorder',array('size'=>5,'maxlength'=>10)); ?>
                 <?php echo CHtml::submitButton(Yii::t('Global','Search')); ?>
             </td>
        </tr>
    </table>

<?php $this->endWidget(); ?>

</div><!-- search-form -->