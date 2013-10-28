<?php

class SmsServiceController extends SBaseController
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
	 * Displays a particular model.
	 */
	public function actionView()
	{
        $this->layout="detail";
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new SmsService();
        $model->status = SmsService::STATUS_ENABLED;

        //$modelSmsc = Smsc::model()->findAll(array('order'=>'smsc'));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SmsService']))
		{
			$model->attributes=$_POST['SmsService'];

            if($model->protocol == 'SOAP')
            {
                $model->setScenario('soap');
            }

            $model->created_time = date('Y-m-d H:m:s');

            if($model->save()) $this->redirect(array('view','id'=>$model->id));
        }

        $this->layout="detail";
		$this->render('create',array(
			'model'=>$model,
		));
	}

    /**
	 * Duplicate a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionDuplicate()
	{
		$model=$this->loadModel();
        $model->status = SmsService::STATUS_ENABLED;

        //$modelSmsc = Smsc::model()->findAll(array('order'=>'smsc'));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SmsService']))
		{
            $model = new SmsService();
			$model->attributes=$_POST['SmsService'];

            if($model->protocol == 'SOAP')
            {
                $model->setScenario('soap');
            }

            $model->created_time = date('Y-m-d H:m:s');

            if($model->save()) $this->redirect(array('view','id'=>$model->id));
        }

        $this->layout="detail";
		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();

        $modelSmsc = Smsc::model()->findAll(array('order'=>'smsc'));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SmsService']))
		{
            $model->attributes=$_POST['SmsService'];

            if($model->protocol == 'SOAP')
            {
                $model->setScenario('soap');
            }

            if($model->save()) $this->redirect(array('view','id'=>$model->id));
		}

        $this->layout="detail";
		$this->render('update',array(
			'model'=>$model
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isAjaxRequest && $_POST['ids'])
        {
            $ids = $_POST['ids'];
            $ids = implode(",", $ids);
//            SmsService::model()->deleteAll("id in ($ids)");
            echo $this->createUrl('admin');
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

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider(
            'SmsService',
            array(
                'criteria'=>array('order'=>'cp_id, smsc, keyword'),
                'pagination'=>array('pageSize'=>Yii::app()->params['pageSize']),
            )
        );
        $this->layout="list";
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new SmsService('search');

        //Reset attributes values
        $model->cp_id = "";
        $model->status = '';
        $model->updated_by = "";

		if(isset($_GET['SmsService']))
			$model->attributes=$_GET['SmsService'];

        $this->layout="list";
		$this->render('admin',array(
			'model'=>$model,
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
				$this->_model=SmsService::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='sms-service-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    /**
     * Disable/Enable item action
     */
    public function actionChangeStatus(){
        if($_POST['ajax']&&$_POST['id']){
            $model = SmsService::model()->findByPk($_POST['id']);
            if($model->status == SmsService::STATUS_ENABLED) $model->status = SmsService::STATUS_DISABLED;
            elseif($model->status == SmsService::STATUS_DISABLED) $model->status = SmsService::STATUS_ENABLED;
            $model->save();
            Yii::app()->end();
        }else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    public function actionGetServices() {
        $keyword    = $_GET['keyword'];
        $smsc       = $_GET['smsc'];

        $smsServices = SmsService::getServices($keyword, $smsc);
        $this->renderPartial("getServices", array("smsServices" => $smsServices));
    }
}
