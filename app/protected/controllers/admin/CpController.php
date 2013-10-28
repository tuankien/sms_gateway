<?php

class CpController extends SBaseController
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

        $model = $this->loadModel();
        $model->created_time = Yii::app()->dateFormatter->formatDateTime($model->created_time, 'full', 'medium');
        $model->updated_time = Yii::app()->dateFormatter->formatDateTime($model->updated_time, 'full', 'medium');
        $model->created_by = AdminUser::model()->findByPk($model->created_by)->username;

//        if($model->status) $model->status = Yii::t('BackEnd', 'Actived');
//        else $model->status = Yii::t('BackEnd', 'Not active');

		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{   
		$model = new Cp();
        $model->group_id = "";
        $model->status = Cp::STATUS_ENABLED;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

        $modelSmsc = Smsc::model()->findAll(array('order'=>'id DESC, smsc ASC'));
        
		if(isset($_POST['Cp']))
		{
			$model->attributes=$_POST['Cp'];

            $smsc = $_POST['Cp']['smsc'];
            if($smsc != '' && $smsc != 'ALL')
            {
                $smsc = explode(',', $smsc);
                foreach($smsc as $k =>$value)
                {
                    $modelSmsc =  new Smsc;
                    $findSmsc = Smsc::model()->findAllByAttributes(array('smsc'=>trim($value)));
                    if(count($findSmsc) == 0)
                    {
                        $modelSmsc->id = 0;
                        $modelSmsc->smsc = trim($value);
                        //$model->insert();
                        $modelSmsc->save();
                    }
                }
            }
            $model->created_time = date('Y-m-d H:m:s');
            $model->updated_time = date('Y-m-d H:m:s');
            $model->created_by  = Yii::app()->user->id;

			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

        $this->layout="detail";
		$this->render('create',array(
			'model'=>$model,
            'modelSmsc'=>$modelSmsc,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

        //$modelSmsc = Smsc::model()->findAll();
        $modelSmsc = Smsc::model()->findAll(array('order'=>'smsc'));
        
		if(isset($_POST['Cp']))
		{
			$model->attributes=$_POST['Cp'];

            $smsc = $_POST['Cp']['smsc'];
            if($smsc != '' && $smsc != 'ALL')
            {
                $smsc = explode(',', $smsc);
                foreach($smsc as $k =>$value)
                {
                    $modelSmsc =  new Smsc;
                    $findSmsc = Smsc::model()->findAllByAttributes(array('smsc'=>trim($value)));
                    if(count($findSmsc) == 0)
                    {
                        $modelSmsc->id = 0;
                        $modelSmsc->smsc = trim($value);
                        //$model->insert();
                        $modelSmsc->save();
                    }
                }
            }
            
            $model->updated_time = date('Y-m-d H:m:s');

			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

        $this->layout="detail";
		$this->render('update',array(
			'model'=>$model,
            'modelSmsc'=>$modelSmsc,
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
            SmsService::model()->deleteAll("id in ($ids)");
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
        $cp_groups = CpGroup::dumpAllCpGroup();
        if(count($cp_groups)==0)
        {
            Yii::app()->user->setFlash('no-cp-group', Yii::t('FrontEnd','First, you have to create the cp group'));
            if(UserAccess::checkAccess('cpGroupCreate'))
            {
                $this->redirect ('/cpGroup/create');
            }
             else
             {
                 $this->redirect ('/');
             }
        }

        $group_id = ($_GET['group_id'])?$_GET['group_id']: $cp_groups[0]->id;

        $model = new Cp('search');
        $model->name = '';
        $model->smsc = '';
        $model->username = '';
        $model->password = '';
        $model->created_by = '';
        $model->status = '';
        
        if(!empty($group_id))
        {
            $model->group_id = $group_id;
        }
        $dataProvider = $model->search();
		//$dataProvider = new CActiveDataProvider('Cp');

        $this->layout="list";

        $this->render('index',array(
            'cp_groups'=>$cp_groups,
			'dataProvider'=>$dataProvider,
            'group_id'=>$group_id,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$cp_groups = CpGroup::dumpAllCpGroup();
        if(count($cp_groups)==0)
        {
            Yii::app()->user->setFlash('no-cp-group', Yii::t('FrontEnd','First, you have to create the cp group'));
            if(UserAccess::checkAccess('cpGroupCreate'))
            {
                $this->redirect ('/cpGroup/create');
            }
             else
             {
                 $this->redirect ('/');
             }
        }

        $group_id = ($_GET['group_id'])?$_GET['group_id']: $cp_groups[0]->id;

        $model = new Cp('search');
        $model->name = '';
        $model->group_id = '';
        $model->smsc = '';
        $model->username = '';
        $model->password = '';
        $model->created_by = '';
        $model->status = '';

        if(!empty($group_id))
        {
            $model->group_id = $group_id;
        }

		if(isset($_GET['Cp']))
			$model->attributes=$_GET['Cp'];

        $this->layout="list";
		$this->render('admin',array(
			'model'=>$model,
            'cp_groups'=>$cp_groups,
//			'dataProvider'=>$dataProvider,
            'group_id'=>$group_id,
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
				$this->_model=Cp::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='cp-form')
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
            $model = Cp::model()->findByPk($_POST['id']);
            if($model->status == Cp::STATUS_ENABLED) $model->status = Cp::STATUS_DISABLED;
            elseif($model->status == Cp::STATUS_DISABLED) $model->status = Cp::STATUS_ENABLED;
            $model->save();
            Yii::app()->end();
        }else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }
}
