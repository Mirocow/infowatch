<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 15.02.15
 * Time: 23:02
 */

/* @var $persons Person[] */
/* @var $allPersons Person[] */

?>

<div class="content col-md-11">
    <div class="col-md-4">
        <div class="row">
            <div class="row">
                <div class="col-md-12">
                    <div id="jstree">
                        <ul>
                            <li id="root" data-jstree='{"type":"root"}'>Группы
                                <ul><?=$tree?>
                                    <!--
                                    <?php /*foreach($persons as $group): */?>
                                        <li data-jstree='{"type":"group"}' group_id="<?/*=$group['group']->id;*/?>"><?/*=$group['group']->name;*/?>
                                            <ul>
                                                <?php /*foreach($group['persons'] as $person): */?>
                                                    <li data-jstree='{"type":"person"}' person_id="<?/*=$person->id;*/?>"><?/*=$person->name;*/?></li>
                                                <?php /*endforeach;*/?>
                                            </ul>
                                        </li>
                                    <?php /*endforeach;*/?>
                                    </li>-->
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-8">

        <div class="col-md-12" style="margin-bottom: 20px;">
            <button type="button" class="btn btn-default" id="edit-person" disabled="disabled"><i class="glyphicon glyphicon-pencil"></i> Изменить</button>
            <button type="button" class="btn btn-default" id="remove-person" disabled="disabled"><i class="glyphicon glyphicon-remove"></i> Удалить</button>
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
            <?php foreach($allPersons as $person): ?>
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

    <!-- Modal -->
    <div class="modal fade" id="editPersonModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="editPersonModalLabel"></h4>
                </div>
                <?php
                $person = new Person();
                $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'edit-person-form',
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
                        <div class="form-group">
                            <?php echo $form->labelEx($person,'imsi', ['class' => 'col-md-3 control-label']); ?>
                            <div class="col-md-9">
                                <?php echo $form->textField($person,'imsi', ['class' => 'form-control', 'id' => 'person_imsi']); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($person,'info', ['class' => 'col-md-3 control-label']); ?>
                            <div class="col-md-9">
                                <?php echo $form->textArea($person,'info', ['class' => 'form-control', 'id' => 'person_info']); ?>
                            </div>
                        </div>
                        <?php echo $form->textArea($person,'id', ['class' => 'form-control', 'style' => 'display: none;', 'id' => 'person_id']); ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        <button type="button" class="btn btn-primary" id="save-person">Сохранить</button>
                    </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '.person-row', function(e){
        $(this).parent().find('.person-row').removeClass('active');
        $(this).addClass('active');

        $('#remove-person').removeAttr('disabled');
        $('#edit-person').removeAttr('disabled');

    });
    $(document).ready(function(){
        $('#remove-person').click(function(){
            var personId = $('.persons-table tbody tr.active').attr('person-id');

            var url = Yii.app.createUrl('/ajax/deletePerson');


            $.post(
                url,
                {
                    id:  personId
                }
            ).done(function(response){
                    $('li[person_id=' + personId + ']').remove();
                    $('.persons-table tbody tr.active').remove();
                    $('#remove-person').attr('disabled', 'disabled');
                });
        });
        $('#edit-person').click(function(){
            var currentPerson = $('.persons-table tbody tr.active');
            var personId = $('.persons-table tbody tr.active').attr('person-id');

            $.post(
                Yii.app.createUrl('/ajax/getPerson'),
                {
                    id: personId
                }
            ).done(function (response) {
                    response = JSON.parse(response);

                    $('#person_name').val(response.name);
                    $('#person_job').val(response.job);
                    $('#person_department').val(response.department);
                    $('#person_boss').val(response.boss);
                    $('#person_phone').val(response.phone);
                    $('#person_imsi').val(response.imsi);
                    $('#person_info').val(response.info);
                    $('#person_id').val(personId);

                    $('#editPersonModal').modal('show');
                });
        });
        $('#save-person').click(function(){
            var form = new FormData($('#edit-person-form')[0]);

            var request = $.ajax({
                url: Yii.app.createUrl('/ajax/savePerson'),
                type: "POST",
                processData: false,
                cache: false,
                contentType: false,
                data: form
            });
            request.done(function(response) {
                response = JSON.parse(response);
                var destination = $('.persons-table tbody tr.active');

                $(destination).find('td:eq(0)').html(response.name);
                $(destination).find('td:eq(1)').html(response.job);
                $(destination).find('td:eq(2)').html(response.department);
                $(destination).find('td:eq(3)').html(response.boss);
                $(destination).find('td:eq(4)').html(response.phone);

                $('#jstree li[person_id=' + response.id + '] a').html('<i class="jstree-icon jstree-themeicon jstree-themeicon-custom" role="presentation" style="background-image: url(<?=Yii::app()->request->baseUrl?>/img/user.png); background-size: auto; background-position: 50% 50%;"></i>' + response.name);

                $('#editPersonModal').modal('hide');
            });
        });
    });
