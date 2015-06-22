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
/* @var $groups string[] */

?>
<script>
    var type = 'group';
    var personId = null;
    var groupId = null;

    var parent = null;
    var parentNode = '#';
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
                        <?=$tree?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 main-persons">
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
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($allPersons as $person): ?>
                <tr class="person-button" person-id="<?=$person->id;?>">
                    <td><?=$person->name;?></td>
                    <td><?=$person->job;?></td>
                    <td><?=$person->department;?></td>
                    <td><?=$person->boss;?></td>
                    <td><?=$person->phone;?></td>
                    <td><?=$person->phone;?></td>
                    <td><button type="button" class="btn btn-primary person-button"><i class="fa fa-pencil"></i></button></td>
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
                            <?php echo $form->labelEx($person,'group_id', ['class' => 'col-md-3 control-label']); ?>
                            <div class="col-md-9">
                                <?php echo $form->dropDownList($person,'group_id', $groups, ['class' => 'form-control', 'id' => 'person_group']); ?>
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
    var selectedNodeId = null;
    var selectedNode = null;
    $(document).on('click', '.person-row', function(e){
        e.preventDefault();
        e.stopPropagation();

        $(this).find('input:first').trigger('click');
    });
    $(document).on('click','#add-group-btn',function(e){
        var instance = $('#jstree').jstree(true);
        //var parentNode = instance.get_node(instance.get_selected(true)[0]);

        parent = null;
        parentNode = '#';
        if(selectedNodeId !== null) {
            if (instance.get_path(selectedNode.node).length == 1) {
                parent = selectedNode.node.li_attr.group_id;
                parentNode = selectedNode.node.id;
            }
            else if(instance.get_path(selectedNode.node).length > 1)
            {
                parent = instance.get_node(instance.get_parent(selectedNode.node)).li_attr.group_id;
                parentNode = instance.get_node(instance.get_parent(selectedNode.node)).id;
            }
        }

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
                        "parent": parentNode,
                        "group_id": response.id
                    }
                });
                $('#jstree').jstree(true).set_type($node, "group");
                $('#jstree').jstree(true).set_text($node, "Новая группа");
                $('#jstree').jstree(true).edit($node);
                drawGroup(null);
            });
    });
    $(document).on('click','#edit-group-btn',function(){
        showGroupForm(groupId);
    });

    $(document).on('click', '#remove-group-btn', function(){

        var url = Yii.app.createUrl('/ajax/deleteGroup');
        var ids = [];
        var checkedCheckboxes = $('.group-checkbox:checked');
        $(checkedCheckboxes).each(function(index, checkbox){
            ids.push($(checkbox).attr('group-id'));
        });
        $.post(
            url,
            {
                id:  JSON.stringify(ids)
            }
        ).done(function(response){
                var instance = $('#jstree').jstree(true);

                $(checkedCheckboxes).each(function(index, checkbox) {
                    instance.delete_node($('li[group_id='+$(checkbox).attr('group-id')+']').attr('id'));
                    $(checkbox).parent().parent().remove();
                });
            });
    });
    $(document).on('click', '#add-person-btn', function(){
        showUserForm(null);
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
    $(document).on('change', '.check-all-groups', function(e){
        if($(this).prop('checked'))
        {
            $('.group-checkbox').each(function(index, checkbox){
                $(checkbox).prop('checked', true);
            });
        }
        else {
            $('.group-checkbox').each(function(index, checkbox){
                $(checkbox).prop('checked', false);
            });
        }
    });

    $(document).on('click', '.group-checkbox', function(e) {
        e.stopPropagation();
    });
    $(document).on('change', '.group-checkbox', function(e){
        e.stopPropagation();

        if($('.check-all-groups').prop('checked'))
            $('.check-all-groups').prop('checked', false);

    });
    $(document).on('click', '.person-button', function(e){
        e.preventDefault();
        e.stopPropagation();
        e.cancelBubble = true;

        var id = $(this).attr('person-id');
        $('.check-all-persons').prop('checked', false);
        $('.person-checkbox').each(function(index, checkbox){
            $(checkbox).prop('checked', false);
        });
        showUserForm(id);
    });
    $(document).on('click', '.group-button', function(e){
        e.preventDefault();
        e.stopPropagation();
        e.cancelBubble = true;

        var id = $(this).attr('group-id');
        $('.check-all-groups').prop('checked', false);
        $('.group-checkbox').each(function(index, checkbox){
            $(checkbox).prop('checked', false);
        });
        showGroupForm(id);
    });
    $(document).on('click', '#remove-person-btn', function(){

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
    $(document).on('click', '#edit-person', function(){
        showUserForm(personId);
    });
    $(document).on('click', '#save-person', function(){
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
    $(document).on('click', '#save-group', function(){
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

            var instance = $('#jstree').jstree(true);
            var parentNode = instance.get_node(instance.get_selected(true)[0]);

            if(parentNode.type != 'root')
                drawGroup(response.id);
            else
                drawGroup(null);

            $('#jstree li[group_id=' + response.id + '] a').html('<i class="jstree-icon jstree-themeicon jstree-themeicon-custom" role="presentation" style="background-image: url(<?=Yii::app()->request->baseUrl?>/img/folder_tm.png); background-size: auto; background-position: 50% 50%;"></i>' + response.name);
            $('#editGroupModal').modal('hide');
        });
    });

    $(document).on('click', '#edit-group-form i', function() {
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

    function showUserForm(uid)
    {
        if(uid == null)
        {
            var instance = $('#jstree').jstree(true);
            var parentNode = instance.get_node(instance.get_selected(true)[0]);

            var parent = null;
            if(parentNode.type == 'group')
                parent = parentNode.li_attr.group_id;

            $('#person_name').val('');
            $('#person_job').val('');
            $('#person_department').val('');
            $('#person_boss').val('');
            $('#person_phone').val('');
            $('#person_imsi').val('');
            $('#person_info').val('');
            $('#person_id').val(null);
            $('#person_group option[value='+parent+']').prop('selected', true);

            $('#editPersonModal').modal('show');
        }
        else
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
                    $('#person_group option[value='+response.group_id+']').prop('selected', true);

                    $('#editPersonModal').modal('show');
                });
        }
    }
    function showGroupForm(gid)
    {

        $.post(
            Yii.app.createUrl('/ajax/getGroup'),
            {
                id: gid
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

                $('#group_id').val(gid);

                $('#editGroupModal').modal('show');
            });
    }
</script>

<script>
    function nodeDeselected()
    {
        $('#details').html('');
    }
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
            if(selectedNodeId == target.node.li_attr.group_id)
            {
                selectedNode = null;
                selectedNodeId = null;
                $('#jstree').jstree(false).deselect_all();
                alert('deselected');
                nodeDeselected();
            }
            else
            {
                selectedNodeId = target.node.li_attr.group_id;
                selectedNode = target;
                if(target.node.type == 'person')
                {
                    drawUser(target.node.li_attr.person_id);
                }
                if(target.node.type == 'root')
                {
                    drawGroup(null);
                }
                if(target.node.type == 'group')
                {
                    drawGroup(target.node.li_attr.group_id);
                    groupId = target.node.li_attr.group_id;
                }
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
                else if(target.node.type == 'group')
                {
                    url = Yii.app.createUrl('/ajax/renameGroup');
                    id = $('#'+target.node.id).attr('group_id');
                    drawGroup(null);
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
                            if(typeof node_parent.li_attr == 'undefined')
                                return true;
                            else
                                if(node_parent.li_attr.group_id == 1)
                                    return false;
                            return true;
                            //return ((node_parent.type === "group" && node_parent.li_attr.group_id != 1)); //only allow dropping inside nodes of type 'Parent'
                        }
                        return true;  //allow all other operations
                    }
                },
                "state": { "key": '<%=Request.QueryString["type"]%>_infotree' },
                /*"contextmenu" : {
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


                                                        $node = tree.create_node('root' /*$node*//*, {
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
                },*/
                "types" : {
                    /*'#': {
                        'valid_children': ['     group']
                    },*/
                    /*'root': {
                        "icon": "/img/folder_tm.png",
                        'valid_children ': ['group']
                    },*/
                    "group" : {
                        "icon": "/img/folder_tm.png",
                        max_depth: 1,
                        'valid_children ': ['group']
                    },
                    /*"person" : {
                        "max_children" : 0,
                        "icon": "/img/user.png"
                    }*/
                },
                'dnd': {
                    'check_while_dragging': true,
                    copy: false
                },
                "plugins" : ["search", "state", "types", "wholerow", "crrm","dnd" ] //dnd, contextmenu
            });
    });
</script>