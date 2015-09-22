<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<br>
<br>

<div style="float: left;">

</div>

<div style="margin-left:10px; float: left;">
    <?php
    $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => 'Дни рождения',
        'headerIcon' => 'icon-calendar',
    ));
    $this->widget('application.components.Birthday');
    $this->endWidget();
    ?>
</div>

