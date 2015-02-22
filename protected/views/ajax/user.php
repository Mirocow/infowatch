<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 22.02.15
 * Time: 4:01
 */

/* @var $user Person */
?>
<div class="col-md-12 person">
    <div class="row">
        <div class="col-md-2">
            ФИО:
        </div>
        <div class="col-md-2">
            <?=$user->name;?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            Должность:
        </div>
        <div class="col-md-2">
            <?=$user->job;?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            Отдел:
        </div>
        <div class="col-md-2">
            <?=$user->department;?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            Руководитель:
        </div>
        <div class="col-md-2">
            <?=$user->boss;?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            Телефон:
        </div>
        <div class="col-md-2">
            <?=$user->phone;?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            IMSI:
        </div>
        <div class="col-md-2">
            <?=$user->imsi;?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            Группа:
        </div>
        <div class="col-md-2">
            <?=$user->getGroup();?>
        </div>
    </div>
</div>