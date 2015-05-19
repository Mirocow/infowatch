<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 19.05.15
 * Time: 15:31
 */

/* @var $user User */
/* @var $form CActiveForm */
?>

<div class="settings-content profile-content col-md-11">
    <div class="col-md-4 col-md-offset-4" style="margin-top: 50px;">
        <?php if(Yii::app()->user->hasFlash('ERROR')): ?>
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="close-alert" aria-hidden="true">&times;</span></button>
                <?=Yii::app()->user->getFlash('ERROR');?>
            </div>
        <?php elseif (Yii::app()->user->hasFlash('SUCCESS')): ?>
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="close-alert" aria-hidden="true">&times;</span></button>
                <?=Yii::app()->user->getFlash('SUCCESS');?>
            </div>
        <?php endif; ?>
        <?php
        $form=$this->beginWidget('CActiveForm', array(
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
            'htmlOptions' => ['class' => 'form-horizontal']
        )); ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Пароль</label>
                <?php echo $form->passwordField($user,'password', ['class' => 'form-control', 'value' => '']); ?>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Повтор пароля</label>
                <?php echo $form->passwordField($user,'passwordRepeat', ['class' => 'form-control', 'value' => '']); ?>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-default"><i class="fa fa-save"></i> Сохранить</button>
            </div>
        <?php $this->endWidget(); ?>
    </div>
</div>