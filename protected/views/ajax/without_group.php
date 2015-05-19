<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 22.02.15
 * Time: 4:01
 */

/* @var $persons Person[] */
?>

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
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>