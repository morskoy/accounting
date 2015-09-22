<?php

/**
 * This is the model class for table "bvg_post".
 *
 * The followings are the available columns in table 'bvg_post':
 * @property integer $id
 * @property string $post
 * @property integer $id_department
 * @property integer $id_sub_department
 *
 * The followings are the available model relations:
 * @property BvgSubDepartment $idSubDepartment
 * @property BvgDepartment $idDepartment
 */
class Post extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Post the static model class
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
		return 'bvg_post';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('post, id_department, id_sub_department', 'required'),
			array('id_department, id_sub_department', 'numerical', 'integerOnly'=>true),
			array('post', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, post, id_department, id_sub_department', 'safe', 'on'=>'search'),
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
			'sub_department' => array(self::BELONGS_TO, 'SubDepartment', 'id_sub_department'),
			'department' => array(self::BELONGS_TO, 'Department', 'id_department'),
            'departure' => array(self::HAS_MANY, 'Departure', 'id_post'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'post' => 'Post',
			'id_department' => 'Id Department',
			'id_sub_department' => 'Id Sub Department',
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
		$criteria->compare('post',$this->post,true);
		$criteria->compare('id_department',$this->id_department);
		$criteria->compare('id_sub_department',$this->id_sub_department);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function suggestPost($keyword)
    {
        $posts = $this->findAll(array(
            'condition'=>'post LIKE :keyword',
            'params'=>array(':keyword'=>'%'.$keyword.'%'),
        ));
        return $posts;
    }

}