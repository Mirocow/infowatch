<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 15.02.15
 * Time: 23:03
 */

/* @var $operators Operator[] */
?>

<div class="settings-content col-md-11">
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
                <a href="#gsm" data-toggle="tab">
                    <i class="fa fa-wifi"></i> Настройки GSM
                </a>
            </li>
            <li class="link-container">
                <a href="#state" data-toggle="tab">
                    <i class="fa fa-heart"></i> Состояние системы
                </a>
            </li>
        </ul>
    </div>
    <div class="col-md-10 settings-tab-contents">
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="net">
                <h2 class="settings--header">Сетевые настройки</h2>
                <p class="settings--header-subtitle">Настройка параметров сети устройства. Настройка соединения с InfoWatch Traffic Monitor.</p>
                <table width="50%" align="center" cellpadding="4" cellspacing="0" class="table table-stripped">
                    <tbody><tr>
                        <th width="50%" style="border-top: 0 none;">IP адрес</th>
                        <td style="border-top: 0 none;">
                            <input type="text" maxlength="15" class="input" size="15" id="lan_ipaddr" name="lan_ipaddr" value="192.168.1.113">
                            &nbsp;<span style="color:#888;">192.168.1.1</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Маска подсети</th>
                        <td>
                            <input type="text" maxlength="15" class="input" size="15" name="lan_netmask" value="255.255.255.0">
                            &nbsp;<span style="color:#888;">255.255.255.0</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Шлюз</th>
                        <td>
                            <input type="text" maxlength="15" class="input" size="15" name="lan_gateway" value="192.168.1.1">
                            &nbsp;<span style="color:#888;">192.168.1.1</span>
                        </td>
                    </tr>
                    <tr>
                        <th>DNS</th>
                        <td>
                            <input type="text" maxlength="15" class="input" size="15" name="lan_DNS" value="192.168.1.1">
                            &nbsp;<span style="color:#888;">192.168.1.1</span>
                        </td>
                    </tr>
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
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="mobile">
                <h2 class="settings--header">Операторы</h2>
                <p class="settings--header-subtitle">Настройка операторов GSM сети. Выбор используемого оператора.</p>
                <div class="btn-group ">
                    <button type="button" class="btn btn-default" id="addOperator">
                        Добавить
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
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach($operators as $operator): ?>
                            <tr class="operator-row" operator-id="<?=$operator->id?>">
                                <td>
                                    <?=$operator->id;?>
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
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="gsm"><section>
                    <div class="settings--wrapper">
                        <h2 class="settings--header">Настройки GSM</h2>
                        <p class="settings--header-subtitle">Настройка параметров GSM сети.</p>
                        <div class="settings--aside">

                            <table width="50%" align="center" cellpadding="4" cellspacing="0" class="table table-stripped">
                                <tbody><tr>
                                    <th width="50%" style="border-top: 0 none;">C0</th>
                                    <td style="border-top: 0 none;">
                                        <input type="text" maxlength="15" class="input" size="15" id="lan_ipaddr" name="lan_ipaddr" value="2">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Мощность</th>
                                    <td>
                                        <input type="text" maxlength="15" class="input" size="15" name="lan_netmask" value="100">
                                    </td>
                                </tr>
                                </tbody></table>

                            <center><input class="btn btn-primary" style="width: 219px" type="submit" value="Сохранить" onclick=""></center>

                        </div>
                        <div class="settings--wrap" id="server_settings"></div>
                    </div>
                </section>
            </div>
            <div class="tab-pane fade" id="state">
                <div class="settings--wrapper">
                    <h2 class="settings--header">Статус</h2>
                    <p class="settings--header-subtitle">Отображение статуса и лога устройства.</p>
                    <div class="settings--aside">

                        <table border="0px" style="background-color: transparent; margin-bottom: 35px;">
                            <tbody><tr>
                                <td width="200px">
                                    Статус системы:
                                </td>
                                <td>
                                    <select id="validateSelect" name="validateSelect" class="form-control" data-required="true">
                                        <option value="1" id="1">Онлайн</option>
                                        <option value="2" id="2">Оффлайн</option>
                                    </select>								</td>
                            </tr>
                            </tbody></table>


                    </div>
                    <div class="settings--wrap" id="server_settings"></div>
                </div>
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
            </div>
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

        $('#remove-operator').removeAttr('disabled');

    });

    $(document).ready(function(){
        $('#addOperator').click(function(){
            $('#operator-form input').val('');
            $('#operatorModal').modal('show');
        });
        $('#save-operator').click(function(){
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

                $('.operators-table tbody').append('<tr class="operator-row" operator-id="' + operator.id + '"><td>' + operator.id + '</td><td>' + operator.name + '</td><td>' + operator.mcc + '</td><td>' + operator.mnc + '</td><td>' + operator.arfcn + '</td></tr>');

                $('#operatorModal').modal('hide');
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
                    $('#remove-operator').attr('disabled', 'disabled');
                });
        });
    });
</script>