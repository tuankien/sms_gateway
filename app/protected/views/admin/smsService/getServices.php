<div class="grid-view">
<table class="items">
    <tr>
        <th><?php echo Yii::t("BackEnd", "id") ?></th>
        <th><?php echo Yii::t("BackEnd", "keywword") ?></th>
        <th><?php echo Yii::t("BackEnd", "Cp name") ?></th>
        <th><?php echo Yii::t("BackEnd", "smsc") ?></th>
    </tr>
    <?php foreach($smsServices as $smsService): ?>
    <tr>
        <td class="center"><?php echo $smsService->id ?></td>
        <td><?php echo $smsService->keyword ?></td>
        <td><?php echo $smsService->cp->name ?></td>
        <td><?php echo $smsService->smsc ?></td>
    </tr>
    <?php endforeach; ?>
</table>
</div>