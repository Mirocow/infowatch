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
        <div class="col-md-12" style="margin-bottom: 20px;">
            <button type="button" class="btn btn-default" onclick="demo_create();"><i class="glyphicon glyphicon-asterisk"></i> Добавить</button>
            <button type="button" class="btn btn-default" onclick="demo_rename();"><i class="glyphicon glyphicon-pencil"></i> Переименовать</button>
            <button type="button" class="btn btn-default" onclick="demo_delete();"><i class="glyphicon glyphicon-remove"></i> Удалить</button>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="jstree">
                    <ul>
                        <li id="root" data-jstree='{"type":"group"}'>Группы
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
    <table class="table table-striped table-hover ">
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
            <tr>
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
        .on('create_node.jstree', function(node, parent, position){
            alert(position);
        })
        .on('rename_node.jstree', function(node, text, old) {
            alert(text);
        })
        .on('delete_node.jstree', function(node, parent) {
            alert(parent);
        })
            .jstree({
                "core" : {
                    "animation" : 0,
                    "check_callback" : true,
                    "themes" : { "stripes" : true }
                },
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
                                                $node = tree.create_node($node, {
                                                    "li_attr": {
                                                        "type": "user",
                                                        "parent": $node.li_attr.group_id
                                                    }
                                                });
                                                tree.set_text($node, "Новый пользователь");
                                                tree.set_type($node, "person");
                                                tree.edit($node);
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

                            },
                        }
                    }
                },
                "types" : {
                    "group" : {
                        "icon": "/img/folder_tm.png",
                        max_depth: 5
                    },
                    "person" : {
                        "max_children" : 0,
                        "icon": "/img/user.png"
                    }
                },
                "plugins" : [ "contextmenu", "dnd", "search", "state", "types", "wholerow" ]
            });
    });
</script>