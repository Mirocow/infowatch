<?php
/**
 * Created by PhpStorm.
 * User: SlashMan
 * Date: 13.05.2015
 * Time: 14:15
 */

?>

<div class="settings-content col-md-11">
    <nav class="breadcrumbs">
        Журнал событий
    </nav>
    <div class="col-md-12 settings-tab-contents">
        <div class="settings--wrapper">
            <h2 class="settings--header">Статус</h2>
            <p class="settings--header-subtitle">Отображение статуса и лога устройства.</p>
            <div class="settings--aside">
                <center>
                    <table border="0px" style="background-color: transparent; margin-bottom: 35px;">
                        <tbody><tr>
                            <td width="200px">
                                Статус системы:
                            </td>
                            <td>
                                <input type="checkbox" id="status-enable" value=""></td>
                        </tr>
                        </tbody></table>


                    <input class="btn btn-primary" style="width: 219px" type="button" value="Сохранить" onclick="saveSystem();"></center>
            </div>
            <center>
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped" id="operators" width="100%" style="margin-top: 10px;">
                    <thead>
                    <tr>
                        <th>Время</th>
                        <th>От</th>
                        <th>Кому</th>
                        <th>Описание</th>
                        <th>Файл</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach(Log::model()->findAll() as $log): ?>
                        <tr>
                            <td class="col-md-2">
                                <?=$log->happened;?>
                            </td>
                            <td>
                                <?=$log->from;?>
                            </td>
                            <td>
                                <?=$log->to;?>
                            </td>
                            <td>
                                <?=$log->details;?>
                            </td>
                            <td class="text-center">
                                <?=$log->attachment ? CHtml::link('<i class="fa fa-download"></i>',Yii::app()->request->baseUrl.'/attachments/'.$log->attachment) : '';?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </center>
        </div>
    </div>
</div>