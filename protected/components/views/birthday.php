<ul>
<?php
    foreach ($birthdays as $birthday) {
        if (Yii::app()->locale->dateFormatter->format("d MMMM", $birthday->birthday) == Yii::app()->locale->dateFormatter->format("d MMMM", date("Y-m-d H:i:s"))) $color = 'style="text-shadow: 1px 1px 1px #555;color:#f62f2f;"';
        else $color = '';
        echo "<li $color><b>".Yii::app()->locale->dateFormatter->format("d MMMM", $birthday->birthday)."</b><br>".$birthday->last_name." ".$birthday->name." ".$birthday->middle_name."</li>";
    }
?>
</ul>
