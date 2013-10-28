<?php
Class UserAccess
{
    public static function checkAccess($accessName) {
        if(Yii::app()->user->id == 1) return true;
        else return Yii::app()->user->checkAccess($accessName);
    }
}
?>
