<?php

/**
 * This is the model class for table "bvg_departure".
 *
 * The followings are the available columns in table 'bvg_departure':
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_post
 * @property string $description
 * @property string $direction
 * @property integer $order
 * @property string $date_departure
 * @property string $date_arrival
 *
 * The followings are the available model relations:
 * @property BvgPost $idPost
 * @property BvgUser $idUser
 */
class Departure extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Departure the static model class
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
		return 'bvg_departure';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, description, id_place, order, date_departure', 'required'),
			array('id_user, id_post, id_place, order', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_user, id_post, description, direction, order, date_departure, date_arrival', 'safe', 'on'=>'search'),
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
			'post' => array(self::BELONGS_TO, 'Department', 'id_post'),
			'user' => array(self::BELONGS_TO, 'User', 'id_user'),
            'user_order' => array(self::BELONGS_TO, 'User', 'order'),
            'place' => array(self::BELONGS_TO, 'DeparturePlace', 'id_place'),
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
			'id_post' => 'Должность',
			'description' => 'Цель поездки',
			'id_place' => 'Место назначения',
			'order' => 'По поручению',
			'date_departure' => 'Время выезда',
			'date_arrival' => 'Время приезда',
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
		$criteria->compare('id_post',$this->id_post);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('id_place',$this->id_place);
		$criteria->compare('order',$this->order);
        if ($this->date_departure)
            $criteria->compare('date_departure', $this->date_departure, true);
        //$criteria->compare('date_departure',$this->date_departure,true);
		$criteria->compare('date_arrival',$this->date_arrival,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'date_departure DESC',
            ),
            'pagination' => array(
                'pageSize' => 20,
            ),
		));
	}


    protected function beforeSave(){

        if ($this->date_departure == '') {
            $this->date_departure = date('Y-m-d H:i:s');
        } else {
            $this->date_departure = DateTime::createFromFormat('d.m.Y H:i',$this->date_departure);
            $this->date_departure = $this->date_departure->format('Y-m-d H:i:s');
        }


        if ($this->date_arrival == '') {
            $this->date_arrival = '0000-00-00 00:00:00';
        } else {
            $this->date_arrival = DateTime::createFromFormat('d.m.Y H:i',$this->date_arrival);
            $this->date_arrival = $this->date_arrival->format('Y-m-d H:i:s');
        }

        return parent::beforeSave();
    }

    protected function afterFind(){

        parent::afterFind();

        $this->date_departure = DateTime::createFromFormat('Y-m-d H:i:s', $this->date_departure);
        $this->date_departure = $this->date_departure->format('d.m.Y H:i');

        if ($this->date_arrival == '0000-00-00 00:00:00') $this->date_arrival = '';
        else {
            $this->date_arrival = DateTime::createFromFormat('Y-m-d H:i:s', $this->date_arrival);
            $this->date_arrival = $this->date_arrival->format('d.m.Y H:i');
        }

    }
}