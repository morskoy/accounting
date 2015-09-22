<?php

/**
 * This is the model class for table "bvg_table".
 *
 * The followings are the available columns in table 'bvg_table':
 * @property string $id
 * @property integer $user_id
 * @property string $day1_code
 * @property integer $day1_hours
 * @property string $day2_code
 * @property integer $day2_hours
 * @property string $day3_code
 * @property integer $day3_hours
 * @property string $day4_code
 * @property integer $day4_hours
 * @property string $day5_code
 * @property integer $day5_hours
 * @property string $day6_code
 * @property integer $day6_hours
 * @property string $day7_code
 * @property integer $day7_hours
 * @property string $day8_code
 * @property integer $day8_hours
 * @property string $day9_code
 * @property integer $day9_hours
 * @property string $day10_code
 * @property integer $day10_hours
 * @property string $day11_code
 * @property integer $day11_hours
 * @property string $day12_code
 * @property integer $day12_hours
 * @property string $day13_code
 * @property integer $day13_hours
 * @property string $day14_code
 * @property integer $day14_hours
 * @property string $day15_code
 * @property integer $day15_hours
 * @property string $day16_code
 * @property integer $day16_hours
 * @property string $day17_code
 * @property integer $day17_hours
 * @property string $day18_code
 * @property integer $day18_hours
 * @property string $day19_code
 * @property integer $day19_hours
 * @property string $day20_code
 * @property integer $day20_hours
 * @property string $day21_code
 * @property integer $day21_hours
 * @property string $day22_code
 * @property integer $day22_hours
 * @property string $day23_code
 * @property integer $day23_hours
 * @property string $day24_code
 * @property integer $day24_hours
 * @property string $day25_code
 * @property integer $day25_hours
 * @property string $day26_code
 * @property integer $day26_hours
 * @property string $day27_code
 * @property integer $day27_hours
 * @property string $day28_code
 * @property integer $day28_hours
 * @property string $day29_code
 * @property integer $day29_hours
 * @property string $day30_code
 * @property integer $day30_hours
 * @property string $day31_code
 * @property integer $day31_hours
 * @property integer $dni_roboti
 * @property integer $vid_godin
 * @property integer $vid_nichnih
 * @property integer $vid_nadurochno
 * @property integer $vid_vihidnih
 * @property integer $vid_vidryadgenya
 * @property integer $neyavok_dniv
 * @property integer $neyavok_godin
 * @property integer $neyavok_v
 * @property integer $neyavok_d
 * @property integer $neyavok_ch
 * @property integer $neyavok_n
 * @property integer $neyavok_db
 * @property integer $neyavok_do
 * @property integer $neyavok_vp
 * @property integer $neyavok_dd
 * @property integer $neyavok_na
 * @property integer $neyavok_in
 * @property integer $neyavok_pr
 * @property integer $neyavok_tn
 * @property integer $neyavok_nn
 * @property integer $neyavok_i
 * @property string $date_completion
 */
