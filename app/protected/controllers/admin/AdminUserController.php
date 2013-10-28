<?php

class AdminUserController extends SBaseController
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
		$model = new AdminUser;
        $model->setScenario('create');
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AdminUser']))
		{
			$model->attributes=$_POST['AdminUser'];
			if($model->validate())
            {
                $model->password = UserIdentity::genPassword($model->password);
                $model->save();
				$this->redirect(array('view','id'=>$model->id));
            }
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
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AdminUser']))
		{
            $password = $model->password;
            $model->attributes=$_POST['AdminUser'];
			if($_POST['AdminUser']['password'] != "")
            {
                $password = UserIdentity::genPassword($_POST['AdminUser']['password']);
            }
            
            if($model->validate())
            {
                $model->password = $password;                
                $model->save();
				$this->redirect(array('view','id'=>$model->id));
            }
		}

        $model->password = "";
        $this->layout="detail";
		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
            $model = $this->loadModel();
            $model->status = AdminUser::STATUS_INACTIVED;
            $model->update();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

    public function actionDeleteAll(){
        if(isset($_POST['select-row'])&&is_array($_POST['select-row']))
        {
            $ids = $_POST['select-row'];
            if($ids)
            {
                $ids = implode(',', $ids);
                AdminUser::model()->updateAll(array('status'=>AdminUser::STATUS_INACTIVED), "id in ($ids)");
            }
            $this->redirect(array('admin'));
        }else{
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
    }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $dataProvider=new CActiveDataProvider('AdminUser');
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
		$model=new AdminUser('search');
        $model->status = '';
        
		if(isset($_GET['AdminUser']))
			$model->attributes=$_GET['AdminUser'];

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
				$this->_model=AdminUser::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='admin-user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    /* Sao chép thông tin NSD */
    public function actionDuplicate()
	{
		$model=$this->loadModel();
		
		if(isset($_POST['AdminUser']))
		{
            $model = new AdminUser('duplicate');
            
            $password = $model->password;
            $model->attributes=$_POST['AdminUser'];
			if($_POST['AdminUser']['password'] != "")
            {
                $password = UserIdentity::genPassword($_POST['AdminUser']['password']);
            }

            if($model->validate())
            {
                $model->password = $password;
                if($model->save())
                {
                    $adminAssignModel = AdminAccessAssigns::model()->findAllByAttributes(array("userid" => $model->id));

                    //cho danh sách các quyền này vào một mảng
                    foreach($adminAssignModel as $adminAssign)
                    {
                        $admin_assign_list[] = $adminAssign;
                    }
                    
                    if(count($admin_assign_list) > 0)
                    {
                        foreach($admin_assign_list as $rows)
                        {
                            $adminAccess =  new AdminAccessAssigns;

                            $adminAccess-> itemname = $rows->itemname;
                            $adminAccess-> userid = $model->id;
                            $adminAccess-> bizrule = $rows->bizrule;
                            $adminAccess-> data = $rows->data;
                            $adminAccess->save();
                        }
                    }
                }

				$this->redirect(array('view','id'=>$model->id));
            }
		}

        $model->password = "";
        $this->layout="detail";
		$this->render('duplicate',array(
			'model'=>$model,
		));
	}
}
