<div class="wide form">    
    <?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
    )); ?>
    <table>
        <tr>
            <td class="alignRight"><?php echo Yii::t('BackEnd','name'); ?></td>
            <td><?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>45)); ?></td>
        
            <td class="alignRight"><?php echo Yii::t('BackEnd','value'); ?></td>
            <td><?php echo $form->textField($model,'value',array('size'=>30,'maxlength'=>255)); ?></td>
       
            <td colspan="2" class="center"><?php echo CHtml::submitButton(Yii::t('Global','Search')); ?></td>
        </tr>
    </table>

<?php $this->endWidget(); ?>

</div><!-- search-form -->