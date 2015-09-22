<?php

/**
 * This is the model class for table "bvg_user_role".
 *
 * The followings are the available columns in table 'bvg_user_role':
 * @property string $role
 * @property string $role_rus
 *
 * The followings are the available model relations:
 * @property BvgUser[] $bvgUsers
 */
class UserRole extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserRole the static model class
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
		return 'bvg_user_role';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role, role_rus', 'required'),
			array('role, role_rus', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('role, role_rus', 'safe', 'on'=>'search'),
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
			'user_role' => array(self::HAS_MANY, 'User', 'role'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'role' => 'Role',
			'role_rus' => 'Role Rus',
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

		$criteria->compare('role',$this->role,true);
		$criteria->compare('role_rus',$this->role_rus,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}