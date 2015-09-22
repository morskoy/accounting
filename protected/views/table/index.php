<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->assetManager->basePath . '/js/'). '/jquery.fixedtable.js', CClientScript::POS_HEAD);

Yii::app()->clientScript->registerScript('loading', '

    $(".tableDiv").each(function() {
            var Id = $(this).get(0).id;
            var maintbheight = 800;
            var maintbwidth = 1000;

            $("#" + Id + " .FixedTables").fixedTable({
                width: maintbwidth,
                height: maintbheight,
                fixedColumns: 1,
                // header style
                classHeader: "fixedHead",
                // footer style
                classFooter: "fixedFoot",
                // fixed column on the left
                classColumn: "fixedColumn",
                // the width of fixed column on the left
                fixedColumnWidth: 150,
                // tables parent divs id
                outerId: Id,
                // tds in content area default background color
                Contentbackcolor: "#FFFFFF",
                // tds in content area background color while hover.
                Contenthovercolor: "#99CCFF",
                // tds in fixed column default background color
                fixedColumnbackcolor:"#FFFFFF",
                // tds in fixed column background color while hover.
                fixedColumnhovercolor:"#99CCFF"
            });
        });
    $(".fixedTable table").css({"table-layout":"fixed", "margin":"0", "padding":"0"});
    $(".fixedHead table").css({"table-layout":"fixed"});
	$(".fixedColumn  .fixedHead table").css({"margin-bottom":"20px"});
	$(".fixedColumn  .fixedTable table > tbody > tr > td").css({"border-top":"1px solid #dddddd"});
	$("table.FixedTables tbody tr td").css({"border-left":"1px solid #dddddd", "vertical-align":"middle"});
	$(".fixedHead table > tbody > tr > td").css({"padding":"0", "margin":"0"});
	$(".fixedContainer .fixedHead table").css("margin","0");
	$(".fixedContainer .fixedHead table > tbody > tr > td").css({"border-left":"1px solid #dddddd", "text-align":"center"});
', CClientScript::POS_READY);
$this->breadcrumbs=array(
	'Tables',
);
?>

<h1>Табель</h1>

<?php
$period = array(
    '2014-01-01' => 'январь 2014',
    '2014-02-01' => 'февраль 2014',
    '2014-03-01' => 'март 2014',
    '2014-04-01' => 'апрель 2014',
    '2014-05-01' => 'май 2014',
    '2014-06-01' => 'июнь 2014',
    '2014-07-01' => 'июль 2014',
    '2014-08-01' => 'август 2014',
    '2014-09-01' => 'сентябрь 2014',
    '2014-10-01' => 'октябрь 2014',
    '2014-11-01' => 'ноябрь 2014',
    '2014-12-01' => 'декабрь 2014',
);
$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id'=>'inlineForm',
                    'type'=>'inline',
                    'htmlOptions'=>array('class'=>'well'),
));
?>
<?php echo CHtml::label('Период&nbsp;','dateCompletion');?>
<?php echo CHtml::dropDownList('dateCompletion', 'dateCompletion', $period, array('class'=>'span2',)); ?>
<?php echo CHtml::label('Редактор&nbsp;','editorId',array('style'=>'margin-left:20px;'));?>
<?php echo CHtml::dropDownList('editorId', 'editorId', CHtml::listData(User::model()->getAllShortFio(),'id','shortName'), array('class'=>'span2')); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Открыть', 'htmlOptions' => array('style'=>'margin-left:20px;'))); ?>
<?php $this->endWidget(); ?>
<?php if (isset($dataProvider)) : ?>
    <?php
    echo '<h4>Период: '.$period[$dateCompletion].'&nbsp;&nbsp;&nbsp; Редактор: '.User::model()->findByPk($editorId)->getFullFio().'</h4>';
    $daysMonth = cal_days_in_month(CAL_GREGORIAN, substr($dateCompletion,5,2), substr($dateCompletion,0,4));
    $this->widget('bootstrap.widgets.TbExtendedGridView',array(
        'itemsCssClass' => 'FixedTables',
        'htmlOptions' => array('class' => 'tableDiv'),
        'dataProvider'=>$dataProvider,
        'template'=>'{items} {pager}',
        'columns'=>array(
            array(
                'name' =>'user_id',
                'value' => '$data->user->ShortFio',
                'sortable'=>false,
                'htmlOptions'=>array('style'=>'text-align:left;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
            ),
            array(

                'header'=>'1',
                'name'=>'day1',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-01')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;

                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px !important;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'class' => 'editable.EditableColumn',
                'value' => 'CHtml::value($data, "day1")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day1',
                    'apply'  => '$data->period_1 == 0',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    //'showbuttons' => false,
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'header'=>'2',
                'name'=>'day2',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-02')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'class' => 'editable.EditableColumn',
                'value' => 'CHtml::value($data, "day2")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day2',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day3',
                'header'=>'3',
                'class' => 'editable.EditableColumn',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-03')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'value' => 'CHtml::value($data, "day3")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day3',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day4',
                'header'=>'4',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-04')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'class' => 'editable.EditableColumn',
                'value' => 'CHtml::value($data, "day4")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day4',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day5',
                'header'=>'5',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-05')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'class' => 'editable.EditableColumn',
                'value' => 'CHtml::value($data, "day5")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day5',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day6',
                'header'=>'6',
                'class' => 'editable.EditableColumn',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-06')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'value' => 'CHtml::value($data, "day6")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day6',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day7',
                'header'=>'7',
                'class' => 'editable.EditableColumn',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-07')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'value' => 'CHtml::value($data, "day7")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day7',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day8',
                'header'=>'8',
                'class' => 'editable.EditableColumn',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-08')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'value' => 'CHtml::value($data, "day8")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day8',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day9',
                'header'=>'9',
                'class' => 'editable.EditableColumn',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-09')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'value' => 'CHtml::value($data, "day9")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day9',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day10',
                'header'=>'10',
                'class' => 'editable.EditableColumn',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-10')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'value' => 'CHtml::value($data, "day10")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day10',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day11',
                'header'=>'11',
                'class' => 'editable.EditableColumn',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-11')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'value' => 'CHtml::value($data, "day11")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day11',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day12',
                'header'=>'12',
                'class' => 'editable.EditableColumn',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-12')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'value' => 'CHtml::value($data, "day12")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day12',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day13',
                'header'=>'13',
                'class' => 'editable.EditableColumn',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-13')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'value' => 'CHtml::value($data, "day13")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day13',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day14',
                'header'=>'14',
                'class' => 'editable.EditableColumn',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-14')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'value' => 'CHtml::value($data, "day14")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day14',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'header'=>'15',
                'name'=>'day15',
                'class' => 'editable.EditableColumn',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-15')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'value' => 'CHtml::value($data, "day15")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day15',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day16',
                'header'=>'16',
                'class' => 'editable.EditableColumn',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-16')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'value' => 'CHtml::value($data, "day16")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day16',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day17',
                'header'=>'17',
                'class' => 'editable.EditableColumn',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-17')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'value' => 'CHtml::value($data, "day17")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day17',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day18',
                'header'=>'18',
                'class' => 'editable.EditableColumn',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-18')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'value' => 'CHtml::value($data, "day18")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day18',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day19',
                'header'=>'19',
                'class' => 'editable.EditableColumn',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-19')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'value' => 'CHtml::value($data, "day19")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day19',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day20',
                'header'=>'20',
                'class' => 'editable.EditableColumn',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-20')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'value' => 'CHtml::value($data, "day20")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day20',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day21',
                'header'=>'21',
                'class' => 'editable.EditableColumn',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-21')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'value' => 'CHtml::value($data, "day21")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day21',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day22',
                'header'=>'22',
                'class' => 'editable.EditableColumn',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-22')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'value' => 'CHtml::value($data, "day22")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day22',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day23',
                'header'=>'23',
                'class' => 'editable.EditableColumn',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-23')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'value' => 'CHtml::value($data, "day23")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day23',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day24',
                'header'=>'24',
                'class' => 'editable.EditableColumn',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-24')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'value' => 'CHtml::value($data, "day24")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day24',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day25',
                'header'=>'25',
                'class' => 'editable.EditableColumn',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-25')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'value' => 'CHtml::value($data, "day25")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day25',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day26',
                'header'=>'26',
                'class' => 'editable.EditableColumn',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-26')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'value' => 'CHtml::value($data, "day26")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day26',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day27',
                'header'=>'27',
                'class' => 'editable.EditableColumn',
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-27')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'value' => 'CHtml::value($data, "day27")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day27',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day28',
                'header'=>'28',
                'visible' => $daysMonth >= 28 ? true : false,
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-28')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'class' => 'editable.EditableColumn',
                'value' => 'CHtml::value($data, "day28")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day28',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),

            array(
                'name'=>'day29',
                'header'=>'29',
                'visible' => $daysMonth >= 29 ? true : false,
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-29')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'class' => 'editable.EditableColumn',
                'value' => 'CHtml::value($data, "day29")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day29',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day30',
                'header'=>'30',
                'visible' => $daysMonth >= 30 ? true : false,
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-30')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'class' => 'editable.EditableColumn',
                'value' => 'CHtml::value($data, "day30")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day30',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name'=>'day31',
                'visible' => $daysMonth >= 31 ? true : false,
                'cssClassExpression' => function() use ($dateCompletion)  {
                        if (in_array(date('N', strtotime(substr($dateCompletion,0,4).'-'.substr($dateCompletion,5,2).'-31')), array(6,7))) $dayoff = 'dayoff';
                        else $dayoff = '';
                        return $dayoff;
                    },
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'header'=>'31',
                'class' => 'editable.EditableColumn',
                'value' => 'CHtml::value($data, "day31")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'day31',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',
                    'success' => 'js: function(response) {
                        if(response.success == true) {
                            $("td.dni_roboti_"+response.id).text(response.dni_roboti);
                            $("td.vid_godin_"+response.id).text(response.vid_godin);
                            $("td.vid_nichnih_"+response.id).text(response.vid_nichnih);

                            $("td.vid_vihidnih_"+response.id).text(response.vid_vihidnih);
                            $("td.vid_vidryadgenya_"+response.id).text(response.vid_vidryadgenya);
                            $("td.neyavok_dniv_"+response.id).text(response.neyavok_dniv);
                            $("td.neyavok_godin_"+response.id).text(response.neyavok_godin);
                            $("td.neyavok_v_"+response.id).text(response.neyavok_v);
                            $("td.neyavok_d_"+response.id).text(response.neyavok_d);
                            $("td.neyavok_ch_"+response.id).text(response.neyavok_ch);
                            $("td.neyavok_n_"+response.id).text(response.neyavok_n);
                            $("td.neyavok_db_"+response.id).text(response.neyavok_db);
                            $("td.neyavok_do_"+response.id).text(response.neyavok_do);
                            $("td.neyavok_vp_"+response.id).text(response.neyavok_vp);
                            $("td.neyavok_dd_"+response.id).text(response.neyavok_dd);
                            $("td.neyavok_na_"+response.id).text(response.neyavok_na);
                            $("td.neyavok_in_"+response.id).text(response.neyavok_in);
                            $("td.neyavok_pr_"+response.id).text(response.neyavok_pr);
                            $("td.neyavok_tn_"+response.id).text(response.neyavok_tn);
                            $("td.neyavok_nn_"+response.id).text(response.neyavok_nn);
                            $("td.neyavok_i_"+response.id).text(response.neyavok_i);

                        }

                    }',
                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name' => 'dni_roboti',
                'sortable'=>false,
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;background-color:#D3F4FF !important; z-index:"ordering_{$data->id}"'),
                'cssClassExpression'=>'"dni_roboti_{$data->id}"',
                'headerHtmlOptions'=>array(
                    'style'=>'text-align:center;width:30px;padding:0;-webkit-transform: rotate(-90deg);',
                    'class'=>'vertical_text'
                ),
            ),
            array(
                'name' => 'vid_godin',
                'sortable'=>false,
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;background-color:#D3F4FF !important'),
                'cssClassExpression'=>'"vid_godin_{$data->id}"',
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
            ),
            array(
                'name' => 'vid_nichnih',
                'sortable'=>false,
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;background-color:#D3F4FF !important'),
                'cssClassExpression'=>'"vid_nichnih_{$data->id}"',
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
            ),
            array(
                'name' => 'vid_nadurochno',
                'sortable'=>false,
                'class' => 'editable.EditableColumn',
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;background-color:#D3F4FF !important'),
                //'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;'),
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'value' => 'CHtml::value($data, "vid_nadurochno")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'vid_nadurochno',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',

                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )

                //'cssClassExpression'=>'"vid_nadurochno_{$data->id}"',
                //'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
            ),
            array(
                'name' => 'vid_vidryadgenya',
                'sortable'=>false,
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;background-color:#D3F4FF !important'),
                'cssClassExpression'=>'"vid_vidryadgenya_{$data->id}"',
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
            ),
            array(
                'name' => 'vid_vihidnih',
                'sortable'=>false,
                'class' => 'editable.EditableColumn',
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;background-color:#D3F4FF !important'),
                //'cssClassExpression'=>'"vid_vihidnih_{$data->id}"',
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
                'value' => 'CHtml::value($data, "vid_vihidnih")',
                'editable' => array(
                    'type'      => 'text',
                    'attribute' => 'vid_vihidnih',
                    'url'       => $this->createUrl('table/update'),
                    'placement' => 'right',

                    'options' => array(
                        'ajaxOptions' => array('dataType' => 'json')
                    )
                )
            ),
            array(
                'name' => 'neyavok_dniv',
                'sortable'=>false,
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;background-color:#D3F4FF !important'),
                'cssClassExpression'=>'"neyavok_dniv_{$data->id}"',
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
            ),
            array(
                'name' => 'neyavok_godin',
                'sortable'=>false,
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;background-color:#D3F4FF !important'),
                'cssClassExpression'=>'"neyavok_godin_{$data->id}"',
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
            ),
            array(
                'name' => 'neyavok_v',
                'sortable'=>false,
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;background-color:#D3F4FF !important'),
                'cssClassExpression'=>'"neyavok_v_{$data->id}"',
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
            ),
            array(
                'name' => 'neyavok_d',
                'sortable'=>false,
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;background-color:#D3F4FF !important'),
                'cssClassExpression'=>'"neyavok_d_{$data->id}"',
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
            ),
            array(
                'name' => 'neyavok_ch',
                'sortable'=>false,
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;background-color:#D3F4FF !important'),
                'cssClassExpression'=>'"neyavok_ch_{$data->id}"',
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
            ),
            array(
                'name' => 'neyavok_n',
                'sortable'=>false,
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;background-color:#D3F4FF !important'),
                'cssClassExpression'=>'"neyavok_n_{$data->id}"',
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
            ),
            array(
                'name' => 'neyavok_db',
                'sortable'=>false,
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;background-color:#D3F4FF !important'),
                'cssClassExpression'=>'"neyavok_db_{$data->id}"',
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
            ),
            array(
                'name' => 'neyavok_do',
                'sortable'=>false,
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;background-color:#D3F4FF !important'),
                'cssClassExpression'=>'"neyavok_do_{$data->id}"',
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
            ),
            array(
                'name' => 'neyavok_vp',
                'sortable'=>false,
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;background-color:#D3F4FF !important'),
                'cssClassExpression'=>'"neyavok_vp_{$data->id}"',
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
            ),
            array(
                'name' => 'neyavok_dd',
                'sortable'=>false,
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;background-color:#D3F4FF !important'),
                'cssClassExpression'=>'"neyavok_dd_{$data->id}"',
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
            ),
            array(
                'name' => 'neyavok_na',
                'sortable'=>false,
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;background-color:#D3F4FF !important'),
                'cssClassExpression'=>'"neyavok_na_{$data->id}"',
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
            ),
            array(
                'name' => 'neyavok_in',
                'sortable'=>false,
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;background-color:#D3F4FF !important'),
                'cssClassExpression'=>'"neyavok_in_{$data->id}"',
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
            ),
            array(
                'name' => 'neyavok_pr',
                'sortable'=>false,
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;background-color:#D3F4FF !important'),
                'cssClassExpression'=>'"neyavok_pr_{$data->id}"',
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
            ),
            array(
                'name' => 'neyavok_tn',
                'sortable'=>false,
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;background-color:#D3F4FF !important'),
                'cssClassExpression'=>'"neyavok_tn_{$data->id}"',
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
            ),
            array(
                'name' => 'neyavok_nn',
                'sortable'=>false,
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;background-color:#D3F4FF !important'),
                'cssClassExpression'=>'"neyavok_nn_{$data->id}"',
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
            ),
            array(
                'name' => 'neyavok_i',
                'sortable'=>false,
                'htmlOptions'=>array('style'=>'text-align:center;width:40px;padding:0;background-color:#D3F4FF !important'),
                'cssClassExpression'=>'"neyavok_i_{$data->id}"',
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
            ),




            /*
            array(
      'class'=>'bootstrap.widgets.TbButtonColumn',
      ),
      */
        ),
    ));
    ?>
<?php endif; ?>
