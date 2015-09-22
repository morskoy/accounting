<?php

/**
 * This is the model class for table "bvg_sub_department".
 *
 * The followings are the available columns in table 'bvg_sub_department':
 * @property integer $id
 * @property string $sub_department
 * @property integer $id_department
 *
 * The followings are the available model relations:
 * @property BvgDepartment $idDepartment
 */
class SubDepartment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SubDepartment the static model class
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
		return 'bvg_sub_department';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sub_department, id_department', 'required'),
			array('id_department', 'numerical', 'integerOnly'=>true),
			array('sub_department', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sub_department, id_department', 'safe', 'on'=>'search'),
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
			'sub_department' => array(self::BELONGS_TO, 'Department', 'id_department'),
            'post' => array(self::HAS_MANY, 'Post', 'id_sub_department'),
            'user' => array(self::HAS_MANY, 'User', 'id_sub_department'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sub_department' => 'Sub Department',
			'id_department' => 'Id Department',
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
		$criteria->compare('sub_department',$this->sub_department,true);
		$criteria->compare('id_department',$this->id_department);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}