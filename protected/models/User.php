<?php

/**
 * This is the model class for table "bvg_user".
 *
 * The followings are the available columns in table 'bvg_user':
 * @property integer $id
 * @property integer $ident_code
 * @property string $login
 * @property string $password
 * @property string $name
 * @property string $last_name
 * @property string $middle_name
 * @property string $gender
 * @property string $email
 * @property integer $tel_int
 * @property integer $tel_mobile
 * @property string $post
 * @property integer $mode
 * @property integer $invalid
 * @property integer $sovmestitel
 * @property integer $education
 * @property integer $tbl_number
 * @property integer $editor_table
 * @property string $passport
 * @property string $passport_vidan
 * @property string $passport_date
 * @property string $birthday
 * @property string $last_visit
 * @property integer $role
 *
 * The followings are the available model relations:
 * @property BvgDepartment $department
 */
class User extends CActiveRecord
{
    public $verifyPassword;
    public $newPassword;
    public $post_post;
    public $editor;
    public $hired_date_start;
    public $fired_date_start;
    public $shortName;

    //public $fired_date_start;



    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bvg_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login, name, last_name, middle_name, id_post, birthday', 'required', 'on' => 'insert, update'),
            array('editor, hired_date_start', 'required', 'on' => 'insert'),
			array('tel_int, tel_mobile, id_post, editor_table, ident_code, gender, mode, tbl_number, invalid, sovmestitel, education, active', 'numerical', 'integerOnly'=>true, 'on' => 'insert, update'),
            array('newPassword, verifyPassword', 'required','on'=>'changepass'),
            array('newPassword, verifyPassword', 'length', 'max'=>20, 'min'=>5, 'on'=>'changepass'),
            array('verifyPassword', 'compare', 'compareAttribute'=>'newPassword', 'message' => "Пароли не совпадают.",'on'=>'changepass'),
			array('passport_vidan, password', 'length', 'max'=>200, 'on' => 'insert, update'),
			array('name,  email, login, role, passport', 'length', 'max'=>30, 'on' => 'insert, update'),
			array('birthday, passport_date,fired_date_start', 'date', 'format'=>'m.d.yyyy', 'on' => 'insert, update'),
            array('hired_date_start', 'date', 'format'=>'m.d.yyyy', 'on'=>'insert'),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, tbl_number, login, password, name, last_name, middle_name, email, tel_int, tel_mobile, birthday, last_visit, role, post_post, ident_code, editor_table, mode', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			//'sub_department' => array(self::BELONGS_TO, 'SubDepartment', 'id_sub_department'),
            'rights' => array(self::BELONGS_TO, 'UserRole', 'role'),
            'dateHired'=>array(self::BELONGS_TO,'TableAttributes','', 'foreignKey' => array('id'=>'user_id'),'condition'=>'attribute = 1'),
            'dateFired'=>array(self::BELONGS_TO,'TableAttributes','', 'foreignKey' => array('id'=>'user_id'),'condition'=>'attribute = 2'),
            'post' => array(self::BELONGS_TO, 'Department', 'id_post'),
            'helpdesk' => array(self::HAS_MANY, 'Helpdesk', 'id_user'),
            'departure' => array(self::HAS_MANY, 'Departure', 'id_user'),
            'table' => array(self::HAS_MANY, 'Table', 'user_id'),
            'departure_order' => array(self::HAS_MANY, 'Departure', 'order'),
            'pass' => array(self::HAS_MANY, 'Pass', 'id_user'),
            'table_attributes' => array(self::HAS_MANY, 'TableAttributes', 'user_id'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
            'tbl_number' => 'Табельный номер',
            'ident_code' => 'Идентификационный код',
            'login' => 'Логин',
			'password' => 'Пароль',
			'name' => 'Имя',
			'last_name' => 'Фамилия',
			'middle_name' => 'Отчество',
            'gender' => 'Пол',
			'email' => 'Email',
			'tel_int' => 'Тел внут',
			'tel_mobile' => 'Тел мобильный',
			'id_post' => 'Должность',
            'editor_table' => 'Редактор табеля',
            'editor' => 'Кто табелирует',
            'mode' => 'Режим работы',
            'sovmestitel' => 'Совместитель',
            'invalid' => 'Инвалид',
            'education' => 'Образование',
            'passport' => 'Серия, номер паспорта',
            'passport_vidan' => 'Кем выдан паспорт',
            'passport_date' => 'Дата выдачи паспорта',
            'post_post' => 'Должность',
            'birthday' => 'День рождения',
			'last_visit' => 'Last Visit',
			'role' => 'Права',
            'newPassword' => 'Новый пароль',
            'verifyPassword' => 'Повторить пароль',
            'active' => 'Статус',
            'hired_date_start' => 'Принят на работу',
            'fired_date_start' => 'Уволен',
        );
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($params = NULL)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.



		$criteria=new CDbCriteria;

