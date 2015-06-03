<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/fw/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/fw/fa/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/fw/jstree/themes/default/style.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/fw/combobox/combobox.css">
<!--	<link rel="stylesheet" type="text/css" href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/main.css">-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/raw.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/my.css">

    <script type="application/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/fw/jquery.js"></script>
    <script type="application/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/fw/bootstrap/js/bootstrap.min.js"></script>
    <script type="application/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/fw/jstree/jstree.min.js"></script>
    <script type="application/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/fw/combobox/combobox.js"></script>
	<title>InfoWatch GSM Monitor</title>
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img src="/img/logo.png"/> </a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li style="color: white; padding-top: 14px; padding-right: 10px;">Онлайн: <span class="label label-success" style="bottom: 1px; position: relative;"><?=$this->countOnline()?></span></li>
                    <li><a href="<?=$this->createUrl('/panel/profile');?>"><i class="fa fa-user"></i> Профиль</a></li>
                    <li><a href="<?=$this->createUrl('/site/logout');?>"><i class="fa fa-sign-out"></i> Выйти</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="left-menu col-md-1">
        <div class="heading text-center">Мониторинг</div>
        <a href="<?=$this->createUrl('/panel/index');?>" <?= $this->active == 'index' ? 'class="selected"' : ''?>>
            <div class="link text-center">
                <i class="fa fa-area-chart"></i>
                <div class="link-desc">Онлайн</div>
            </div>
        </a>
        <a href="<?=$this->createUrl('/panel/unknown');?>" <?= $this->active == 'unknown' ? 'class="selected"' : ''?>>
            <div class="link text-center">
                <i class="fa fa-question"></i>
                <div class="link-desc">Неизвестные</div>
            </div>
        </a>
        <div class="heading text-center">Контроль</div>
        <a href="<?=$this->createUrl('/panel/persons');?>" <?= $this->active == 'persons' ? 'class="selected"' : ''?>>
            <div class="link text-center">
                <i class="fa fa-users"></i>
                <div class="link-desc">Сотрудники</div>
            </div>
        </a>
        <div class="heading text-center">Настройки</div>
        <?php if(isset(Yii::app()->user->role)): ?>
            <?php if(Yii::app()->user->role == 'ADMIN'): ?>
                <a href="<?=$this->createUrl('/panel/settings');?>" <?= $this->active == 'settings' ? 'class="selected"' : ''?>>
                    <div class="link text-center">
                        <i class="fa fa-cogs"></i>
                        <div class="link-desc">Управление</div>
                    </div>
                </a>
                <a href="<?=$this->createUrl('/panel/users');?>" <?= $this->active == 'users' ? 'class="selected"' : ''?>>
                    <div class="link text-center">
                        <i class="fa fa-users"></i>
                        <div class="link-desc">Пользователи</div>
                    </div>
                </a>
            <?php endif; ?>
        <?php endif; ?>
        <a href="<?=$this->createUrl('/panel/logs');?>" <?= $this->active == 'logs' ? 'class="selected"' : ''?>>
            <div class="link text-center">
                <i class="fa fa-book"></i>
                <div class="link-desc">Журнал событий</div>
            </div>
        </a>
        <div class="endblack"></div>
    </div>
    <?php echo $content; ?>
</body>
</html>



