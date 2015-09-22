<h1>Табеля в Экселе</h1>
<?php
$this->widget('EExcelView', array(
        'dataProvider'=> $dataProvider,
        //'grid_mode'=>'export',
        'title'=>$title,
        'filename'=>$title,
        //'stream'=>false,
        'exportType'=>'Excel2007',
        'grid_mode'            => 'export', // Same usage as EExcelView v0.33
        //'template'           => "{summary}\n{items}\n{exportbuttons}\n{pager}",
        //'title'                => 'Some title - ' . date('d-m-Y - H-i-s'),
        'creator'              => 'User',
        'subject'              => mb_convert_encoding('Something important with a date in French: ' . utf8_encode(strftime('%e %B %Y')), 'ISO-8859-1', 'UTF-8'),
        'description'          => mb_convert_encoding('Etat de production généré à la demande par l\'administrateur (some text in French).', 'ISO-8859-1', 'UTF-8'),
        'lastModifiedBy'       => 'Some Name',
        'sheetTitle'           => $title,
        'keywords'             => '',
        'category'             => '',
        'landscapeDisplay'     => true, // Default: false
        'A4'                   => true, // Default: false - ie : Letter (PHPExcel default)
        'pageFooterText'       => '&RThis is page no. &P of &N pages', // Default: '&RPage &P of &N'
        'automaticSum'         => false, // Default: false
        'decimalSeparator'     => ',', // Default: '.'
        'thousandsSeparator'   => '.', // Default: ','
        //'displayZeros'       => false,
        //'zeroPlaceholder'    => '-',
        'sumLabel'             => 'Column totals:', // Default: 'Totals'
        'borderColor'          => '000000', // Default: '000000'
        'bgColor'              => 'ffffff', // Default: 'FFFFFF'
        'textColor'            => '000000', // Default: '000000'
        'rowHeight'            => 35, // Default: 15
        'headerBorderColor'    => 'FF0000', // Default: '000000'
        'headerBgColor'        => 'CCCCCC', // Default: 'CCCCCC'
        'headerTextColor'      => '0000FF', // Default: '000000'
        'headerHeight'         => 20, // Default: 20
        'footerBorderColor'    => '0000FF', // Default: '000000'
        'footerBgColor'        => '00FFCC', // Default: 'FFFFCC'
        'footerTextColor'      => 'FF00FF', // Default: '0000FF'
        'footerHeight'         => 50, // Default: 20

        'columns'=>array(

            array(
                'name' =>'user_id',
                'value' => '$data->user->ShortFio',
            ),
            array(
                'name'=>'day1',
                'header'=>'1',
            ),
            array(
                'name'=>'day2',
                'header'=>'2',
            ),
            array(
                'name'=>'day3',
                'header'=>'3',
            ),
            array(
                'name'=>'day4',
                'header'=>'4',
            ),
            array(
                'name'=>'day5',
                'header'=>'5',
            ),
            array(
                'name'=>'day6',
                'header'=>'6',
            ),
            array(
                'name'=>'day7',
                'header'=>'7',
            ),
            array(
                'name'=>'day8',
                'header'=>'8',
            ),
            array(
                'name'=>'day9',
                'header'=>'9',
            ),
            array(
                'name'=>'day10',
                'header'=>'10',
            ),
            array(
                'name'=>'day11',
                'header'=>'11',
            ),array(
                'name'=>'day12',
                'header'=>'12',
            ),
            array(
                'name'=>'day13',
                'header'=>'13',
            ),array(
                'name'=>'day14',
                'header'=>'14',
            ),array(
                'name'=>'day15',
                'header'=>'15',
            ),array(
                'name'=>'day16',
                'header'=>'16',
            ),
            array(
                'name'=>'day17',
                'header'=>'17',
            ),array(
                'name'=>'day18',
                'header'=>'18',
            ),array(
                'name'=>'day19',
                'header'=>'19',
            ),array(
                'name'=>'day20',
                'header'=>'20',
            ),array(
                'name'=>'day21',
                'header'=>'21',
            ),array(
                'name'=>'day22',
                'header'=>'22',
            ),array(
                'name'=>'day23',
                'header'=>'23',
            ),array(
                'name'=>'day24',
                'header'=>'24',
            ),array(
                'name'=>'day25',
                'header'=>'25',
            ),array(
                'name'=>'day26',
                'header'=>'26',
            ),array(
                'name'=>'day27',
                'header'=>'27',
            ),array(
                'name'=>'day28',
                'header'=>'28',
                'visible' => $daysMonth >= 28 ? true : false,
            ),array(
                'name'=>'day29',
                'header'=>'29',
                'visible' => $daysMonth >= 29 ? true : false,
            ),array(
                'name'=>'day30',
                'header'=>'30',
                'visible' => $daysMonth >= 30 ? true : false,
            ),array(
                'name'=>'day31',
                'header'=>'31',
                'visible' => $daysMonth >= 31 ? true : false,
            ),
            'dni_roboti',
            'vid_godin',
            'vid_nichnih',
            'vid_nadurochno',
            'vid_vidryadgenya',
            'vid_vihidnih',
            'neyavok_dniv',
            'neyavok_godin',
            'neyavok_v',
            'neyavok_d',
            'neyavok_ch',
            'neyavok_n',
            'neyavok_db',
            'neyavok_do',
            'neyavok_vp',
            'neyavok_dd',
            'neyavok_na',
            'neyavok_in',
            'neyavok_pr',
            'neyavok_tn',
            'neyavok_nn',
            'neyavok_i',
        ),
));
?>