        if (isset($params)) {
            if (isset($params['pageSize'])) $pageSize = (int)$params['pageSize'];
            if (isset($params['condition'])) $criteria->condition = 'tel_int != 0';

        } else {
            $pageSize = 50;
        }

        //$criteria->condition = 'email != "" OR tel_int != 0 OR tel_mobile != 0';

        $criteria->compare('id',$this->id);
        $criteria->compare('tbl_number',$this->tbl_number,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
        $criteria->compare('ident_code',$this->ident_code,true);
        $criteria->compare('name',$this->name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('middle_name',$this->middle_name,true);
        $criteria->compare('gender',$this->gender,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('tel_int',$this->tel_int);
		$criteria->compare('tel_mobile',$this->tel_mobile,true);
		$criteria->compare('id_post',$this->id_post,true);
        $criteria->compare('editor_table',$this->editor_table,true);
        $criteria->compare('mode',$this->mode,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('last_visit',$this->last_visit,true);
		$criteria->compare('role',$this->role);
        $criteria->compare('active',$this->active);

        $criteria->together  =  true;
        $criteria->with = array('post');
        $criteria->compare('post.department',$this->post_post,true);

        return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'last_name',
                'attributes' => array(
                    'post_post' => array(
                        'asc'=>'post.department',
                        'desc'=>'post.department DESC',
                    ),
                    '*',
                )

            ),
            'pagination' => array(
                'pageSize' => $pageSize,
            ),

		));
	}

