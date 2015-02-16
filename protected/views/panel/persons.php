<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 15.02.15
 * Time: 23:02
 */

/* @var $persons Person[] */
?>

<div class="col-md-4">
    <div class="row">
        <!--<div class="col-md-12" style="margin-bottom: 20px;">
            <button type="button" class="btn btn-default" onclick="demo_create();"><i class="glyphicon glyphicon-asterisk"></i> Добавить</button>
            <button type="button" class="btn btn-default" onclick="demo_rename();"><i class="glyphicon glyphicon-pencil"></i> Переименовать</button>
            <button type="button" class="btn btn-default" onclick="demo_delete();"><i class="glyphicon glyphicon-remove"></i> Удалить</button>
        </div>-->
        <div class="row">
            <div class="col-md-12">
                <div id="jstree">
                    <ul>
                        <li id="root" data-jstree='{"type":"root"}'>Группы
                            <ul>
                                <?php foreach($persons as $personNumber => $person): ?>
                                    <?php if($personNumber == 0): ?>
                                        <li data-jstree='{"type":"group"}' group_id="<?=$person->group->id;?>"><?=$person->group->name;?><ul>
                                    <?php elseif($persons[$personNumber - 1]->group->name !== $person->group->name): ?>
                                        </ul></li><li data-jstree='{"type":"group"}' group_id="<?=$person->group->id;?>"><?=$person->group->name;?><ul>
                                    <?php endif; ?>
                                    <li data-jstree='{"type":"person"}' person_id="<?=$person->id;?>"><?=$person->name;?></li>
                                <?php endforeach;?>
                                </li>
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
        <?php foreach($persons as $person): ?>
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

<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
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
                            return (node_parent.type === "group" && node.type === "person"); //only allow dropping inside nodes of type 'Parent'
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
                                            if($node.id == 'root')
                                            {
                                                $node = tree.create_node($node, {
                                                    "li_attr": {
                                                        "type": "group",
                                                        "parent": $node.li_attr.group_id
                                                    }
                                                });
                                                tree.set_type($node, "group");
                                                tree.set_text($node, "Новая группа");
                                                tree.edit($node);
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
                "plugins" : [ "contextmenu", "dnd", "search", "state", "types", "wholerow" ]
            });
    });
</script>