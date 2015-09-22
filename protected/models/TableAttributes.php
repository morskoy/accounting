<?php

/**
 * This is the model class for table "bvg_table_attributes".
 *
 * The followings are the available columns in table 'bvg_table_attribute':
 * @property integer $id
 * @property integer $user_id
 * @property integer $attribute
 * @property string $date_start
 * @property string $date_finish
 *
 * The followings are the available model relations:
 * @property BvgUser $user
 */
class TableAttributes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bvg_table_attributes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, attribute', 'required'),
			array('user_id, attribute', 'numerical', 'integerOnly'=>true),
            array('date_start, date_finish', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, attribute, date_start, date_finish', 'safe', 'on'=>'search'),
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
			'attribute' => 'Attribute',
			'date_start' => 'Date Start',
			'date_finish' => 'Date Finish',
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
		$criteria->compare('attribute',$this->attribute);
		$criteria->compare('date_start',$this->date_start,true);
		$criteria->compare('date_finish',$this->date_finish,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TableAttribute the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


    protected function beforeSave() {

        if (isset($this->date_start) && $this->date_start != '') $this->date_start = Yii::app()->dateFormatter->format("yyyy-MM-dd", $this->date_start);

        return parent::beforeSave();
    }


    protected function afterFind(){
        if ($this->date_start == '0000-00-00') $this->date_start = '';
        else $this->date_start = Yii::app()->dateFormatter->format("dd.MM.yyyy", $this->date_start);
        if ($this->date_finish == '0000-00-00') $this->date_finish = '';
        else $this->date_finish = Yii::app()->dateFormatter->format("dd.MM.yyyy", $this->date_start);

        return parent::afterFind();
    }
}
