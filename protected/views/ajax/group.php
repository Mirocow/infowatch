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

<div class="col-md-12">
    <div class="btn-group" role="group">
        <button type="button" class="btn btn-default" id="add-person-btn"><i class="fa fa-plus"></i></button>
        <button type="button" class="btn btn-default" id="remove-person-btn"><i class="fa fa-close"></i></button>
    </div>
</div>
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
            <input type="checkbox" <?=$group->voice ? 'checked="checked"' : '' ?> disabled="disabled">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 text-right">
            Контроль SMS-траффика:
        </div>
        <div class="col-md-2">
            <input type="checkbox" <?=$group->sms ? 'checked="checked"' : '' ?> disabled="disabled">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 text-right">
            Приветственное сообщение:
        </div>
        <div class="col-md-2">
            <input type="checkbox" <?=$group->greet ? 'checked="checked"' : '' ?> disabled="disabled">
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


    <table class="table persons-table table-hover">
        <thead>
        <tr>
            <th class="checkbox-td"><input type="checkbox" class="check-all-persons"/></th>
            <th>ФИО</th>
            <th>Должность</th>
            <th>Отдел</th>
            <th>Руководитель</th>
            <th>Номер телефона</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($group->people as $person): ?>
            <tr class="person-row" person-id="<?=$person->id;?>">
                <td class="checkbox-td"><input type="checkbox" class="person-checkbox" person-id="<?=$person->id?>"/>   </td>
                <td><?=$person->name;?></td>
                <td><?=$person->job;?></td>
                <td><?=$person->department;?></td>
                <td><?=$person->boss;?></td>
                <td><?=$person->phone;?></td>
                <td><button type="button" class="btn btn-sm btn-primary person-button" person-id="<?=$person->id;?>"><i class="fa fa-pencil"></i></button></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>