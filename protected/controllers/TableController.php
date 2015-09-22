<?php

class TableController extends Controller
{
    /**
    * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
    * using two-column layout. See 'protected/views/layouts/column2.php'.
    */
    public $layout='//layouts/column1';

    /**
    * @return array action filters
    */
    public function filters()
    {
        return array(
        'accessControl', // perform access control for CRUD operations
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
                'actions'=>array('index','view','create','updateArrival','admin','update','excel','close'),
                'roles'=>array('user'),
            ),
            array('allow',
                'actions'=>array('excelall'),
                'roles'=>array('editor'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('delete'),
                'roles'=>array('administrator'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {

        if(isset($_POST['dateCompletion']) && isset($_POST['editorId'])) {

            $dateCompletion = $_POST['dateCompletion'];
            $editorId = (int)$_POST['editorId'];

            //Выбираем всех пользователей для редактора за заданный период из TableEditors
            $criteria = new CDbCriteria;
            $criteria->select = 'user_id, max(date_start) as max_date, editor_id';
            $criteria->condition = 'editor_id = :editorId AND date_start < DATE_ADD(LAST_DAY(:dateCompletion), INTERVAL 1 DAY)';
            $criteria->group = 'user_id';
            $criteria->order = 'user_id DESC';
            $criteria->params = array(
                ':dateCompletion' => $dateCompletion,
                ':editorId' => $editorId,
            );
            $result = TableEditors::model()->findAll($criteria);

            $newTableRows = array();
            $usersEditor = array();

            //порверяем есть табель для пользователя за заданный период в Table, если нет, создаём
            foreach($result AS $user){
                $usersEditor[] =  $user->user_id;
                if ( Table::model()->exists('user_id = :userId AND date_completion = :dateCompletion', array(':userId' => $user->user_id, ':dateCompletion' => $dateCompletion)) == '') {
                    $newTableRows[] = array('user_id' => $user->user_id, 'date_completion' => $dateCompletion);
                }
            }
            if (! empty($newTableRows)) {
                $builder=Yii::app()->db->schema->commandBuilder;
                $command=$builder->createMultipleInsertCommand('bvg_table', $newTableRows);
                $command->execute();

            }

            //выбираем все табеля пользователей для редактора за заданный период из Table
            $criteria = new CDbCriteria;
            //$criteria->select = 'user_id, date_completion';
            $criteria->condition = 'date_completion = :dateCompletion';
            $criteria->params = array(
                ':dateCompletion' => $dateCompletion,
            );
            $criteria->addInCondition('user_id', $usersEditor);
            $criteria->with = array('user');
            $criteria->order = 'user.last_name';
            $dataProvider = new CActiveDataProvider('Table',array(
                'criteria' => $criteria,
                'pagination'=>array(
                    'pageSize'=>50,
                ),
            ));
            $this->render('index', array(
                'dataProvider'=>$dataProvider,
                'editorId' => $editorId,
                'dateCompletion' => $dateCompletion,
            ));
            exit;


        }
        $this->render('index');
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
    * Creates a new model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    */
    public function actionCreate()
        {
        $modelTable=new Table;
        $modelUser = new User;

        $modelTable->unsetAttributes();
        $modelUser->unsetAttributes();
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['date_completion']) && isset($_POST['who_table']))
        {
            $editorId = (int)$_POST['who_table'];
            if (Table::model()->exists('editor_id=:editor_id AND date_completion =:date_completion',
                array(':editor_id'=>$editorId, ':date_completion' => $_POST['date_completion']))) throw new CHttpException(400,'Табель за данный период уже существует.');
            $users = User::model()->findAll(array('condition'=>'who_table=:who_table AND active=1','params'=>array(':who_table'=>$editorId)));

            foreach($users as $user)
            {
                $modelTable->user_id = $user->id;
                $modelTable->department_id = $user->id_post;
                $modelTable->editor_id = $editorId;
                $modelTable->date_completion = $_POST['date_completion'];
                if (!$modelTable->save()) throw new CHttpException(400,'Ошибка создание табеля.');
                $modelTable->unsetAttributes(array(
                   'user_id',
                   'department_id',
                   'editor_id',
                ));
                $modelTable->setIsNewRecord(true);
                $modelTable->setPrimaryKey(null);
            }


            $this->redirect(array('admin','editor_id'=>$editorId, 'date_completion'=>$_POST['date_completion']));
        }

        //$this->render('create',array(
        //    'modelTable'=>$modelTable,
        //    'modelUser'=>$modelUser,
        //));
    }

    /**
    * Updates a particular model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param integer $id the ID of the model to be updated
    */
    public function actionUpdate()
    {
        if (Yii::app()->request->isAjaxRequest && isset($_POST['pk']) && isset($_POST['value']) && isset($_POST['name'])){

            $code=$hours=0;
            $id =  (int)$_POST['pk'];
            if ($id != 0) {
                if ($_POST['name'] != 'vid_nadurochno' && $_POST['name'] != 'vid_vihidnih') {
                    $value = urlencode($_POST['value']);
                    $search = array('%C2%A0','+');
                    $value = str_replace($search,'',$value);
                    $value = urldecode($value);
                    $value = mb_strtoupper($value,'UTF-8');

                    if (strripos($value, '/')) {
                        $result = explode('/',$value);
                        $code =  $result[0];
                        $hours =  $result[1];
                    } else {
                        $code = $value;
                        $hours = 0;
                    }

                } elseif  ($_POST['name'] == 'vid_nadurochno') {
                    $vidNadurochno = $_POST['value'];
                } elseif ($_POST['name'] == 'vid_vihidnih') {
                    $vidVihidnih = $_POST['value'];
                }


                $model=Table::model()->findByPk($id);



                if (isset($vidNadurochno) && $model->vid_nadurochno != $vidNadurochno) {
                    $model->vid_nadurochno = $vidNadurochno;
                } elseif (isset($vidVihidnih) && $model->vid_vihidnih != $vidVihidnih) {
                    $model->vid_vihidnih = $vidVihidnih;
                } else {
                    //Предыдущее состояние полей
                    $previousCode = $model->{$_POST['name']."_code"};
                    $previousHours = $model->{$_POST['name']."_hours"};

                    $model->{$_POST['name']."_code"} = $code;
                    $model->{$_POST['name']."_hours"} = $hours;
                }




                if ($model->validate()){

                    if (isset($previousCode) && $previousCode == '' && $code != ''){

                        if ((int)$hours != 0) {
                            $model->vid_godin =  $model->vid_godin + $hours;
                            $model->vid_nichnih = $model->vid_nichnih + $hours;
                        }
                        if ((int)$code != 0) {
                            $model->dni_roboti = ++ $model->dni_roboti;
                            $model->vid_godin =  $model->vid_godin + $code;
                        } else {
                            switch ($code) {
                                case 'ВД': $model->vid_vidryadgenya = ++$model->vid_vidryadgenya; break;
                                case 'В': $model->neyavok_v = ++$model->neyavok_v; break;
                                case 'Д': $model->neyavok_d = ++$model->neyavok_d; break;
                                case 'Ч': $model->neyavok_ch = ++$model->neyavok_ch; break;
                                case 'Н': $model->neyavok_n = ++$model->neyavok_n; break;
                                case 'ДБ': $model->neyavok_db = ++$model->neyavok_db; break;
                                case 'ДО': $model->neyavok_do = ++$model->neyavok_do; break;
                                case 'ВП': $model->neyavok_vp = ++$model->neyavok_vp; break;
                                case 'ДД': $model->neyavok_dd = ++$model->neyavok_dd; break;
                                case 'НА': $model->neyavok_na = ++$model->neyavok_na; break;
                                case 'ІН': $model->neyavok_in = ++$model->neyavok_in; break;
                                case 'ПР': $model->neyavok_pr = ++$model->neyavok_pr; break;
                                case 'ТН': $model->neyavok_tn = ++$model->neyavok_tn; break;
                                case 'НН': $model->neyavok_nn = ++$model->neyavok_nn; break;
                                case 'І': $model->neyavok_i = ++$model->neyavok_i; break;
                                //case 'Х': $model->vid_vihidnih = ++$model->vid_vihidnih; break;
                            }
                        }

                    } elseif (isset($previousCode) && $previousCode != '' && $code != ''){

                        if ($previousCode != $code) {


                            if ((int)$previousCode != 0) {
                                $model->dni_roboti = -- $model->dni_roboti;
                                $model->vid_godin = $model->vid_godin - $previousCode;
                            } else {
                                switch ($previousCode) {
                                    case 'ВД': $model->vid_vidryadgenya = --$model->vid_vidryadgenya; break;
                                    case 'В': $model->neyavok_v = --$model->neyavok_v; break;
                                    case 'Д': $model->neyavok_d = --$model->neyavok_d; break;
                                    case 'Ч': $model->neyavok_ch = --$model->neyavok_ch; break;
                                    case 'Н': $model->neyavok_n = --$model->neyavok_n; break;
                                    case 'ДБ': $model->neyavok_db = --$model->neyavok_db; break;
                                    case 'ДО': $model->neyavok_do = --$model->neyavok_do; break;
                                    case 'ВП': $model->neyavok_vp = --$model->neyavok_vp; break;
                                    case 'ДД': $model->neyavok_dd = --$model->neyavok_dd; break;
                                    case 'НА': $model->neyavok_na = --$model->neyavok_na; break;
                                    case 'ІН': $model->neyavok_in = --$model->neyavok_in; break;
                                    case 'ПР': $model->neyavok_pr = --$model->neyavok_pr; break;
                                    case 'ТН': $model->neyavok_tn = --$model->neyavok_tn; break;
                                    case 'НН': $model->neyavok_nn = --$model->neyavok_nn; break;
                                    case 'І': $model->neyavok_i = --$model->neyavok_i; break;
                                    //case 'Х': $model->vid_vihidnih = --$model->vid_vihidnih; break;
                                }
                            }
                            if ((int)$code != 0) {
                                $model->dni_roboti = ++ $model->dni_roboti;
                                $model->vid_godin =  $model->vid_godin + $code;
                            }
                            else {
                                switch ($code) {
                                    case 'ВД': $model->vid_vidryadgenya = ++$model->vid_vidryadgenya; break;
                                    case 'В': $model->neyavok_v = ++$model->neyavok_v; break;
                                    case 'Д': $model->neyavok_d = ++$model->neyavok_d; break;
                                    case 'Ч': $model->neyavok_ch = ++$model->neyavok_ch; break;
                                    case 'Н': $model->neyavok_n = ++$model->neyavok_n; break;
                                    case 'ДБ': $model->neyavok_db = ++$model->neyavok_db; break;
                                    case 'ДО': $model->neyavok_do = ++$model->neyavok_do; break;
                                    case 'ВП': $model->neyavok_vp = ++$model->neyavok_vp; break;
                                    case 'ДД': $model->neyavok_dd = ++$model->neyavok_dd; break;
                                    case 'НА': $model->neyavok_na = ++$model->neyavok_na; break;
                                    case 'ІН': $model->neyavok_in = ++$model->neyavok_in; break;
                                    case 'ПР': $model->neyavok_pr = ++$model->neyavok_pr; break;
                                    case 'ТН': $model->neyavok_tn = ++$model->neyavok_tn; break;
                                    case 'НН': $model->neyavok_nn = ++$model->neyavok_nn; break;
                                    case 'І': $model->neyavok_i = ++$model->neyavok_i; break;
                                   // case 'Х': $model->vid_vihidnih = ++$model->vid_vihidnih; break;
                                }
                            }

                        }

                        if ($previousHours != $hours) {

                            if ((int)$previousHours != 0) {
                                $model->vid_godin =  $model->vid_godin - $previousHours;
                                $model->vid_nichnih = $model->vid_nichnih - $previousHours;
                            }
                            if ((int)$hours != 0){
                                $model->vid_godin =  $model->vid_godin + $hours;
                                $model->vid_nichnih = $model->vid_nichnih + $hours;
                            }
                        }
                    } elseif (isset($previousCode) && $previousCode != '' && $code == '') {


                        if ((int)$previousCode != 0) {
                            $model->dni_roboti = -- $model->dni_roboti;
                            $model->vid_godin = $model->vid_godin - $previousCode;
                        } else {
                            switch ($previousCode) {
                                case 'ВД': $model->vid_vidryadgenya = --$model->vid_vidryadgenya; break;
                                case 'В': $model->neyavok_v = --$model->neyavok_v; break;
                                case 'Д': $model->neyavok_d = --$model->neyavok_d; break;
                                case 'Ч': $model->neyavok_ch = --$model->neyavok_ch; break;
                                case 'Н': $model->neyavok_n = --$model->neyavok_n; break;
                                case 'ДБ': $model->neyavok_db = --$model->neyavok_db; break;
                                case 'ДО': $model->neyavok_do = --$model->neyavok_do; break;
                                case 'ВП': $model->neyavok_vp = --$model->neyavok_vp; break;
                                case 'ДД': $model->neyavok_dd = --$model->neyavok_dd; break;
                                case 'НА': $model->neyavok_na = --$model->neyavok_na; break;
                                case 'ІН': $model->neyavok_in = --$model->neyavok_in; break;
                                case 'ПР': $model->neyavok_pr = --$model->neyavok_pr; break;
                                case 'ТН': $model->neyavok_tn = --$model->neyavok_tn; break;
                                case 'НН': $model->neyavok_nn = --$model->neyavok_nn; break;
                                case 'І': $model->neyavok_i = --$model->neyavok_i; break;
                                //case 'Х': $model->vid_vihidnih = --$model->vid_vihidnih; break;
                            }
                        }
                        if ((int)$previousHours != 0) {
                            $model->vid_godin =  $model->vid_godin - $previousHours;
                            $model->vid_nichnih = $model->vid_nichnih - $previousHours;
                        }
                    }

                    if($model->save())
                        echo CJSON::encode(array(
                            'success' => true,
                            'id' => $model->primaryKey,
                            'dni_roboti' => $model->dni_roboti,
                            'vid_godin' => $model->vid_godin,
                            'vid_nichnih' => $model->vid_nichnih,
                            'vid_nadurochno' => $model->vid_nadurochno,
                            'vid_vihidnih' => $model->vid_vihidnih,
                            'vid_vidryadgenya' => $model->vid_vidryadgenya,
                            'neyavok_dniv' => $model->neyavok_dniv,
                            'neyavok_godin' => $model->neyavok_godin,
                            'neyavok_v' => $model->neyavok_v,
                            'neyavok_d' => $model->neyavok_d,
                            'neyavok_ch' => $model->neyavok_ch,
                            'neyavok_n' => $model->neyavok_n,
                            'neyavok_db' => $model->neyavok_db,
                            'neyavok_do' => $model->neyavok_do,
                            'neyavok_vp' => $model->neyavok_vp,
                            'neyavok_dd' => $model->neyavok_dd,
                            'neyavok_na' => $model->neyavok_na,
                            'neyavok_in' => $model->neyavok_in,
                            'neyavok_pr' => $model->neyavok_pr,
                            'neyavok_tn' => $model->neyavok_tn,
                            'neyavok_nn' => $model->neyavok_nn,
                            'neyavok_i' => $model->neyavok_i,
                        ));

                } else {

                    //$errors = array_map(function($v){ return join(', ', $v); }, $model->getErrors());
                    //echo CJSON::encode(array('errors' => $errors));
                    //echo 'Ошибка ввода';
                    //echo json_encode(array('error' => $model->getErrors()));
                   throw new CHttpException(500,'Ошибка ввода.');
                }
            }
        }
    }

    /**
    * Deletes a particular model.
    * If deletion is successful, the browser will be redirected to the 'admin' page.
    * @param integer $id the ID of the model to be deleted
    */
    public function actionDelete($id)
    {
        if(Yii::app()->request->isPostRequest)
        {
        // we only allow deletion via POST request
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
        throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }



    /**
    * Manages all models.
    */
    public function actionAdmin()
    {

        $criteria = new CDbCriteria;


        if(isset($_GET['editor_id']) && isset($_GET['date_completion'])) {
            $dateCompletion = $_GET['date_completion'];
            $monthOfDay = substr($dateCompletion,5,2);
            $yearOfDay = substr($dateCompletion,0,4);
            $daysMonth = cal_days_in_month(CAL_GREGORIAN, $monthOfDay, $yearOfDay);
            $editorAttrib = User::model()->findByPk((int)$_GET['editor_id']);
            $dateForTitle = Yii::app()->dateFormatter->format("MMMM y", $dateCompletion);
            $criteria->condition = 'editor_id=:editor_id AND date_completion=:date_completion';
            $criteria->params = array(':editor_id'=>(int)$_GET['editor_id'], ':date_completion'=>$dateCompletion);
            $editor_id = (int)$_GET['editor_id'];
        } else {
            $editorAttrib = '';
            $editor_id = 0;
            $dateCompletion = '';
            $dateForTitle = '';
            $daysMonth = '';
            $monthOfDay = '';
            $yearOfDay ='';
            $criteria->condition = 'date_completion=:date_completion';
            $criteria->params = array(':date_completion'=>0);
        }

        $criteria->with = array('user');
        $criteria->order = 'user.last_name';
        $dataProvider = new CActiveDataProvider('Table',array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 100,
            ),

        ));
        $this->render('admin',array(
            'dataProvider'=>$dataProvider,
            'editorAttrib' =>  $editorAttrib,
            'dateForTitle' => $dateForTitle,
            'daysMonth' => $daysMonth,
            //'dateCompletion' => $dateCompletion,
            'monthOfDay' => $monthOfDay,
            'yearOfDay' => $yearOfDay,
            'editor_id' => $editor_id,
            'dateCompletion' => $dateCompletion,

        ));
    }

    public function actionExcel() {

        if(isset($_GET['editor_id']) && isset($_GET['date_completion'])) {

            $criteria = new CDbCriteria;

            $editorId = (int)$_GET['editor_id'];
            $dateCompletion = $_GET['date_completion'];

            $criteria->condition = 'editor_id=:editorId AND date_completion=:dateCompletion';
            $criteria->params = array(':editorId'=>$editorId, ':dateCompletion'=>$dateCompletion);
            $criteria->with = array('user');
            $criteria->order = 'user.last_name';
            $dataProvider = new CActiveDataProvider('Table',array(
                'criteria' => $criteria,
                'pagination' => array(
                    'pageSize' => 100,
                ),

            ));
            $this->render('excel',array(
                'dataProvider'=>$dataProvider,
                'daysMonth' => $_GET['daysMonth'],
                'title' =>  $_GET['title'],
                //'editorId' =>  $editorId,
                //'dateForTitle' => $dateForTitle,
                //'daysMonth' => $daysMonth,
                //'dateCompletion' => $dateCompletion,
                //'monthOfDay' => $monthOfDay,
                //'yearOfDay' => $yearOfDay,

            ));

        }

    }

    public function actionExcelAll() {

        if(isset($_GET['date_completion'])) {

            $criteria = new CDbCriteria;

            $dateCompletion = $_GET['date_completion'];

            $criteria->condition = 'date_completion=:dateCompletion';
            $criteria->params = array(':dateCompletion'=>$dateCompletion);
            $criteria->with = array('user');
            $criteria->order = 'user.last_name, user.name, user.middle_name';
            $dataProvider = new CActiveDataProvider('Table',array(
                'criteria' => $criteria,
                'pagination' => array(
                    'pageSize' => 300,
                ),

            ));
            $this->render('excelall',array(
                'dataProvider'=>$dataProvider,
                'daysMonth' => $_GET['daysMonth'],
                'title' =>  $_GET['title'],
                //'editorId' =>  $editorId,
                //'dateForTitle' => $dateForTitle,
                //'daysMonth' => $daysMonth,
                //'dateCompletion' => $dateCompletion,
                //'monthOfDay' => $monthOfDay,
                //'yearOfDay' => $yearOfDay,

            ));

        }

    }

    public function actionClose() {
        if (isset($_GET['editor_id']) && isset($_GET['date_completion']) && isset($_GET['close'])) {

            $model = new Table();
            $model->unsetAttributes();
            $model->updateAll(array('period_1' => (int)$_GET['close']), 'editor_id = :editor_id AND date_completion = :date_completion', array(
                ':editor_id' => (int)$_GET['editor_id'],
                ':date_completion' => $_GET['date_completion'],
            ));

            $editorAttrib = '';
            $editor_id = 0;
            $dateCompletion = '';
            $dateForTitle = '';
            $daysMonth = '';
            $monthOfDay = '';
            $yearOfDay ='';

            $this->render('admin', array(
                'editorId' => $editor_id,
                'editorAttrib' =>  $editorAttrib,
                'dateForTitle' => $dateForTitle,
                'daysMonth' => $daysMonth,
                'monthOfDay' => $monthOfDay,
                'yearOfDay' => $yearOfDay,
                'dateCompletion' => $dateCompletion,

            ));


        }
    }

    /**
    * Returns the data model based on the primary key given in the GET variable.
    * If the data model is not found, an HTTP exception will be raised.
    * @param integer the ID of the model to be loaded
    */
    public function loadModel($id)
    {
        $model=Table::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='table-form')
        {
        echo CActiveForm::validate($model);
        Yii::app()->end();
        }
    }
}
