<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 15.02.15
 * Time: 23:02
 */

/* @var $persons Person[] */
/* @var $allPersons Person[] */
/* @var $form CActiveForm */

?>
<script>
    var type = 'group';
    var personId = null;
    var groupId = null;
</script>

<div class="content col-md-11">
    <div class="row">
        <nav class="breadcrumbs">
            Контроль
        </nav>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12 form-group">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default" id="add-group-btn"><i class="fa fa-plus"></i></button>
                    <button type="button" class="btn btn-default" id="edit-group-btn"><i class="fa fa-pencil-square-o"></i></button>
                    <button type="button" class="btn btn-default" id="remove-group-btn"><i class="fa fa-close"></i></button>
                </div>
            </div>
            <div class="col-md-12">
                <div id="jstree">
                    <ul>
                        <li id="root" data-jstree='{"type":"root"}'>Группы
                            <ul>
                                <?=$tree?>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 main-persons">
        <div class="col-md-12">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default" id="add-person-btn"><i class="fa fa-plus"></i></button>
                <button type="button" class="btn btn-default" id="remove-person-btn"><i class="fa fa-close"></i></button>
            </div>
        </div>
        <div class="col-md-12" id="details">

        </div>
    </div>
    <div class="col-md-8" style="display: none;">
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
                                <?php echo $form->textField($person,'imsi', ['class' => 'form-control', 'id' => 'person_imsi', 'disabled' => 'disabled']); ?>
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
    <div class="modal fade" id="editGroupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="editGroupModalLabel"></h4>
                </div>
                <?php
                $group = new Group();
                $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'edit-group-form',
                    'enableClientValidation'=>true,
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                    ),
                    'htmlOptions' => ['class' => 'form-horizontal']
                )); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <?php echo $form->labelEx($group,'name', ['class' => 'col-md-3 control-label']); ?>
                            <div class="col-md-9">
                                <?php echo $form->textField($group,'name', ['class' => 'form-control', 'id' => 'group_name']); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($group,'voice', ['class' => 'col-md-3 control-label']); ?>
                            <div class="col-md-9">
                                <?php echo $form->checkBox($group,'voice', ['id' => 'group_voice']); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($group,'sms', ['class' => 'col-md-3 control-label']); ?>
                            <div class="col-md-9">
                                <?php echo $form->checkBox($group,'sms', ['id' => 'group_sms']); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($group,'greet', ['class' => 'col-md-3 control-label']); ?>
                            <div class="col-md-9">
                                <?php echo $form->checkBox($group,'greet', ['id' => 'group_greet']); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($group,'greet_message', ['class' => 'col-md-3 control-label']); ?>
                            <div class="col-md-9">
                                <?php echo $form->textArea($group,'greet_message', ['class' => 'form-control', 'id' => 'group_greet_message']); ?>
                            </div>
                        </div>
                        <?php echo $form->textArea($group,'id', ['class' => 'form-control', 'style' => 'display: none;', 'id' => 'group_id']); ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        <button type="button" class="btn btn-primary" id="save-group">Сохранить</button>
                    </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>
