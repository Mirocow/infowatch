<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 15.02.15
 * Time: 23:03
 */

/* @var $operators Operator[] */
/* @var $form CActiveForm */
?>

<div class="settings-content col-md-11">
        <nav class="breadcrumbs">
            Настройки
        </nav>
    <div class="col-md-2 settings-tabs">
        <ul>
            <li class="link-container active">
                <a href="#net" data-toggle="tab">
                    <i class="fa fa-cloud"></i> Сетевые настройки
                </a>
            </li>
            <li class="link-container">
                <a href="#mobile" data-toggle="tab">
                    <i class="fa fa-mobile-phone"></i> Операторы
                </a>
            </li>
            <li class="link-container">
                <a href="#voip" data-toggle="tab">
                    <i class="fa fa-volume-up"></i> Настройки VoIP
                </a>
            </li>
            <!--<li class="link-container">
                <a href="#gsm" data-toggle="tab">
                    <i class="fa fa-wifi"></i> Настройки GSM
                </a>
            </li>
            <li class="link-container">
                <a href="#state" data-toggle="tab">
                    <i class="fa fa-heart"></i> Состояние системы
                </a>
            </li>-->
        </ul>
    </div>
    <div class="col-md-10 settings-tab-contents">
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="net">
                <h2 class="settings--header">Сетевые настройки</h2>
                <p class="settings--header-subtitle">Настройка параметров сети устройства. Настройка соединения с InfoWatch Traffic Monitor.</p>
                <table width="50%" align="center" cellpadding="4" cellspacing="0" class="table table-stripped" id="network">
                    <tbody>
                    <tr>
                        <th width="50%" style="border-top: 0 none;">DHCP</th>
                        <td style="border-top: 0 none;">
                            <input type="checkbox" id="dhcp" <?=$network['dhcp'] == '1' ? 'checked="checked"' : ''?> style="-ms-transform: scale(2);-moz-transform: scale(2);-webkit-transform: scale(2);-o-transform: scale(2);"/>
                        </td>
                    </tr>
                    <tr>
                        <th width="50%" style="border-top: 0 none;">Hostname</th>
                        <td style="border-top: 0 none;">
                            <input type="text" maxlength="15" class="input" size="15" id="network_hostname" name="lan_ipaddr" value="<?=$network['hostname']?>">
                            &nbsp;<span style="color:#888;">example.com</span>
                        </td>
                    </tr>
                    <tr>
                        <th width="50%" style="border-top: 0 none;">IP адрес</th>
                        <td style="border-top: 0 none;">
                            <input type="text" maxlength="15" class="input block" size="15" id="network_ip" name="lan_ipaddr" value="<?=$network['ip']?>" <?=$network['dhcp'] == '1' ? 'disabled="disabled"' : ''?>>
                            &nbsp;<span style="color:#888;">192.168.1.1</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Маска подсети</th>
                        <td>
                            <input type="text" maxlength="15" class="input block" size="15" id="network_mask" value="<?=$network['mask']?>" <?=$network['dhcp'] == '1' ? 'disabled="disabled"' : ''?>>
                            &nbsp;<span class="block" style="color:#888;">255.255.255.0</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Шлюз</th>
                        <td>
                            <input type="text" maxlength="15" class="input block" size="15" id="network_gateway" value="<?=$network['gateway']?>" <?=$network['dhcp'] == '1' ? 'disabled="disabled"' : ''?>>
                            &nbsp;<span class="block" style="color:#888;">192.168.1.1</span>
                        </td>
                    </tr>
                    <tr>
                        <th>DNS</th>
                        <td>
                            <input type="text" maxlength="15" class="input block" size="15" id="network_dns" value="<?=$network['dns']?>" <?=$network['dhcp'] == '1' ? 'disabled="disabled"' : ''?>>
                            &nbsp;<span style="color:#888;">192.168.1.1</span>
                        </td>
                    </tr>
                    <!--
                    <tr>
                        <th>IP адрес Traffic Monitor</th>
                        <td>
                            <input type="text" maxlength="15" class="input" size="15" name="lan_DNS" value="192.168.1.50">
                            &nbsp;<span style="color:#888;">192.168.1.1</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Порт Traffic Monitor</th>
                        <td>
                            <input type="text" maxlength="15" class="input" size="15" name="lan_DNS" value="4561">
                            &nbsp;<span style="color:#888;">3000</span>
                        </td>
                    </tr>
                    -->
                    </tbody>
                </table>
                <center><input class="btn btn-primary" style="width: 219px" type="button" value="Сохранить" onclick="saveNetwork();"></center>
            </div>
            <div class="tab-pane fade" id="mobile">
                <h2 class="settings--header">Операторы</h2>
                <p class="settings--header-subtitle">Настройка операторов GSM сети. Выбор используемого оператора.</p>
                <div class="btn-group ">
                    <button type="button" class="btn btn-default" id="addOperator">
                        Добавить
                    </button>
                    <button type="button" class="btn btn-default" id="editOperator" disabled="disabled">
                        Изменить
                    </button>
                    <button type="button" class="btn btn-danger" id="remove-operator" disabled="disabled">Удалить</button>
                </div>

                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered operators-table" id="operators" width="100%" style="margin-top: 10px;">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th>Имя оператора</th>
                        <th>MCC</th>
                        <th>MNC</th>
                        <th>ARFCN</th>
                        <th>Статус</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach($operators as $index=>$operator): ?>
                            <tr class="operator-row" operator-id="<?=$operator->id?>">
                                <td>
                                    <?=$index+1;?>
                                </td>
                                <td>
                                    <?=$operator->name;?>
                                </td>
                                <td>
                                    <?=$operator->mcc;?>
                                </td>
                                <td>
                                    <?=$operator->mnc;?>
                                </td>
                                <td>
                                    <?=$operator->arfcn;?>
                                </td>
                                <td>
                                    <?=$operator->getStatus();?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <section>
                    <div class="settings--wrapper">
                        <h2 class="settings--header">Настройки GSM</h2>
                        <p class="settings--header-subtitle">Настройка параметров GSM сети.</p>
                        <div class="settings--aside">

                            <table width="50%" align="center" cellpadding="4" cellspacing="0" class="table table-stripped">
                                <tbody><tr>
                                    <th width="50%" style="border-top: 0 none;">C0</th>
                                    <td style="border-top: 0 none;">
                                        <input type="text" maxlength="15" class="input" size="15" id="gsm_c0" name="lan_ipaddr" value="<?=$gsm['c0'];?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Мощность</th>
                                    <td>
                                        <input type="text" maxlength="15" class="input" size="15" id="gsm_power" name="gsm_power" value="<?=$gsm['power'];?>">
                                    </td>
                                </tr>
                                </tbody></table>

                            <center><input class="btn btn-primary" style="width: 219px" type="button" value="Сохранить" onclick="saveGsm();"></center>

                        </div>
                        <div class="settings--wrap" id="server_settings"></div>
                    </div>
                </section>
            </div>
            <div class="tab-pane fade" id="gsm">

            </div>
            <div class="tab-pane fade" id="voip"><section>
                    <div class="settings--wrapper">
                        <h2 class="settings--header">Настройки VoIP</h2>
                        <p class="settings--header-subtitle">Настройка параметров VoIP.</p>
                        <div class="settings--aside">

                            <table width="50%" align="center" cellpadding="4" cellspacing="0" class="table table-stripped">
                                <tbody><tr>
                                    <th width="50%" style="border-top: 0 none;">Логин</th>
                                    <td style="border-top: 0 none;">
                                        <input type="text" maxlength="15" class="input" size="15" id="voip_login" name="lan_ipaddr" value="<?=$voip['login'];?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Пароль</th>
                                    <td>
                                        <input type="password" maxlength="15" class="input" size="15" id="voip_password" name="gsm_power" value="<?=$voip['password'];?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Повтор пароля</th>
                                    <td>
                                        <input type="password" maxlength="15" class="input" size="15" id="voip_operator" name="gsm_operator" value="<?=$voip['password'];?>">
                                    </td>
                                </tr>
                                </tbody></table>

                            <center><input class="btn btn-primary" style="width: 219px" type="button" value="Сохранить" onclick="saveVoip();"></center>

                        </div>
                        <div class="settings--wrap" id="server_settings"></div>
                    </div>
                </section>
            </div>
            <div class="tab-pane fade" id="state">

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="operatorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="operatorModalLabel">Добавление оператора</h4>
            </div><?php
            $operator = new Operator();
            $form=$this->beginWidget('CActiveForm', array(
                'id'=>'operator-form',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
                'htmlOptions' => ['class' => 'form-horizontal']
            )); ?>
            <div class="modal-body">
                <div class="form-group">
                    <?php echo $form->labelEx($operator,'name', ['class' => 'col-md-3 control-label']); ?>
                    <div class="col-md-9">
                        <?php echo $form->textField($operator,'name', ['class' => 'form-control', 'id' => 'person_name']); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($operator,'mcc', ['class' => 'col-md-3 control-label']); ?>
                    <div class="col-md-9">
                        <?php echo $form->textField($operator,'mcc', ['class' => 'form-control', 'id' => 'person_job']); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($operator,'mnc', ['class' => 'col-md-3 control-label']); ?>
                    <div class="col-md-9">
                        <?php echo $form->textField($operator,'mnc', ['class' => 'form-control', 'id' => 'person_department']); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($operator,'arfcn', ['class' => 'col-md-3 control-label']); ?>
                    <div class="col-md-9">
                        <?php echo $form->textField($operator,'arfcn', ['class' => 'form-control', 'id' => 'person_boss']); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($operator,'status', ['class' => 'col-md-3 control-label']); ?>
                    <div class="col-md-9">
                        <?php echo $form->dropDownList($operator,'status', [1 => 'Online', 0 => 'Offline'], ['class' => 'form-control', 'id' => 'person_boss']); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id="add-operator">Сохранить</button>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