</script>

<script>
    function demo_create() {
        var ref = $('#jstree').jstree(true),
            sel = ref.get_selected();
        if(!sel.length) { return false; }
        sel = sel[0];
        sel = ref.create_node(sel, {"type":"person"});
        if(sel) {
            ref.edit(sel);
        }
    };
    function demo_rename() {
        var ref = $('#jstree').jstree(true),
            sel = ref.get_selected();
        if(!sel.length) { return false; }
        sel = sel[0];
        ref.edit(sel);
    };
    function demo_delete() {
        var ref = $('#jstree').jstree(true),
            sel = ref.get_selected();
        if(!sel.length) { return false; }
        ref.delete_node(sel);
    };
    $(function () {
        var to = false;
        $('#demo_q').keyup(function () {
            if(to) { clearTimeout(to); }
            to = setTimeout(function () {
                var v = $('#demo_q').val();
                $('#jstree').jstree(true).search(v);
            }, 250);
        });

        $('#jstree')
        .on('move_node.jstree', function(e, target){

            if(target.node.type == 'person')
            {
                var newParent = $('#' + target.parent).attr('group_id');
                var personId = target.node.li_attr.person_id;

                $.post(
                    Yii.app.createUrl('/ajax/movePerson'),
                    {
                        id: personId,
                        newParent: newParent
                    }
                ).done(function(response){

                    });
            }
            if(target.node.type == 'group')
            {
                var parentId = $('#' + target.parent).attr('group_id');
                var id = $('#' + target.node.id).attr('group_id');

                $.post(
                    Yii.app.createUrl('/ajax/moveGroup'),
                    {
                        id: id,
                        parent: parentId
                    }
                ).done(function(response){

                    });
            }
        })
        .on('create_node.jstree', function(e, target){
            //alert(target);
        })
        .on('rename_node.jstree', function(e, target) {
                if(target.node.type == 'person')
                    var url = Yii.app.createUrl('/ajax/renamePerson');
                else
                    var url = Yii.app.createUrl('/ajax/renameGroup');

                $.post(
                    url,
                    {
                        id: $('#'+target.node.id).attr('person_id'),
                        newName: target.text
                    }
                ).done(function(response){
                        return true;
                    });
        })
        .on('delete_node.jstree', function(e, target) {
                if(target.node.type == 'person')
                    var url = Yii.app.createUrl('/ajax/deletePerson');
                else
                    var url = Yii.app.createUrl('/ajax/deleteGroup');


                $.post(
                    url,
                    {
                        id: $('#'+target.node.id).attr('person_id')
                    }
                ).done(function(response){
                        return true;
                    });
        })
            .jstree({
                "core" : {
                    "animation" : 0,
                    "themes" : { "stripes" : true },
                    'check_callback': function(operation, node, node_parent, node_position, more) {
                        // operation can be 'create_node', 'rename_node', 'delete_node', 'move_node' or 'copy_node'
                        // in case of 'rename_node' node_position is filled with the new node name

                        if (operation === "move_node") {
                            return ((node.type === "person" && node_parent.type === "group") || (node.type === "group" && node_parent.type === "group")); //only allow dropping inside nodes of type 'Parent'
                        }
                        return true;  //allow all other operations
                    }
                },
                "state": { "key": '<%=Request.QueryString["type"]%>_infotree' },
                "contextmenu" : {
                    "items": function ($node) { // Could be a function that should return an object like this one
                        var tree = $("#jstree").jstree(true);
                        return {
                            "create": {
                                "separator_before": false,
                                "separator_after": true,
                                "label": "Добавить",
                                "action": false,
                                "submenu": {
                                    "create_file": {
                                        "seperator_before": false,
                                        "seperator_after": false,
                                        "label": "Группу",
                                        action: function (obj) {
                                            if($node.id == 'root' || $node.type == 'group')
                                            {
                                                var parent = null;
                                                if($node.type == 'group')
                                                    parent = $node.li_attr.group_id;
                                                $.post(
                                                    Yii.app.createUrl('/ajax/createGroup'),
                                                    {
                                                        parent: parent,
                                                        name: 'Нвоая группа'
                                                    }
                                                ).done(function(response)
                                                    {
                                                        response = JSON.parse(response);


                                                        $node = tree.create_node($node, {
                                                            "li_attr": {
                                                                "type": "group",
                                                                "parent": parent,
                                                                "group_id": response.id
                                                            }
                                                        });
                                                        tree.set_type($node, "group");
                                                        tree.set_text($node, "Новая группа");
                                                        tree.edit($node);
                                                    });
                                            }
                                        }
                                    },
                                    "create_folder": {
                                        "seperator_before": false,
                                        "seperator_after": false,
                                        "label": "Пользователя",
                                        action: function (obj) {
                                            if($node.type == 'group' && $node.id !== 'root')
                                            {
                                                $.post(
                                                    Yii.app.createUrl('/ajax/createPerson'),
                                                    {
                                                        groupId: $node.li_attr.group_id
                                                    }
                                                ).done(function(response)
                                                    {
                                                        response = JSON.parse(response);

                                                        $node = tree.create_node($node, {
                                                            "li_attr": {
                                                                "type": "user",
                                                                "parent": $node.li_attr.group_id,
                                                                "person_id": response.id
                                                            }
                                                        });

                                                        tree.set_text($node, "Новый пользователь");
                                                        tree.set_type($node, "person");
                                                        tree.edit($node);
                                                    });
                                            }
                                        }
                                    }
                                }
                            },
                            "renameItem": {
                                label: "Переименовать",
                                action: function (obj) {
                                    $node = tree.get_selected()[0];
                                    if ($node != "root") {
                                        tree.edit($node);
                                    } else {
                                        alert("Вы не можете переименовать корневую папку!");
                                    }
                                }
                            },

                            "deleteItem": {
                                label: "Удалить",
                                action: function (obj) {
                                    $node = tree.get_selected()[0];
                                    if ($node != "root") {
                                        tree.delete_node($node);
                                    } else {
                                        alert("Вы не можете удалить корневую папку!");
                                    }
                                },
                                "separator_after": true

                            }
                        }
                    }
                },
                "types" : {
                    '#': {
                        'valid_children': ['group']
                    },
                    'root': {
                        "icon": "/img/folder_tm.png",
                        'valid_children ': ['group']
                    },
                    "group" : {
                        "icon": "/img/folder_tm.png",
                        max_depth: 5,
                        'valid_children ': ['person', 'group']
                    },
                    "person" : {
                        "max_children" : 0,
                        "icon": "/img/user.png"
                    }
                },
                'dnd': {
                    'check_while_dragging': true,
                    copy: false
                },
                "plugins" : [ "contextmenu", "dnd", "search", "state", "types", "wholerow" ]
            });
    });
</script>