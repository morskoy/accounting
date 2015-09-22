<?php

/**
 * This is the model class for table "bvg_table_editors".
 *
 * The followings are the available columns in table 'bvg_table_editors':
 * @property integer $id
 * @property integer $user_id
 * @property string $date_start
 * @property string $date_finish
 * @property integer $editor_id
 *
 * The followings are the available model relations:
 * @property BvgUser $editor
 * @property BvgUser $user
 */
class TableEditors extends CActiveRecord
{
	public $max_date;

    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bvg_table_editors';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_start,user_id, editor_id', 'required'),
			array('user_id, editor_id', 'numerical', 'integerOnly'=>true),
			array(' date_finish', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, date_start, date_finish, editor_id', 'safe', 'on'=>'search'),
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
			'editor' => array(self::BELONGS_TO, 'User', 'editor_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'date_start' => 'С какого числа',
			'date_finish' => 'date_finish',
			'editor_id' => 'Редактор табеля',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('date_start',$this->date_start,true);
		$criteria->compare('date_finish',$this->date_finish,true);
		$criteria->compare('editor_id',$this->editor_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TableEditors the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


    protected function beforeSave() {

        $this->date_start = Yii::app()->dateFormatter->format("yyyy-MM-dd", $this->date_start);

        return parent::beforeSave();
    }

    protected function afterFind() {

        if ($this->date_start == '0000-00-00') $this->date_start = '';
        else $this->date_start = Yii::app()->dateFormatter->format("dd.MM.yyyy", $this->date_start);

        return parent::afterFind();
    }
}