<div class="modal fade" id="editOperatorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="operatorModalLabel">Изменение оператора</h4>
            </div><?php
            $operator = new Operator();
            $form=$this->beginWidget('CActiveForm', array(
                'id'=>'operator-save-form',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
                'htmlOptions' => ['class' => 'form-horizontal']
            )); ?>
            <div class="modal-body">
                <div class="form-group">
                    <?php echo $form->labelEx($operator,'name', ['class' => 'col-md-3 control-label']); ?>
                    <div class="col-md-9">
                        <?php echo $form->textField($operator,'name', ['class' => 'form-control', 'id' => 'operator_name']); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($operator,'mcc', ['class' => 'col-md-3 control-label']); ?>
                    <div class="col-md-9">
                        <?php echo $form->textField($operator,'mcc', ['class' => 'form-control', 'id' => 'operator_mcc']); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($operator,'mnc', ['class' => 'col-md-3 control-label']); ?>
                    <div class="col-md-9">
                        <?php echo $form->textField($operator,'mnc', ['class' => 'form-control', 'id' => 'operator_mnc']); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($operator,'arfcn', ['class' => 'col-md-3 control-label']); ?>
                    <div class="col-md-9">
                        <?php echo $form->textField($operator,'arfcn', ['class' => 'form-control', 'id' => 'operator_arfcn']); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($operator,'status', ['class' => 'col-md-3 control-label']); ?>
                    <div class="col-md-9">
                        <?php echo $form->dropDownList($operator,'status', [1 => 'Online', 0 => 'Offline'], ['class' => 'form-control', 'id' => 'operator_status']); ?>
                    </div>
                </div>
            </div>
            <?=$form->hiddenField($operator, 'id', ['id' => 'operator_id'])?>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id="save-operator">Сохранить</button>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