<script>
    $('#add-group-btn').click(function(e){
        var instance = $('#jstree').jstree(true);
        var parentNode = instance.get_node(instance.get_selected(true)[0]);

        var parent = null;
        if(parentNode.type == 'group')
            parent = parentNode.li_attr.group_id;

        $.post(
            Yii.app.createUrl('/ajax/createGroup'),
            {
                parent: parent,
                name: 'Новая группа'
            }
        ).done(function(response)
            {
                response = JSON.parse(response);


                $node = $('#jstree').jstree(true).create_node(parentNode, {
                    "li_attr": {
                        "type": "group",
                        "parent": parent,
                        "group_id": response.id
                    }
                });
                $('#jstree').jstree(true).set_type($node, "group");
                $('#jstree').jstree(true).set_text($node, "Новая группа");
                $('#jstree').jstree(true).edit($node);
            });
    });
    $('#edit-group-btn').click(function(){
        $.post(
            Yii.app.createUrl('/ajax/getGroup'),
            {
                id: groupId
            }
        ).done(function (response) {
                response = JSON.parse(response);

                $('#group_name').val(response.name);
                $('#group_greet_message').val(response.greet_message);

                if(response.voice == '1')
                {
                    $('#group_voice').attr('checked', 'checked');
                }
                else
                {
                    $('#group_voice').removeAttr('checked');
                }

                if(response.sms == '1')
                {
                    $('#group_sms').attr('checked', 'checked');
                }
                else
                {
                    $('#group_sms').removeAttr('checked');
                }

                if(response.greet == '1')
                {
                    $('#group_greet').attr('checked', 'checked');
                }
                else
                {
                    $('#group_greet').removeAttr('checked');
                }

                $('#group_id').val(groupId);

                $('#editGroupModal').modal('show');
            });
    });
    $('#remove-group-btn').click(function(){
        var tree = $('#jstree').jstree(true);

        $node = tree.get_selected()[0];
        $parent = tree.get_parent($node);

        if ($node != "root") {
            var children = tree.get_children_dom($node);

            for(var i = 0; i < children.length; i++)
            {
                console.log(children[i].id);
                tree.move_node(children[i].id, $parent);
            }
            tree.delete_node($node);
            tree.select_node($parent);

        } else {
            alert("Вы не можете удалить корневую папку!");
        }
    });
    $('#add-person-btn').click(function(){
        var instance = $('#jstree').jstree(true);
        var parentNode = instance.get_node(instance.get_selected(true)[0]);

        var parent = null;
        if(parentNode.type == 'group')
            parent = parentNode.li_attr.group_id;

        $.post(
            Yii.app.createUrl('/ajax/createPerson'),
            {
                groupId: parent
            }
        ).done(function(response)
            {
                response = JSON.parse(response);

                showUserForm(response.id);
            });
    });
    $(document).on('change', '.check-all-persons', function(e){
        if($(this).prop('checked'))
        {
            $('.person-checkbox').each(function(index, checkbox){
                $(checkbox).prop('checked', true);
            });
        }
        else {
            $('.person-checkbox').each(function(index, checkbox){
                $(checkbox).prop('checked', false);
            });
        }
    });

    $(document).on('click', '.person-checkbox', function(e) {
        e.stopPropagation();
    });
    $(document).on('change', '.person-checkbox', function(e){
        e.stopPropagation();

        if($('.check-all-persons').prop('checked'))
            $('.check-all-persons').prop('checked', false);

    });
    $(document).on('click', '.person-row', function(e){
        var id = $(this).attr('person-id');
        $('.check-all-persons').prop('checked', false);
        $('.person-checkbox').each(function(index, checkbox){
            $(checkbox).prop('checked', false);
        });
        showUserForm(id);
    });
    $(document).ready(function(){
        $('#remove-person-btn').click(function(){

            var url = Yii.app.createUrl('/ajax/deletePerson');
            var ids = [];
            var checkedCheckboxes = $('.person-checkbox:checked');
            $(checkedCheckboxes).each(function(index, checkbox){
                ids.push($(checkbox).attr('person-id'));
            });
            $.post(
                url,
                {
                    id:  JSON.stringify(ids)
                }
            ).done(function(response){
                $(checkedCheckboxes).each(function(index, checkbox) {
                    $(checkbox).parent().parent().remove();
                });
            });
        });
        $('#edit-person').click(function(){
            showUserForm(personId);
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
                drawGroup(response.group_id);
                //drawUser(response.id);
                //$('#jstree li[person_id=' + response.id + '] a').html('<i class="jstree-icon jstree-themeicon jstree-themeicon-custom" role="presentation" style="background-image: url(<?=Yii::app()->request->baseUrl?>/img/user.png); background-size: auto; background-position: 50% 50%;"></i>' + response.name);
                $('#editPersonModal').modal('hide');
            });
        });
        $('#save-group').click(function(){
            var form = new FormData($('#edit-group-form')[0]);

            var request = $.ajax({
                url: Yii.app.createUrl('/ajax/saveGroup'),
                type: "POST",
                processData: false,
                cache: false,
                contentType: false,
                data: form
            });
            request.done(function(response) {
                response = JSON.parse(response);
                drawGroup(response.id);
                $('#jstree li[group_id=' + response.id + '] a').html('<i class="jstree-icon jstree-themeicon jstree-themeicon-custom" role="presentation" style="background-image: url(<?=Yii::app()->request->baseUrl?>/img/folder_tm.png); background-size: auto; background-position: 50% 50%;"></i>' + response.name);
                $('#editGroupModal').modal('hide');
            });
        });

        $('#edit-group-form i').click(function() {
            var checkbox = $(this).parent().find('input[type=checkbox]');

            if($(checkbox).prop('checked')) {
                $(checkbox).prop('checked', false);
                $(this).removeClass('fa-toggle-on').removeClass('text-success').addClass('fa-toggle-off').addClass('text-danger');
            }
            else {
                $(checkbox).prop('checked', true);
                $(this).addClass('fa-toggle-on').addClass('text-success').removeClass('fa-toggle-off').removeClass('text-danger');
            }
        });
    });

    function showUserForm(uid)
    {
        $.post(
            Yii.app.createUrl('/ajax/getPerson'),
            {
                id: uid
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
                $('#person_id').val(uid);

                $('#editPersonModal').modal('show');
            });
    }
