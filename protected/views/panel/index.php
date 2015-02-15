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



<ul class="nav nav-tabs">
    <li class="active"><a href="#known" data-toggle="tab">Зарегистрированные</a></li>
    <li><a href="#unknown" data-toggle="tab">Незарегистрированные</a></li>
</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade active in" id="known">
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>ФИО</th>
                <th>IMEI</th>
                <th>IMSI</th>
                <th>Дата</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($knownDevices as $device): ?>
                <tr>
                    <td><?=$device->person->name;?></td>
                    <td><?=$device->imei;?></td>
                    <td><?=$device->imsi;?></td>
                    <td><?=date('Y-m-d H:i:s',$device->created);?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="unknown">
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>IMEI</th>
                <th>IMSI</th>
                <th>Дата</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($unknownDevices as $device): ?>
                <tr>
                    <td><?=$device->imei;?></td>
                    <td><?=$device->imsi;?></td>
                    <td><?=date('Y-m-d H:i:s',$device->created);?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>