<?php

/**
 * This is the model class for table "bvg_helpdesk".
 *
 * The followings are the available columns in table 'bvg_helpdesk':
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_problem
 * @property string $description
 * @property integer $id_status
 * @property string $start_time
 * @property string $finish_time
 * @property integer $hidden
 *
 * The followings are the available model relations:
 * @property BvgHdStatus $idStatus
 * @property BvgUser $idUser
 * @property BvgHdProblem $idProblem
 */
class Helpdesk extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Helpdesk the static model class
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
		return 'bvg_helpdesk';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('id_user, id_problem, id_status', 'required'),
			array('hidden, id_user, id_problem, id_status', 'numerical', 'integerOnly'=>true),
            array('description', 'length', 'max'=>200),
            array('start_time, finish_time','type','type'=>'datetime','datetimeFormat'=>'dd.MM.yyyy hh:mm','message'=>'Неправильный формат даты'),
            // The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_user, id_problem, id_status, start_time, finish_time, hidden', 'safe', 'on'=>'search'),
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
			'status' => array(self::BELONGS_TO, 'HdStatus', 'id_status'),
			'user' => array(self::BELONGS_TO, 'User', 'id_user'),
			'problem' => array(self::BELONGS_TO, 'HdProblem', 'id_problem'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_user' => 'Пользователь',
			'id_problem' => 'Проблема',
            'description' => 'Описание проблемы',
			'id_status' => 'Статус',
			'start_time' => 'Дата создания',
			'finish_time' => 'Дата выполнения',
			'hidden' => 'Скрыть задачу',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_problem',$this->id_problem);
        $criteria->compare('description',$this->description,true);
		$criteria->compare('id_status',$this->id_status);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('finish_time',$this->finish_time,true);
		$criteria->compare('hidden',$this->hidden);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
            ),
            'sort' => array(
                'defaultOrder' => 'start_time DESC',
            ),
        ));
	}



    // defining onNewComment event
    public function onNewComment($event) {
    // Event is actually triggered here. This way we can use
    // onNewComment method instead of raiseEvent.
        $this->raiseEvent('onNewComment', $event);
    }



    /**
     * Преобразуем дату и время в формат для базы
     */

    protected function beforeSave (){

        if ($this->start_time == '') {
            $this->start_time = date('Y-m-d H:i:s');
        } else {
            $this->start_time = DateTime::createFromFormat('d.m.Y H:i',$this->start_time);
            $this->start_time = $this->start_time->format('Y-m-d H:i:s');
        }


        if ($this->finish_time == '') {
            $this->finish_time = '0000-00-00 00:00:00';
        } else {
            $this->finish_time = DateTime::createFromFormat('d.m.Y H:i',$this->finish_time);
            $this->finish_time = $this->finish_time->format('Y-m-d H:i:s');
        }

        //if ($this->isNewRecord) {
        //    $event = new NewHelpdeskEvent($this);
        //    $event->helpdesk->$this;
        //    $this->onNewHelpdesk($event);
        //    return $event->isValid;
        //}

        return parent::beforeSave();
    }


    /**
     * Преобразуем дату в формат для вывода в таблице
     */

    protected function afterFind(){

        parent::afterFind();

        $this->start_time = DateTime::createFromFormat('Y-m-d H:i:s', $this->start_time);
        $this->start_time = $this->start_time->format('d.m.Y H:i');

        if ($this->finish_time == '0000-00-00 00:00:00') $this->finish_time = '';
        else {
            $this->finish_time = DateTime::createFromFormat('Y-m-d H:i:s', $this->finish_time);
            $this->finish_time = $this->finish_time->format('d.m.Y H:i');
        }

    }
}