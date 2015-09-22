<?php

class HelpdeskController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create'),
				'roles'=>array('user'),
			),
			array('allow',
                'actions'=>array('indexAdm','delete','admin','update','createAdm'),
                'roles'=>array('administrator'),
            ),
            array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

    /**
     * Создаёт новую проблему, от пользователей.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $model=new Helpdesk;

        if(isset($_POST['Helpdesk']))
        {

            $model->attributes=$_POST['Helpdesk'];
            $model->id_user = Yii::app()->user->id;
            $model->id_status = 1;
            //var_dump($model->attributes);
            //exit;
            if($model->save())
                $this->redirect(array('index'));
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }


        /**
     * Создаёт новую проблему, от администраторов.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreateAdm()
    {
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $model=new Helpdesk;

        if(isset($_POST['Helpdesk']))
        {
            $model->attributes=$_POST['Helpdesk'];
            //var_dump($model->attributes);
            //exit;

            if($model->save())
                $this->redirect(array('indexadm'));
        }

        $this->render('createadm',array(
            'model'=>$model,
        ));
    }




	/**
	 * Редактировать проблему, только администраторы.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);


        if(isset($_POST['Helpdesk']))
		{
            $model->attributes=$_POST['Helpdesk'];
            //$model->start_time=$_POST['Helpdesk']['start_time'];
            //$model->finish_time=$_POST['Helpdesk']['finish_time'];
            if($model->save())
				$this->redirect(array('indexadm'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Показывает все заявки пользователя
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Helpdesk', array(
            'criteria'=> new CDbCriteria,
        ));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

    /**
     * Показывает все заявки всех пользователей, для администраторов
     */
    public function actionIndexAdm()
    {
        $model = new Helpdesk();
        $this->render('indexadm',array(
            'model' => $model,
        ));
    }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Helpdesk('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Helpdesk']))
			$model->attributes=$_GET['Helpdesk'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Helpdesk::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='helpdesk-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
