<?php
class SiteController extends CController {
    public function actionIndex() {
        echo "<h1>Welcome to SMS GW</h1>";
        Yii::app()->end();
    }
}
?>