<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/fw/bootstrap/css/bootstrap.min.css">
<!--	<link rel="stylesheet" type="text/css" href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/fw/bootstrap/css/bootstrap-theme.min.css">-->

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
    <?php echo $content; ?>
</body>
</html>



