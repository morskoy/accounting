<?php

/**
 * This is the model class for table "bvg_devices".
 *
 * The followings are the available columns in table 'bvg_devices':
 * @property integer $id
 * @property integer $id_unit
 * @property integer $id_manufacture
 * @property integer $id_model
 * @property integer $id_user
 * @property integer $id_department
 * @property integer $id_place
 * @property string $sn
 * @property string $ip
 * @property string $description
 *
 * The followings are the available model relations:
 * @property BvgUser $idUser
 * @property BvgUnits $idUnit
 * @property BvgManufactures $idManufacture
 * @property BvgDepartment $idDepartment
 * @property BvgPlaces $idPlace
 * @property BvgModels $idModel
 */
class Devices extends CActiveRecord
{
	public $ip_1, $ip_2, $ip_3, $ip_4;
    public $mask_1, $mask_2, $mask_3, $mask_4;
    public $unit_unit;
    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Devices the static model class
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
		return 'bvg_devices';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_unit, id_manufacture, id_model', 'required'),
			array('id_unit, id_manufacture, id_model, id_user, id_department, id_place, ip_1, ip_2, ip_3, ip_4, mask_1, mask_2, mask_3, mask_4', 'numerical', 'integerOnly'=>true),
			array('sn', 'length', 'max'=>50),
			array('ip, mask', 'length', 'max'=>20),
            //array('ip, mask', 'match', 'pattern'=>'((25[0-5]|2[0-4]\d|[01]?\d\d?)\.){3}(25[0-5]|2[0-4]\d|[01]?\d\d?)'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_unit, id_manufacture, id_model, id_user, id_department, id_place, sn, ip, mask, description, unit_unit', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'id_user'),
			'unit' => array(self::BELONGS_TO, 'Units', 'id_unit'),
			'manufacture' => array(self::BELONGS_TO, 'Manufactures', 'id_manufacture'),
			'department' => array(self::BELONGS_TO, 'Department', 'id_department'),
			'place' => array(self::BELONGS_TO, 'Places', 'id_place'),
			'model' => array(self::BELONGS_TO, 'Models', 'id_model'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_unit' => 'Устройство',
            'unit_unit' => 'Устройство',
			'id_manufacture' => 'Производитель',
			'id_model' => 'Модель',
			'id_user' => 'Пользователь',
			'id_department' => 'Отдел',
			'id_place' => 'Расположение',
			'sn' => 'Серийный номер',
			'ip' => 'IP',
            'mask' => 'Маска',
			'description' => 'Описание',
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
		$criteria->compare('id_unit',$this->id_unit);
		$criteria->compare('id_manufacture',$this->id_manufacture);
		$criteria->compare('id_model',$this->id_model);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_department',$this->id_department);
		$criteria->compare('id_place',$this->id_place);
		$criteria->compare('sn',$this->sn,true);
		$criteria->compare('ip',$this->ip,true);
        $criteria->compare('mask',$this->mask,true);
		$criteria->compare('description',$this->description,true);

        $criteria->together  =  true;
        $criteria->with = array('unit');
        $criteria->compare('unit.unit',$this->unit_unit,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array(
                'attributes' => array(
                    'unit_unit' => array(
                        'asc'=>'unit.unit',
                        'desc'=>'unit.unit DESC',
                    ),
                    '*',
                )

            ),
            'pagination' => array(
                'pageSize' => 50,
            ),
		));
	}

    protected function beforeValidate() {

        if ($this->ip_1 != '' && $this->ip_2 != '' && $this->ip_3 != '' &&  $this->ip_4 != '')
            $this->ip = $this->ip_1.".".$this->ip_2.".".$this->ip_3.".".$this->ip_4;
        else
            $this->ip = '';
        if ($this->mask_1 != '' && $this->mask_2 != '' && $this->mask_3 != '' &&  $this->mask_4 != '')
            $this->mask = $this->mask_1.".".$this->mask_2.".".$this->mask_3.".".$this->mask_4;
        else
            $this->mask = '';

        return parent::beforeValidate();
    }

    protected function beforeSave() {
        //print_r($this->ip);
        //exit;

        if ($this->ip != '') $this->ip = new  CDbExpression("INET_ATON('".$this->ip."')");
        if ($this->mask != '') $this->mask = new  CDbExpression("INET_ATON('".$this->mask."')");

        return parent::beforeSave();
    }

    protected function afterFind() {

        if ($this->ip != 0) $this->ip = long2ip($this->ip);
        else $this->ip = '';
        if($this->mask != 0) $this->mask = long2ip($this->mask);
        else $this->mask = '';

        return parent::afterFind();
    }
}