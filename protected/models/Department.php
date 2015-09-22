<?php

/**
 * This is the model class for table "bvg_department".
 *
 * The followings are the available columns in table 'bvg_department':
 * @property string $name
 */
class Department extends CActiveRecord
{

    public $parentId;
    public $par;
    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bvg_department';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('department', 'required'),
			array('department', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('department', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'department' => 'Отдел (должность)',
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

		$criteria->compare('department',$this->department,true);

        $criteria->order = $this->tree->leftAttribute;


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => 200,
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Department the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function suggestDepartment($keyword)
    {
        $department = $this->findAll(array(
            'condition'=>'department LIKE :keyword',
            'params'=>array(':keyword'=>'%'.$keyword.'%'),
        ));
        return $department;
    }

    public function getAllDepartment(){

        $departments = $this->findAll(array('order'=>'department ASC'));
        foreach ($departments as $department) {
            if ($department->level >= 3) $department->department = $department->department." (".$department->parent()->find()->department.")";

         }
        return $departments;




    }

    public function behaviors()
    {
        return array(
            'tree'=>array(
                'class'=>'ext.yiiext.behaviors.model.trees.NestedSetBehavior',
                'leftAttribute'=>'leftkey',
                'rightAttribute'=>'rightkey',
                'levelAttribute'=>'level',
                'hasManyRoots' => false,
            ),
        );
    }
}
