<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="ru" />


	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<script type="text/javascript">
    $(document).ready(function() {
// Create two variable with the names of the months and days in an array
        var monthNames = [ "Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь" ];
        var dayNames= ["Воскресенье","Понедельник","Вторник","Среда","Четверг","Пятница","Суббота"]

// Create a newDate() object
        var newDate = new Date();
// Extract the current date from Date object
        newDate.setDate(newDate.getDate());
// Output the day, date, month and year
        $('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

        setInterval( function() {
            // Create a newDate() object and extract the seconds of the current time on the visitor's
            var seconds = new Date().getSeconds();
            // Add a leading zero to seconds value
            $("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
        },1000);

        setInterval( function() {
            // Create a newDate() object and extract the minutes of the current time on the visitor's
            var minutes = new Date().getMinutes();
            // Add a leading zero to the minutes value
            $("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
        },1000);

        setInterval( function() {
            // Create a newDate() object and extract the hours of the current time on the visitor's
            var hours = new Date().getHours();
            // Add a leading zero to the hours value
            $("#hours").html(( hours < 10 ? "0" : "" ) + hours);
        }, 1000);
    });
</script>

<div class="container" id="page">

	<div id="header">
		<!--<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>-->
	</div><!-- header -->

	<div id="mainmenu">
        <?php
            $this->widget('bootstrap.widgets.TbNavbar', array(
                'type'=>'null', // null or 'inverse'
                'brandUrl'=>'/',
                'fluid'=>true,
                'fixed' => 'top',
               // 'collapse'=>true, // requires bootstrap-responsive.css
                'items'=>array(
                    array(
                        'class'=>'bootstrap.widgets.TbMenu',
                        'items'=>array(
                            array('label'=>'Справочник', 'url'=>'#', 'items'=>array(
                                array('label'=>'Телефоны','url'=>array('/user/spravka')),
                            )),
                            array('label'=>'Документооборот', 'url'=>'#', 'visible'=>Yii::app()->user->checkAccess('user'), 'items'=>array(
                                array('label'=>'HelpDesk', 'url'=>array('/helpdesk/index')),
                                array('label'=>'Выезд', 'url'=>array('/departure/index')),
                                array('label'=>'Табель', 'url'=>array('/table/index')  /* 'visible'=>Yii::app()->user->EditorTable == 1  ? true : false */ ),
                            )),
                            array('label'=>'Администрирование', 'url'=>'#', 'visible'=>Yii::app()->user->checkAccess('editor'),
                                'items'=>array(
                                    array('label'=>'Пользователи', 'url'=>array('/user/index')),
                                    array('label'=>'HelpDesk', 'url'=>array('/helpdesk/indexadm'), 'visible'=>Yii::app()->user->checkAccess('administrator')),
                                    array('label'=>'Устройства', 'url'=>array('/devices/admin'), 'visible'=>Yii::app()->user->checkAccess('administrator')),
                                    array('label'=>'Выезд', 'url'=>array('/departure/admin'), 'visible'=>Yii::app()->user->checkAccess('administrator')),
                                    array('label'=>'Пароли', 'url'=>array('/pass/admin'), 'visible'=>Yii::app()->user->checkAccess('administrator')),
                                    array('label'=>'Отделы', 'url'=>array('/department/admin')),
                                )
                            ),
                        ),
                    ),
                    '<div class="pull-right" style="text-align: center">
                        <div id="Date"></div>
                        <span id="hours"></span>:<span id="min"></span>:<span id="sec"></span>
                    </div>',

                    array(
                        'class' => 'bootstrap.widgets.TbMenu',
                        'htmlOptions' => array('class'=>'pull-right'),
                        'items' => array(
                             array('label'=>'Вход', 'url'=>'#', 'visible'=>Yii::app()->user->isGuest, 'itemOptions'=>array('data-toggle'=>'modal', 'data-target'=>'#loginModalForm')),
                            array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                            '---',
                        ),

                    ),



                 )));

        ?>
</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
			'homeLink' => CHtml::link('Главная', Yii::app()->homeUrl),
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?><br/>
		All Rights Reserved.<br/>
	</div><!-- footer -->

</div><!-- page -->



<?php
//Подключаем виджет модального окна
$this->beginWidget('bootstrap.widgets.TbModal', array(
    'id'=>'loginModalForm',
    'htmlOptions'=>array(
        'style'=>'display: none;',  //скрываем модальное окно в неактивном состоянии, исключая возможное перекрытие с другими элементами страницы
    ),
));
//модель формы входа и виджет формы
$model = new LoginForm;
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'login-form',
    'action'=>$this->createAbsoluteUrl('/site/login'),
    'enableAjaxValidation' => true,  // активируем ajax-валидацию, при ошибках ввода логина/пароля - ошибка будет отображаться в нашем модальном окне
    'enableClientValidation'=>true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => false,
    ),
    'htmlOptions'=>array(),
));
?>
<!-- заголовок модального окна -->
<div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h4>Вход на сайт</h4>
</div>
<!-- тело модального окна, выводим элементы формы -->
<div class="modal-body">
    <?php
    //Элементы формы
    echo $form->textFieldRow($model, 'username', array('class'=>'span3'));
    echo $form->passwordFieldRow($model, 'password', array('class'=>'span3'));
    echo $form->checkboxRow($model, 'rememberMe');
    ?>
</div>
<!-- подвал формы, где выводятся кнопки отправки формы и закрытия модального окна -->
<div class="modal-footer">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'submit',
        'label'=>'Вход',
    ));
    ?>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Закрыть',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    ));
    ?>
</div>

<?php
$this->endWidget();
$this->endWidget();
?>


</body>
</html>