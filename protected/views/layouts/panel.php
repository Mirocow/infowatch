<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/fw/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/fw/fa/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/fw/jstree/themes/default/style.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/raw.css">

    <script type="application/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/fw/jquery.js"></script>
    <script type="application/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/fw/bootstrap/js/bootstrap.min.js"></script>
    <script type="application/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/fw/jstree/jstree.min.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
    <div class="layout">
        <section id="header">
            <header class="layout--header header"><div class="header--wrap navbar">
                    <a href="" class="header--iw_logo"></a>

                    <div class="user_panel pull-right">
                        <li class="language dropdown">
                            <a href="http://infowatch/#" class="dropdown-toggle" data-toggle="dropdown"><img src="http://infowatch/img/languages/language-rus.png"></a>
                            <ul class="dropdown-menu dropdown-menu-right icons-right">
                                <li class="active"><a href="http://infowatch/#" data-action="language" data-lang="rus"><img src="http://infowatch/img/languages/language-rus.png" alt=""> Русский</a></li>
                                <li class=""><a href="http://infowatch/#" data-action="language" data-lang="eng"><img src="http://infowatch/img/languages/language-eng.png" alt=""> Английский</a></li>
                            </ul>
                        </li>

                        <div class="user_panel--user dropdown user">
                            <a class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fontello-icon-user"></i>
                                <span>officer</span>
                                <i class="caret"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right icons-right">
                                <li><a href="http://infowatch/#" data-action="change_password"><i class="fontello-icon-key-1"></i> Сменить пароль</a></li>
                                <li><a href="http://infowatch/#" data-action="help"><i class="fontello-icon-info-circle"></i> Помощь</a></li>
                                <li><a href="http://infowatch/#" data-action="about"><i class=" fontello-icon-info-1"></i> О Системе</a></li>
                                <li><a href="http://infowatch/#" data-action="logout"><i class="fontello-icon-logout-2"></i> Выйти</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </header>
        </section>
        <section id="menu">
            <nav class="layout--nav  main_nav" style="height: 618px;">
                <div class="main_nav--wrap">
                    <section class="main_nav--section">
                        <h2 data-i18n="[html]menu.monitoring_group">мониторинг</h2>
                        <ul class="main_nav--list">
                            <li><a class="i-nav i-events" href="<?=$this->createUrl('/panel/index');?>" data-i18n="[data-original-title]menu.events;[title]menu.events;menu.events" data-bypass="" data-original-title="События" title="События">Онлайн</a></li>
                        </ul>
                    </section>

                    <section class="main_nav--section">
                        <h2 data-i18n="[html]menu.control_group">контроль</h2>
                        <ul class="main_nav--list">
                            <li><a class="i-nav i-structure" href="<?=$this->createUrl('/panel/persons');?>" data-i18n="[data-original-title]menu.organization;[title]menu.organization;menu.organization" data-bypass="" data-original-title="Сотрудники" title="Сотрудники">Сотрудники</a></li>
                        </ul>
                    </section>

                    <section class="main_nav--section">
                        <h2 data-i18n="[html]menu.administration_group">настройки</h2>
                        <ul class="main_nav--list">
                            <li><a class="i-nav i-settings" href="<?=$this->createUrl('/panel/settings');?>" data-i18n="[data-original-title]menu.administration;[title]menu.administration;menu.administration" data-bypass="" data-original-title="Управление" title="Управление">Управление</a></li>
                        </ul>
                    </section>
                </div>
            </nav>
        </section>
        <section id="layout--wrapper" class="layout--wrapper">
            <section id="layout--sidebar" class="layout--sidebar sidebar" style="display: none;"></section>
            <section id="layout--content" class="layout--content" style="opacity: 1; height: 557px;">
                <div>
                    <?php echo $content; ?>
                </div>
            </section>
        </section>
    </div>
</body>
</html>



