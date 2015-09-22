<?php
$this->breadcrumbs=array(
	'Tables'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List Table','url'=>array('index')),
array('label'=>'Create Table','url'=>array('create')),
array('label'=>'Update Table','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Table','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Table','url'=>array('admin')),
);
?>

<h1>View Table #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'user_id',
		'depaetment_id',
		'day1_code',
		'day1_hours',
		'day2_code',
		'day2_hours',
		'day3_code',
		'day3_hours',
		'day4_code',
		'day4_hours',
		'day5_code',
		'day5_hours',
		'day6_code',
		'day6_hours',
		'day7_code',
		'day7_hours',
		'day8_code',
		'day8_hours',
		'day9_code',
		'day9_hours',
		'day10_code',
		'day10_hours',
		'day11_code',
		'day11_hours',
		'day12_code',
		'day12_hours',
		'day13_code',
		'day13_hours',
		'day14_code',
		'day14_hours',
		'day15_code',
		'day15_hours',
		'day16_code',
		'day16_hours',
		'day17_code',
		'day17_hours',
		'day18_code',
		'day18_hours',
		'day19_code',
		'day19_hours',
		'day20_code',
		'day20_hours',
		'day21_code',
		'day21_hours',
		'day22_code',
		'day22_hours',
		'day23_code',
		'day23_hours',
		'day24_code',
		'day24_hours',
		'day25_code',
		'day25_hours',
		'day26_code',
		'day26_hours',
		'day27_code',
		'day27_hours',
		'day28_code',
		'day28_hours',
		'day29_code',
		'day29_hours',
		'day30_code',
		'day30_hours',
		'day31_code',
		'day31_hours',
		'work_all_days',
		'worked_out_hours',
		'worked_out_4',
		'worked_out_5',
		'worked_out_7',
		'worked_out_6',
		'absence_all_days',
		'absence_all_hours',
		'absence_8',
		'absence_9',
		'absence_10',
		'absence_12',
		'absence_14',
		'absence_15',
		'absence_16',
		'absence_17',
		'absence_18',
		'absence_22',
		'absence_24',
		'absence_26',
		'absence_27',
		'absence_30',
		'date_completion',
),
)); ?>