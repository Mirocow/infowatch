<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 15.02.15
 * Time: 22:20
 */

/* @var $unknownDevices Device[]*/
/* @var $knownDevices Device[]*/
?>


<div class="content col-md-11">
    <div class="row">
        <nav class="breadcrumbs">
            Мониторинг
        </nav>
    </div>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#known" data-toggle="tab">Зарегистрированные</a></li>
        <li><a href="#unknown" data-toggle="tab">Незарегистрированные</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="known">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ФИО</th>
                    <th>Страна</th>
                    <th>Оператор</th>
                    <th>Группа</th>
                    <th>IMEI</th>
                    <th>IMSI</th>
                    <th>Номер телефона</th>
                    <th>Дата</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($knownDevices as $device): ?>
                    <tr>
                        <td><?=$device->person->name;?></td>
                        <td><?=$device->person->getCountry();?></td>
                        <td><?=$device->getOperator();?></td>
                        <td><?=$device->person->getGroup();?></td>
                        <td><?=$device->imei;?></td>
                        <td><?=$device->imsi;?></td>
                        <td><?=$device->person->phone;?></td>
                        <td><?=date('Y-m-d H:i:s',$device->created);?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="unknown">
            <button class="btn btn-success" disabled="disabled" id="register-user"><i class="fa fa-plus"></i> Зарегистрировать</button>
            <table class="table table-striped table-hover uknown-devices">
                <thead>
                <tr>
                    <th>Устройство</th>
                    <th>Дата</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($unknownDevices as $device): ?>
                    <tr class="unknown-device" imsi="<?=$device->imsi?>">
                        <td><?=$device->getDeviceName();?></td>
                        <td><?=date('Y-m-d H:i:s',$device->created);?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div><div class="modal fade" id="registerPersonModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editPersonModalLabel"></h4>
            </div>
            <?php
            $person = new Person();
            $form=$this->beginWidget('CActiveForm', array(
                'id'=>'add-person-form',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
                'htmlOptions' => ['class' => 'form-horizontal']
            )); ?>
            <div class="modal-body">
                <div class="form-group">
                    <?php echo $form->labelEx($person,'name', ['class' => 'col-md-3 control-label']); ?>
                    <div class="col-md-9">
                        <?php echo $form->textField($person,'name', ['class' => 'form-control', 'id' => 'person_name']); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($person,'country', ['class' => 'col-md-3 control-label']); ?>
                    <div class="col-md-9">
                        <?php echo $form->textField($person,'country', ['class' => 'form-control', 'id' => 'person_country']); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($person,'job', ['class' => 'col-md-3 control-label']); ?>
                    <div class="col-md-9">
                        <?php echo $form->textField($person,'job', ['class' => 'form-control', 'id' => 'person_job']); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($person,'department', ['class' => 'col-md-3 control-label']); ?>
                    <div class="col-md-9">
                        <?php echo $form->textField($person,'department', ['class' => 'form-control', 'id' => 'person_department']); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($person,'boss', ['class' => 'col-md-3 control-label']); ?>
                    <div class="col-md-9">
                        <?php echo $form->textField($person,'boss', ['class' => 'form-control', 'id' => 'person_boss']); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($person,'phone', ['class' => 'col-md-3 control-label']); ?>
                    <div class="col-md-9">
                        <?php echo $form->textField($person,'phone', ['class' => 'form-control', 'id' => 'person_phone']); ?>
                    </div>
                </div>
                <?php echo $form->textField($person,'imsi', ['class' => 'form-control', 'id' => 'person_imsi', 'style' => 'display: none;']); ?>
                <div class="form-group">
                    <?php echo $form->labelEx($person,'info', ['class' => 'col-md-3 control-label']); ?>
                    <div class="col-md-9">
                        <?php echo $form->textArea($person,'info', ['class' => 'form-control', 'id' => 'person_info']); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id="add-person">Сохранить</button>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
<script>
    var activeImsi = '';
    $(document).on('click', '.unknown-device', function(){
        $('.unknown-device').removeClass('warning');
        $(this).addClass('warning');
        activeImsi = $(this).attr('imsi');
        $('#register-user').removeAttr('disabled');
    });

    $(document).on('click', '#register-user', function(){
        $('#person_imsi').val($('.unknown-device.warning').attr('imsi'));
        $('#person_name').val('');
        $('#person_job').val('');
        $('#person_country').val('');
        $('#person_department').val('');
        $('#person_boss').val('');
        $('#person_phone').val('');
        $('#person_info').val('');
        $('#registerPersonModal').modal('show');
    });
    $(document).ready(function(){
        $('#add-person').click(function(){
            var form = new FormData($('#add-person-form')[0]);

            var request = $.ajax({
                url: Yii.app.createUrl('/ajax/addPerson'),
                type: "POST",
                processData: false,
                cache: false,
                contentType: false,
                data: form
            });
            request.done(function(response) {
                $(this).attr('disabled', 'disabled');
                response = JSON.parse(response);
                $('.unknown-device[imsi=' + activeImsi + ']').remove();
                //$('#jstree li[person_id=' + response.id + '] a').html('<i class="jstree-icon jstree-themeicon jstree-themeicon-custom" role="presentation" style="background-image: url(<?=Yii::app()->request->baseUrl?>/img/user.png); background-size: auto; background-position: 50% 50%;"></i>' + response.name);
                $('#registerPersonModal').modal('hide');
            });
        });
    })
</script>