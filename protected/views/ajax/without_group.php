<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 22.02.15
 * Time: 4:01
 */

/* @var $persons Person[] */
?>

<div class="col-md-12">
    <div class="btn-group" role="group">
<!--        <button type="button" class="btn btn-default" id="add-group-btn"><i class="fa fa-plus"></i></button>-->
        <button type="button" class="btn btn-default" id="remove-group-btn"><i class="fa fa-close"></i></button>
    </div>
</div>
<div class="col-md-12 group">
    <table class="table groups-table table-hover">
        <thead>
        <tr>
            <th class="checkbox-td"><input type="checkbox" class="check-all-groups"/></th>
            <th>Название</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($groups as $group): ?>
            <tr class="group-row" group-id="<?=$group->id;?>">
                <td class="checkbox-td"><input type="checkbox" class="group-checkbox" group-id="<?=$group->id?>"/>   </td>
                <td><?=$group->name;?></td>
                <td><button type="button" class="btn btn-sm btn-primary group-button" group-id="<?=$group->id;?>"><i class="fa fa-pencil"></i></button></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>


<div class="col-md-12">
    <div class="btn-group" role="group">
        <button type="button" class="btn btn-default" id="add-person-btn"><i class="fa fa-plus"></i></button>
        <button type="button" class="btn btn-default" id="remove-person-btn"><i class="fa fa-close"></i></button>
    </div>
</div>
<div class="col-md-12 group">
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
        <?php foreach($persons as $person): ?>
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