class Table extends CActiveRecord
{
	public $user_table = array();
    public $userLastName;
    public $month;
    public $day1, $day2, $day3, $day4, $day5, $day6, $day7, $day8, $day9, $day10, $day11, $day12, $day13, $day14, $day15, $day16, $day17, $day18, $day19, $day20, $day21, $day22, $day23, $day24, $day25, $day26, $day27, $day28, $day29, $day30, $day31;
    public $valuesTable = array(
        1,2,3,4,5,6,7,8,9,10,11,12,13,'ВД','В','Д','Ч','Н','ДБ','ДО','ВП','ДД','НА','ІН','ПР','ТН','НН','І','Х'
    );

    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bvg_table';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'required'),
			array('user_id, day1_hours, day2_hours, day3_hours, day4_hours, day5_hours, day6_hours, day7_hours, day8_hours, day9_hours, day10_hours, day11_hours, day12_hours, day13_hours, day14_hours, day15_hours, day16_hours, day17_hours, day18_hours, day19_hours, day20_hours, day21_hours, day22_hours, day23_hours, day24_hours, day25_hours, day26_hours, day27_hours, day28_hours, day29_hours, day30_hours, day31_hours, dni_roboti, vid_godin, vid_nichnih, vid_vidryadgenya, neyavok_dniv, neyavok_godin, neyavok_v, neyavok_d, neyavok_ch, neyavok_n, neyavok_db, neyavok_do, neyavok_vp, neyavok_dd, neyavok_na, neyavok_in, neyavok_pr, neyavok_tn, neyavok_nn, neyavok_i', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>5),
			array('day1_code, day2_code, day3_code, day4_code, day5_code, day6_code, day7_code, day8_code, day9_code, day10_code, day11_code, day12_code, day13_code, day14_code, day15_code, day16_code, day17_code, day18_code, day19_code, day20_code, day21_code, day22_code, day23_code, day24_code, day25_code, day26_code, day27_code, day28_code, day29_code, day30_code, day31_code', 'in','range'=>$this->valuesTable,'allowEmpty'=>true),
            array('day1, day2, day3, day4, day5, day6, day7, day8, day9, day10, day11, day12, day13, day14, day15, day16, day17, day18, day19, day20, day21, day22, day23, day24, day25, day26, day27, day28, day29, day30, day31, vid_nadurochno, vid_vihidnih', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, day1_code, day1_hours, day2_code, day2_hours, day3_code, day3_hours, day4_code, day4_hours, day5_code, day5_hours, day6_code, day6_hours, day7_code, day7_hours, day8_code, day8_hours, day9_code, day9_hours, day10_code, day10_hours, day11_code, day11_hours, day12_code, day12_hours, day13_code, day13_hours, day14_code, day14_hours, day15_code, day15_hours, day16_code, day16_hours, day17_code, day17_hours, day18_code, day18_hours, day19_code, day19_hours, day20_code, day20_hours, day21_code, day21_hours, day22_code, day22_hours, day23_code, day23_hours, day24_code, day24_hours, day25_code, day25_hours, day26_code, day26_hours, day27_code, day27_hours, day28_code, day28_hours, day29_code, day29_hours, day30_code, day30_hours, day31_code, day31_hours, dni_roboti, vid_godin, vid_nichnih, vid_nadurochno, vid_vihidnih, vid_vidryadgenya, neyavok_dniv, neyavok_godin, neyavok_v, neyavok_d, neyavok_ch, neyavok_n, neyavok_db, neyavok_do, neyavok_vp, neyavok_dd, neyavok_na, neyavok_in, neyavok_pr, neyavok_tn, neyavok_nn, neyavok_i, date_completion', 'safe', 'on'=>'search'),
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
            //'department' => array(self::BELONGS_TO, 'Department', 'department_id'),
            //'editor' => array(self::BELONGS_TO, 'User', 'editor_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'ФИО',
            'day1_code' => '1',
			'day1_hours' => 'Day1 Hours',
			'day2_code' => '2',
			'day2_hours' => 'Day2 Hours',
			'day3_code' => '3',
			'day3_hours' => 'Day3 Hours',
			'day4_code' => '4',
			'day4_hours' => 'Day4 Hours',
			'day5_code' => '5',
			'day5_hours' => 'Day5 Hours',
			'day6_code' => '6',
			'day6_hours' => 'Day6 Hours',
			'day7_code' => '7',
			'day7_hours' => 'Day7 Hours',
			'day8_code' => '8',
			'day8_hours' => 'Day8 Hours',
			'day9_code' => '9',
			'day9_hours' => 'Day9 Hours',
			'day10_code' => '10',
			'day10_hours' => 'Day10 Hours',
			'day11_code' => '11',
			'day11_hours' => 'Day11 Hours',
			'day12_code' => '12',
			'day12_hours' => 'Day12 Hours',
			'day13_code' => 'Day13 Code',
			'day13_hours' => 'Day13 Hours',
			'day14_code' => 'Day14 Code',
			'day14_hours' => 'Day14 Hours',
			'day15_code' => 'Day15 Code',
			'day15_hours' => 'Day15 Hours',
			'day16_code' => 'Day16 Code',
			'day16_hours' => 'Day16 Hours',
			'day17_code' => 'Day17 Code',
			'day17_hours' => 'Day17 Hours',
			'day18_code' => 'Day18 Code',
			'day18_hours' => 'Day18 Hours',
			'day19_code' => 'Day19 Code',
			'day19_hours' => 'Day19 Hours',
			'day20_code' => 'Day20 Code',
			'day20_hours' => 'Day20 Hours',
			'day21_code' => 'Day21 Code',
			'day21_hours' => 'Day21 Hours',
			'day22_code' => 'Day22 Code',
			'day22_hours' => 'Day22 Hours',
			'day23_code' => 'Day23 Code',
			'day23_hours' => 'Day23 Hours',
			'day24_code' => 'Day24 Code',
			'day24_hours' => 'Day24 Hours',
			'day25_code' => 'Day25 Code',
			'day25_hours' => 'Day25 Hours',
			'day26_code' => 'Day26 Code',
			'day26_hours' => 'Day26 Hours',
			'day27_code' => 'Day27 Code',
			'day27_hours' => 'Day27 Hours',
			'day28_code' => 'Day28 Code',
			'day28_hours' => 'Day28 Hours',
			'day29_code' => 'Day29 Code',
			'day29_hours' => 'Day29 Hours',
			'day30_code' => 'Day30 Code',
			'day30_hours' => 'Day30 Hours',
			'day31_code' => 'Day31 Code',
			'day31_hours' => 'Day31 Hours',
			'dni_roboti' => 'Дні роботи',
			'vid_godin' => 'Годін всього',
			'vid_nichnih' => 'нічних',
			'vid_nadurochno' => 'надурочно',
			'vid_vihidnih' => 'вихідних',
			'vid_vidryadgenya' => 'відрядження',
			'neyavok_dniv' => 'Неявок днів',
			'neyavok_godin' => 'Неявок годин',
			'neyavok_v' => 'В',
			'neyavok_d' => 'Д',
			'neyavok_ch' => 'Ч',
			'neyavok_n' => 'Н',
			'neyavok_db' => 'ДБ',
			'neyavok_do' => 'ДО',
			'neyavok_vp' => 'ВП',
			'neyavok_dd' => 'ДД',
			'neyavok_na' => 'НА',
			'neyavok_in' => 'ІН',
			'neyavok_pr' => 'ПР',
			'neyavok_tn' => 'ТН',
			'neyavok_nn' => 'НН',
			'neyavok_i' => 'І',
			'date_completion' => 'Месяц',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('day1_code',$this->day1_code,true);
		$criteria->compare('day1_hours',$this->day1_hours);
		$criteria->compare('day2_code',$this->day2_code,true);
		$criteria->compare('day2_hours',$this->day2_hours);
		$criteria->compare('day3_code',$this->day3_code,true);
		$criteria->compare('day3_hours',$this->day3_hours);
		$criteria->compare('day4_code',$this->day4_code,true);
		$criteria->compare('day4_hours',$this->day4_hours);
		$criteria->compare('day5_code',$this->day5_code,true);
		$criteria->compare('day5_hours',$this->day5_hours);
		$criteria->compare('day6_code',$this->day6_code,true);
		$criteria->compare('day6_hours',$this->day6_hours);
		$criteria->compare('day7_code',$this->day7_code,true);
		$criteria->compare('day7_hours',$this->day7_hours);
		$criteria->compare('day8_code',$this->day8_code,true);
		$criteria->compare('day8_hours',$this->day8_hours);
		$criteria->compare('day9_code',$this->day9_code,true);
		$criteria->compare('day9_hours',$this->day9_hours);
		$criteria->compare('day10_code',$this->day10_code,true);
		$criteria->compare('day10_hours',$this->day10_hours);
		$criteria->compare('day11_code',$this->day11_code,true);
		$criteria->compare('day11_hours',$this->day11_hours);
		$criteria->compare('day12_code',$this->day12_code,true);
		$criteria->compare('day12_hours',$this->day12_hours);
		$criteria->compare('day13_code',$this->day13_code,true);
		$criteria->compare('day13_hours',$this->day13_hours);
		$criteria->compare('day14_code',$this->day14_code,true);
		$criteria->compare('day14_hours',$this->day14_hours);
		$criteria->compare('day15_code',$this->day15_code,true);
		$criteria->compare('day15_hours',$this->day15_hours);
		$criteria->compare('day16_code',$this->day16_code,true);
		$criteria->compare('day16_hours',$this->day16_hours);
		$criteria->compare('day17_code',$this->day17_code,true);
		$criteria->compare('day17_hours',$this->day17_hours);
		$criteria->compare('day18_code',$this->day18_code,true);
		$criteria->compare('day18_hours',$this->day18_hours);
		$criteria->compare('day19_code',$this->day19_code,true);
		$criteria->compare('day19_hours',$this->day19_hours);
		$criteria->compare('day20_code',$this->day20_code,true);
		$criteria->compare('day20_hours',$this->day20_hours);
		$criteria->compare('day21_code',$this->day21_code,true);
		$criteria->compare('day21_hours',$this->day21_hours);
		$criteria->compare('day22_code',$this->day22_code,true);
		$criteria->compare('day22_hours',$this->day22_hours);
		$criteria->compare('day23_code',$this->day23_code,true);
		$criteria->compare('day23_hours',$this->day23_hours);
		$criteria->compare('day24_code',$this->day24_code,true);
		$criteria->compare('day24_hours',$this->day24_hours);
		$criteria->compare('day25_code',$this->day25_code,true);
		$criteria->compare('day25_hours',$this->day25_hours);
		$criteria->compare('day26_code',$this->day26_code,true);
		$criteria->compare('day26_hours',$this->day26_hours);
		$criteria->compare('day27_code',$this->day27_code,true);
		$criteria->compare('day27_hours',$this->day27_hours);
		$criteria->compare('day28_code',$this->day28_code,true);
		$criteria->compare('day28_hours',$this->day28_hours);
		$criteria->compare('day29_code',$this->day29_code,true);
		$criteria->compare('day29_hours',$this->day29_hours);
		$criteria->compare('day30_code',$this->day30_code,true);
		$criteria->compare('day30_hours',$this->day30_hours);
		$criteria->compare('day31_code',$this->day31_code,true);
		$criteria->compare('day31_hours',$this->day31_hours);
		$criteria->compare('dni_roboti',$this->dni_roboti);
		$criteria->compare('vid_godin',$this->vid_godin);
		$criteria->compare('vid_nichnih',$this->vid_nichnih);
		$criteria->compare('vid_nadurochno',$this->vid_nadurochno);
		$criteria->compare('vid_vihidnih',$this->vid_vihidnih);
		$criteria->compare('vid_vidryadgenya',$this->vid_vidryadgenya);
		$criteria->compare('neyavok_dniv',$this->neyavok_dniv);
		$criteria->compare('neyavok_godin',$this->neyavok_godin);
		$criteria->compare('neyavok_v',$this->neyavok_v);
		$criteria->compare('neyavok_d',$this->neyavok_d);
		$criteria->compare('neyavok_ch',$this->neyavok_ch);
		$criteria->compare('neyavok_n',$this->neyavok_n);
		$criteria->compare('neyavok_db',$this->neyavok_db);
		$criteria->compare('neyavok_do',$this->neyavok_do);
		$criteria->compare('neyavok_vp',$this->neyavok_vp);
		$criteria->compare('neyavok_dd',$this->neyavok_dd);
		$criteria->compare('neyavok_na',$this->neyavok_na);
		$criteria->compare('neyavok_in',$this->neyavok_in);
		$criteria->compare('neyavok_pr',$this->neyavok_pr);
		$criteria->compare('neyavok_tn',$this->neyavok_tn);
		$criteria->compare('neyavok_nn',$this->neyavok_nn);
		$criteria->compare('neyavok_i',$this->neyavok_i);
		$criteria->compare('date_completion',$this->date_completion,true);

        $criteria->together  =  true;
        $criteria->with = array('user');
        $criteria->compare('user.last_name',$this->userLastName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => 50,
            ),
            'sort' => array(
                'attributes' => array(
                    'userLastName' => array(
                        'asc'=>'user.last_name',
                        'desc'=>'user.last_name DESC',
                    ),
                    '*',
                )

            ),
        ));
	}

    public function getAllPeriod($editorId = 0) {

        $criteria=new CDbCriteria;
        $criteria->distinct = true;
        $criteria->select = array(
            'date_completion',
        );
        if ($editorId != 0) $criteria->condition = 'editor_id='.(int)$editorId;
        $dates = $this->model()->findAll($criteria);
        foreach ($dates as $date) {
            $date->month = Yii::app()->dateFormatter->format("MMMM y", $date->date_completion);
        }

        return $dates;

        //echo "<pre>";
        //print_r($dates);
        //echo "</pre>";
        //exit;

    }

    /**
     * Считает сумму всех дней работы
     * @param $id integer
     */
    public function sumWorkAllDays($id){

    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Table the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}



    protected function afterFind(){

        for ($i=1;$i<32;$i++){
            $name = 'day'.$i;
            $code = 'day'.$i.'_code';
            $hours = 'day'.$i.'_hours';
            if ($this->{$code} != '') {
                if ($this->{$hours} != 0) $separator = '/'.$this->{$hours};
                else $separator = '';
                $this->{$name} = $this->{$code}.$separator;
            }

        }


        return parent::afterFind();
    }




}
