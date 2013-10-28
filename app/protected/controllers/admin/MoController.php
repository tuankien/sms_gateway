<?php
class MoController extends SBaseController
{
    /**
	 * @var string the default layout for the views. Defaults to 'column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='main';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $userId = Yii::app()->user->id;
        $criteria= new CDbCriteria;
        $criteria->select = 'GROUP_CONCAT(id SEPARATOR ",") as id';
        $criteria->condition = 'admin_id = ' . $userId;
        $cpList = Cp::model()->find($criteria)->id;

		$model=new Mo('search');
        $model->status = '';
        $model->cp_id = $cpList;

 		if(isset($_GET['Mo']))
        {
			$model->attributes=$_GET['Mo'];
            if(!$_GET['cp_id'])
            {
                $model->cp_id = $cpList;
            }
        }

        $this->layout="list";
		$this->render('index',array(
			'model' => $model,
            'cpList' => $cpList,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Mo::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='mo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
?>