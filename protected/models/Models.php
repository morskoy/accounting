<?php

/**
 * This is the model class for table "bvg_models".
 *
 * The followings are the available columns in table 'bvg_models':
 * @property integer $id
 * @property string $model
 * @property integer $id_manufacture
 *
 * The followings are the available model relations:
 * @property BvgDevices[] $bvgDevices
 * @property BvgManufactures $idManufacture
 */
class Models extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Models the static model class
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
		return 'bvg_models';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('model, id_manufacture', 'required'),
			array('id_manufacture', 'numerical', 'integerOnly'=>true),
			array('model', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, model, id_manufacture', 'safe', 'on'=>'search'),
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
			'devices' => array(self::HAS_MANY, 'Devices', 'id_model'),
			'manufacture' => array(self::BELONGS_TO, 'Manufactures', 'id_manufacture'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'model' => 'Модель',
			'id_manufacture' => 'Производитель',
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
		$criteria->compare('model',$this->model,true);
		$criteria->compare('id_manufacture',$this->id_manufacture);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}