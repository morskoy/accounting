<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('department_id')); ?>:</b>
	<?php echo CHtml::encode($data->department_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day1_code')); ?>:</b>
	<?php echo CHtml::encode($data->day1_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day1_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day1_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day2_code')); ?>:</b>
	<?php echo CHtml::encode($data->day2_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day2_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day2_hours); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('day3_code')); ?>:</b>
	<?php echo CHtml::encode($data->day3_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day3_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day3_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day4_code')); ?>:</b>
	<?php echo CHtml::encode($data->day4_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day4_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day4_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day5_code')); ?>:</b>
	<?php echo CHtml::encode($data->day5_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day5_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day5_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day6_code')); ?>:</b>
	<?php echo CHtml::encode($data->day6_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day6_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day6_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day7_code')); ?>:</b>
	<?php echo CHtml::encode($data->day7_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day7_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day7_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day8_code')); ?>:</b>
	<?php echo CHtml::encode($data->day8_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day8_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day8_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day9_code')); ?>:</b>
	<?php echo CHtml::encode($data->day9_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day9_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day9_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day10_code')); ?>:</b>
	<?php echo CHtml::encode($data->day10_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day10_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day10_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day11_code')); ?>:</b>
	<?php echo CHtml::encode($data->day11_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day11_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day11_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day12_code')); ?>:</b>
	<?php echo CHtml::encode($data->day12_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day12_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day12_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day13_code')); ?>:</b>
	<?php echo CHtml::encode($data->day13_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day13_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day13_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day14_code')); ?>:</b>
	<?php echo CHtml::encode($data->day14_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day14_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day14_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day15_code')); ?>:</b>
	<?php echo CHtml::encode($data->day15_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day15_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day15_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day16_code')); ?>:</b>
	<?php echo CHtml::encode($data->day16_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day16_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day16_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day17_code')); ?>:</b>
	<?php echo CHtml::encode($data->day17_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day17_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day17_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day18_code')); ?>:</b>
	<?php echo CHtml::encode($data->day18_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day18_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day18_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day19_code')); ?>:</b>
	<?php echo CHtml::encode($data->day19_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day19_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day19_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day20_code')); ?>:</b>
	<?php echo CHtml::encode($data->day20_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day20_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day20_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day21_code')); ?>:</b>
	<?php echo CHtml::encode($data->day21_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day21_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day21_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day22_code')); ?>:</b>
	<?php echo CHtml::encode($data->day22_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day22_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day22_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day23_code')); ?>:</b>
	<?php echo CHtml::encode($data->day23_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day23_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day23_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day24_code')); ?>:</b>
	<?php echo CHtml::encode($data->day24_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day24_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day24_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day25_code')); ?>:</b>
	<?php echo CHtml::encode($data->day25_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day25_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day25_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day26_code')); ?>:</b>
	<?php echo CHtml::encode($data->day26_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day26_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day26_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day27_code')); ?>:</b>
	<?php echo CHtml::encode($data->day27_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day27_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day27_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day28_code')); ?>:</b>
	<?php echo CHtml::encode($data->day28_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day28_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day28_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day29_code')); ?>:</b>
	<?php echo CHtml::encode($data->day29_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day29_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day29_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day30_code')); ?>:</b>
	<?php echo CHtml::encode($data->day30_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day30_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day30_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day31_code')); ?>:</b>
	<?php echo CHtml::encode($data->day31_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day31_hours')); ?>:</b>
	<?php echo CHtml::encode($data->day31_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('work_all_days')); ?>:</b>
	<?php echo CHtml::encode($data->work_all_days); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('worked_out_hours')); ?>:</b>
	<?php echo CHtml::encode($data->worked_out_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('worked_out_4')); ?>:</b>
	<?php echo CHtml::encode($data->worked_out_4); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('worked_out_5')); ?>:</b>
	<?php echo CHtml::encode($data->worked_out_5); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('worked_out_7')); ?>:</b>
	<?php echo CHtml::encode($data->worked_out_7); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('worked_out_6')); ?>:</b>
	<?php echo CHtml::encode($data->worked_out_6); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('absence_all_days')); ?>:</b>
	<?php echo CHtml::encode($data->absence_all_days); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('absence_all_hours')); ?>:</b>
	<?php echo CHtml::encode($data->absence_all_hours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('absence_8')); ?>:</b>
	<?php echo CHtml::encode($data->absence_8); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('absence_9')); ?>:</b>
	<?php echo CHtml::encode($data->absence_9); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('absence_10')); ?>:</b>
	<?php echo CHtml::encode($data->absence_10); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('absence_12')); ?>:</b>
	<?php echo CHtml::encode($data->absence_12); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('absence_14')); ?>:</b>
	<?php echo CHtml::encode($data->absence_14); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('absence_15')); ?>:</b>
	<?php echo CHtml::encode($data->absence_15); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('absence_16')); ?>:</b>
	<?php echo CHtml::encode($data->absence_16); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('absence_17')); ?>:</b>
	<?php echo CHtml::encode($data->absence_17); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('absence_18')); ?>:</b>
	<?php echo CHtml::encode($data->absence_18); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('absence_22')); ?>:</b>
	<?php echo CHtml::encode($data->absence_22); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('absence_24')); ?>:</b>
	<?php echo CHtml::encode($data->absence_24); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('absence_26')); ?>:</b>
	<?php echo CHtml::encode($data->absence_26); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('absence_27')); ?>:</b>
	<?php echo CHtml::encode($data->absence_27); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('absence_30')); ?>:</b>
	<?php echo CHtml::encode($data->absence_30); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_completion')); ?>:</b>
	<?php echo CHtml::encode($data->date_completion); ?>
	<br />

	*/ ?>

</div>