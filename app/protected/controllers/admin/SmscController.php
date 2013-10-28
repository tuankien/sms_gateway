<?php
/*
 * SmscController
 */
class SmscController extends SBaseController
{
    public $layout='main';

	private $_model;

    public function actionView()
	{
        $this->layout="detail";
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

    public function actionCreate()
	{
		$model=new Smsc;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Smsc']))
		{
			$model->attributes=$_POST['Smsc'];
            if($_POST['Smsc']['smsc'] !='')
            {
                if($model->insert())
                    $this->redirect(array('view','id'=>$model->id));
            }
        }

        $this->layout="detail";
		$this->render('create',array(
			'model'=>$model,
		));
	}

    public function actionUpdate()
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Smsc']))
		{
			$model->attributes=$_POST['Smsc'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

        $this->layout="detail";
		$this->render('update',array(
			'model'=>$model,
		));
	}

    public function actionDelete()
	{
		if(isset($_POST['select-row'])&&is_array($_POST['select-row']))
        {
            $ids = $_POST['select-row'];
            $ids = implode(',', $ids);
            Smac::model()->deleteAll("id in ($ids)");

            $this->redirect(array('admin'));
        }
		elseif(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}


    public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Smsc');
        $this->layout="list";
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

    public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Smsc::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}


    protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cp-group-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
?>
