<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
    'htmlOptions' => ['class' => 'form-horizontal', 'style' => 'margin-top: 160px;']
)); ?>
<div class="col-md-4 col-md-offset-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title text-center">Вход</div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <?php echo $form->labelEx($model,'username', ['class' => 'col-md-3 control-label']); ?>
                <div class="col-md-9">
                    <?php echo $form->textField($model,'username', ['class' => 'form-control']); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'password', ['class' => 'col-md-3 control-label']); ?>
                <div class="col-md-9">
                    <?php echo $form->passwordField($model,'password', ['class' => 'form-control']); ?>
                </div>
            </div>

            <div class="text-center col-md-12">
                <?php echo CHtml::submitButton('Login', ['class' => 'btn btn-default']); ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>
