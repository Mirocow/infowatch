<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 22.02.15
 * Time: 4:01
 */

/* @var $group Group */
/* @var $form CActiveForm */
?>

<div class="col-md-12 group">
    <div class="row">
        <div class="col-md-4 text-right">
            Название:
        </div>
        <div class="col-md-2">
            <?=$group->name;?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 text-right">
            Контроль голосового траффика:
        </div>
        <div class="col-md-2">
            <i class="fa <?=$group->voice ? 'fa-toggle-on text-success' : 'fa-toggle-off text-danger';?>"></i>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 text-right">
            Контроль SMS-траффика:
        </div>
        <div class="col-md-2">
            <i class="fa <?=$group->sms ? 'fa-toggle-on text-success' : 'fa-toggle-off text-danger';?>"></i>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 text-right">
            Приветственное сообщение:
        </div>
        <div class="col-md-2">
            <i class="fa <?=$group->greet ? 'fa-toggle-on text-success' : 'fa-toggle-off text-danger';?>"></i>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 text-right">
            Текст сообщения:
        </div>
        <div class="col-md-2">
            <?=$group->greet_message?>
        </div>
    </div>


    <table class="table persons-table">
        <thead>
        <tr>
            <th>ФИО</th>
            <th>Должность</th>
            <th>Отдел</th>
            <th>Руководитель</th>
            <th>Номер телефона</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($group->people as $person): ?>
            <tr class="person-row" person-id="<?=$person->id;?>">
                <td><?=$person->name;?></td>
                <td><?=$person->job;?></td>
                <td><?=$person->department;?></td>
                <td><?=$person->boss;?></td>
                <td><?=$person->phone;?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>