<script>

    $(document).on('click', '.operator-row', function(e){
        $(this).parent().find('.operator-row').removeClass('active');
        $(this).addClass('active');

        $('#editOperator').removeAttr('disabled');
        $('#remove-operator').removeAttr('disabled');

    });
//
    $(document).ready(function(){
        $('#addOperator').click(function(){
            $('#operator-form input').val('');
            $('#operatorModal').modal('show');
        });
        $('#add-operator').click(function(){
            var form = new FormData($('#operator-form')[0]);

            var request = $.ajax({
                url: Yii.app.createUrl('/ajax/saveOperator'),
                type: "POST",
                processData: false,
                cache: false,
                contentType: false,
                data: form
            });
            request.done(function(operator) {
                operator = JSON.parse(operator);

                $('.operators-table tbody').append('<tr class="operator-row" operator-id="' + operator.id + '"><td>' + operator.id + '</td><td>' + operator.name + '</td><td>' + operator.mcc + '</td><td>' + operator.mnc + '</td><td>' + operator.arfcn + '</td><td>' + operator.textStatus + '</td></tr>');

                $('#operatorModal').modal('hide');
                $('#editOperator').attr('disabled','disabled');
                $('#remove-operator').attr('disabled','disabled');
            });
        });
        $('#remove-operator').click(function(){
            var operatorId = $('.operators-table tbody tr.active').attr('operator-id');

            var url = Yii.app.createUrl('/ajax/deleteOperator');


            $.post(
                url,
                {
                    id:  operatorId
                }
            ).done(function(response){
                    $('.operators-table tbody tr.active').remove();
                    var i = 1;
                    $('.operators-table tbody tr').each(function(index, row){
                        $(row).find('td:first').text(i);
                        i++;
                    });
                    $('#remove-operator').attr('disabled', 'disabled');
                });
        });
        $('#editOperator').click(function(){
            var id = $('.operators-table tbody tr.active').attr('operator-id');
            $.post(
                Yii.app.createUrl('/ajax/getOperator'),
                {
                    id: id
                }
            ).done(function (response) {
                    response = JSON.parse(response);

                    $('#operator_name').val(response.name);
                    $('#operator_mcc').val(response.mcc);
                    $('#operator_mnc').val(response.mnc);
                    $('#operator_arfcn').val(response.arfcn);
                    $('#operator_id').val(response.id);

                    $('#operator_status option[value=' + response.status+']').attr('selected', 'selected');

                    $('#editOperatorModal').modal('show');
                });
        });
        $('#save-operator').click(function(){
            var form = new FormData($('#operator-save-form')[0]);

            var request = $.ajax({
                url: Yii.app.createUrl('/ajax/editOperator'),
                type: "POST",
                processData: false,
                cache: false,
                contentType: false,
                data: form
            });
            request.done(function(operator) {
                operator = JSON.parse(operator);

                $('.operators-table tbody tr.active').replaceWith('<tr class="operator-row" operator-id="' + operator.id + '"><td>' + operator.id + '</td><td>' + operator.name + '</td><td>' + operator.mcc + '</td><td>' + operator.mnc + '</td><td>' + operator.arfcn + '</td><td>' + operator.textStatus + '</td></tr>');

                $('#editOperatorModal').modal('hide');
                $('#editOperator').attr('disabled','disabled');
                $('#remove-operator').attr('disabled','disabled');
            });
        });

        $('#dhcp').click(function(){
            if($(this).prop('checked'))
            {
                $('#network input.block').attr('disabled', 'disabled');
            }
            else
            {
                $('#network input.block').removeAttr('disabled');
            }
        })
    });
    $(document).on('click', '#status-enable', function(){
        if($(this).prop('checked'))
            alert('Вы получите доступ к конфиденциальным данным пользователей')
    });
    function saveGsm()
    {
        saveSetting('gsm', {'power': $('#gsm_power').val(), 'c0': $('#gsm_c0').val()});
    }
    function saveSystem()
    {
        saveSetting('system', {'status': $('#system_status option:selected').val()});
    }
    function saveVoip()
    {
        saveSetting('voip', {'login': $('#voip_login').val(), 'password': $('#voip_password').val()});
    }
    function saveNetwork()
    {
        var dhcp = '0';
        if($('#dhcp').prop('checked'))
            dhcp = '1';

        saveSetting('network', {'dhcp': dhcp, 'hostname': $('#network_hostname').val(), 'ip': $('#network_ip').val(), 'mask': $('#network_mask').val(), 'gateway': $('#network_gateway').val(), 'dns': $('#network_dns').val()});
    }
    function saveSetting(name, params)
    {
        $.post(
            Yii.app.createUrl('ajax/saveSetting'),
            {
                name: name,
                params: params
            }).done(function(){});
    }
</script>