    /**
     * @return Возвращает Имена и дни рождения на ближайших 6 дней
     */
    public function getBirthdays() {

        $criteria  = new CDbCriteria();
        $criteria->condition = 'STR_TO_DATE( CONCAT_WS(  "-", YEAR(CURDATE( ) ) , MONTH(  `birthday` ) , DAY(  `birthday` ) ),
            "%Y-%m-%d")
            BETWEEN
             CURDATE( ) AND
              ADDDATE( CURDATE( ) , INTERVAL 30 DAY)';
        $criteria->limit = 10;
        $criteria->order = 'DATE_FORMAT(`birthday`,"%m-%d") ASC';
        return $birthdays  = $this->model()->findAll($criteria);
    }

    /**
     * @return string Возвращает имя в виде Фамилия И.О.
     */
    public function getShortFio() {
        return $this->last_name.' '.mb_substr($this->name,0,1,Yii::app()->charset).'.'.mb_substr($this->middle_name,0,1,Yii::app()->charset).'.';
    }

    /**
     * @return array Возвращает массив с полем  shortName в виде Фамилия И.О.
     */
    public function getAllShortFio($param = 'editor_table', $value = 1, $order = 'last_name ASC'){
        $users = $this->model()->findAll(array('condition'=>"$param = $value", 'order' => $order));
        foreach ($users as $k => $v) {
            $v->shortName = $v->getShortFio();
        }
        return $users;
    }

    /**
     * @return array Возвращает пол вида ('1'=>'Мужской','2'=>'Женский')
     */
    public function getGender() {
        return array('1'=>'Мужской','2'=>'Женский');

    }

    /**
     * @return array Возвращает статус пользователя ('1'=>'Включён','0'=>'Выключен')
     */
    public function getUserStatus() {
        return array('1'=>'Включён','0'=>'Выключен');

    }

    /**
     * @return array Возвращает образование
     */
    public function getEducation() {
        return array('1'=>'Среднее','2'=>'Профессионально-техническое','3'=>'Неоконченное высшее','4'=>'Полное высшее');

    }

    /**
     * @return array Возвращает режим работы
     */
    public function getMode() {
        return array('1'=>'Сменный','2'=>'Дневной');

    }

    /**
     * @return string Возвращет имя в виде Фамилия Имя Отчество.
     */
    public function getFullFio() {
        return  $this->last_name.' '.$this->name.' '.$this->middle_name;
    }

    /**
     * @param string $string
     * @return string Возвращает преобразованное Фамилию Имя Отчество, первые буквы, маленькие, английские
     */
    public function ukr2eng($string){

        $string = mb_strtolower($string,'UTF-8');

        $converter = array(
            'а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','є'=>'e',
            'ж'=>'z','з'=>'z','и'=>'i','і'=>'i','ї'=>'y','й'=>'i','к'=>'k',
            'л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s',
            'т'=>'t','у'=>'u','ф'=>'f','х'=>'k','ц'=>'t','ч'=>'c','ш'=>'s',
            'щ'=>'s','ю'=>'j','я'=>'j'
        );

        return strtr($string, $converter);

    }

    /**
     * @param string $string
     * @return string Возвращает дату преобразованную для использования в логине
     */
    public function date2login($string) {

        $date = explode('.',$string);
        return $date[0].$date[1].substr($date[2],-2);
    }

    /**
     * @param int $num
     * @return string Возвращает пароль заданной длины
     */
    public function generatePassword($num) {
        $arr = array('a','b','c','d','e','f',
            'g','h','i','j','k','l',
            'm','n','o','p','r','s',
            't','u','v','x','y','z',
            'A','B','C','D','E','F',
            'G','H','I','J','K','L',
            'M','N','O','P','R','S',
            'T','U','V','X','Y','Z',
            '1','2','3','4','5','6',
            '7','8','9','0');
        // Генерируем пароль
        $pass = "";
        for($i = 0; $i < (int)$num; $i++)
        {
            // Вычисляем случайный индекс массива
            $index = rand(0, count($arr) - 1);
            $pass .= $arr[$index];
        }
        return $pass;
    }


    protected function beforeValidate() {

        if ($this->isNewRecord) {

            /** Формируем логин вида pa120378zkb, если логин не указан */
            if ($this->login == '' && $this->birthday != '' && $this->last_name != '' && $this->name != '' && $this->middle_name != '' ) {
                $string = mb_substr($this->last_name,0,1,'UTF-8');
                $string .= mb_substr($this->name,0,1,'UTF-8');
                $string .= mb_substr($this->middle_name,0,1,'UTF-8');
                $fio = $this->ukr2eng($string);
                $date = $this->date2login($this->birthday);
                $this->login = 'pa'.$date.$fio;
            }
        }

        return parent::beforeValidate();
    }


    protected function beforeSave() {

        if($this->isNewRecord) {
            /** Генерируем пароль, если не задан  */
            if ($this->password == '') $this->password = $this->generatePassword(8);
            $session = new CHttpSession;
            $session->open();
            $session['pass-int-bvg'] = $this->password;
            $session->close();
            $this->password = md5($this->password);
        }

        $this->birthday = Yii::app()->dateFormatter->format("yyyy-MM-dd", $this->birthday);

        if ($this->passport_date != '') $this->passport_date = DateTime::createFromFormat('d.m.Y',$this->passport_date)->format('Y-m-d');
        else $this->passport_date = '';




       return parent::beforeSave();
    }

    protected function afterSave() {

        if($this->isNewRecord) {

            /** Добавляем пользователя и пароль в таблицу bvg_pass */
            $session = new CHttpSession;
            $session->open();
            $generatePassword = $session['pass-int-bvg'];
            $session->close();
            $model = new Pass();
            $model->id_programm = 12;
            $model->id_user = $this->id;
            $model->login = $this->login;
            $model->pass = $generatePassword;
            $model->save();

            /** Добавляем редактора табеля и дату в bvg_table_editors  */
            $model = new TableEditors;
            $model->user_id = $this->id;
            $model->editor_id = $this->editor;
            $model->date_start = $this->hired_date_start;
            if (!$model->save()) throw new CHttpException(500,'Ошибка записи в таблицу TableEditors.');

            /** Добавляем Дату принятия на работу (код 1), увольнения (код 2) и др в bvg_table_attributes */

            $tableAttributes[] = array('user_id'=>$this->id, 'attribute'=>1, 'date_start'=>Yii::app()->dateFormatter->format("yyyy-MM-dd", $this->hired_date_start));
            if ($this->fired_date_start != '') $tableAttributes[] = array('user_id'=>$this->id, 'attribute'=>2, 'date_start'=>Yii::app()->dateFormatter->format("yyyy-MM-dd", $this->fired_date_start));
            else
                $tableAttributes[] = array('user_id'=>$this->id, 'attribute'=>2, 'date_start'=>'0000-00-00');
            if (!empty( $tableAttributes)) {
                $builder=Yii::app()->db->schema->commandBuilder;
                $command=$builder->createMultipleInsertCommand('bvg_table_attributes', $tableAttributes);
                $command->execute();
            }
        }

        if ($this->fired_date_start != ''){
            $model = TableAttributes::model()->findByAttributes(array('attribute'=>2,'user_id'=>$this->id));
            $model->attributes = array('date_start'=>$this->fired_date_start);
            if (!$model->save()) throw new CHttpException(500,'Ошибка записи в таблицу TableAttributes.');
        }


        return parent::afterSave();

    }

    protected function afterFind() {

        parent::afterFind();

        $model = TableAttributes::model()->findByAttributes(array('user_id'=>$this->id),'attribute=2');
        $this->fired_date_start =$model['date_start'];

        $this->birthday = Yii::app()->dateFormatter->format('dd.MM.yyyy', $this->birthday);

        if ($this->tbl_number == 0) $this->tbl_number = '';
        if ($this->ident_code == 0) $this->ident_code = '';
        if ($this->tel_int == 0) $this->tel_int = '';
        if ($this->tel_mobile == 0) $this->tel_mobile = '';

        if ($this->passport_date != '0000-00-00') $this->passport_date = Yii::app()->dateFormatter->format('dd.MM.yyyy',$this->passport_date);
        else $this->passport_date = '';


    }
}