</script>

<script>
    function drawUser(id)
    {
        personId = id;
        $.post(
            Yii.app.createUrl('/ajax/drawUser'),
            {
                id: id
            }
        ).done(function(response){
                response = JSON.parse(response);
                $('#details').html(response.content);

                type = 'user';
                $('#edit-person').removeAttr('disabled');
                $('#remove-person').removeAttr('disabled');
                personId = response.user.id;
                $('#group-buttons').hide();
                $('#person-buttons').show();
            });
    }
    function drawGroup(id)
    {
        groupId = id;
        $.post(
            Yii.app.createUrl('/ajax/drawGroup'),
            {
                id: id
            }
        ).done(function(response){
            response = JSON.parse(response);

            $('#details').html(response.content);
            if(typeof response.group == 'undefined')
            {
                $('#edit-group-btn').prop('disabled', true);
                $('#remove-group-btn').prop('disabled', true);
            }
            else {
                $('#edit-group-btn').prop('disabled', false);
                $('#remove-group-btn').prop('disabled', false);
            }
            type = 'group';
            $('#edit-group').removeAttr('disabled');
        });
    }
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
        .on('select_node.jstree', function(e, target) {
            if(target.node.type == 'person')
            {
                drawUser(target.node.li_attr.person_id);
            }
            if(target.node.type == 'group')
            {
                drawGroup(target.node.li_attr.group_id);
            }
            if(target.node.type == 'root')
            {
                drawGroup(null);
            }
        })
        .on('move_node.jstree', function(e, target){

            if(target.node.type == 'person')
            {
                var newParent = $('#' + target.parent).attr('group_id');
                var id = target.node.li_attr.person_id;

                $.post(
                    Yii.app.createUrl('/ajax/movePerson'),
                    {
                        id: id,
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
                var url = null;
                var id = null;
                if(target.node.type == 'person')
                {
                    url = Yii.app.createUrl('/ajax/renamePerson');
                    id = $('#'+target.node.id).attr('person_id');

                }
                else
                {
                    url = Yii.app.createUrl('/ajax/renameGroup');
                    id = $('#'+target.node.id).attr('group_id');
                }

                $.post(
                    url,
                    {
                        id: id,
                        newName: target.text
                    }
                ).done(function(response){
                        return true;
                    });
        })
        .on('delete_node.jstree', function(e, target) {
                if(target.node.type == 'person')
                {
                    url = Yii.app.createUrl('/ajax/deletePerson');
                    id = $('#'+target.node.id).attr('person_id');

                }
                else
                {
                    url = Yii.app.createUrl('/ajax/deleteGroup');
                    id = $('#'+target.node.id).attr('group_id');
                }


                $.post(
                    url,
                    {
                        id: id
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
                            return ((node_parent.type === "group" || node_parent.type === "root")); //only allow dropping inside nodes of type 'Parent'
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
                                            //if($node.id == 'root')
                                            //{
                                                var parent = null;
//                                                if($node.type == 'group')
                                                    //parent = null;//$node.li_attr.group_id;
                                                $.post(
                                                    Yii.app.createUrl('/ajax/createGroup'),
                                                    {
                                                        parent: parent,
                                                        name: 'Новая группа'
                                                    }
                                                ).done(function(response)
                                                    {
                                                        response = JSON.parse(response);


                                                        $node = tree.create_node('root' /*$node*/, {
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
                                            //}
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
                        'valid_children ': ['person']
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
                "plugins" : [ "contextmenu", "dnd", "search", "state", "types", "wholerow", "crrm" ]
            });
    });
</script>