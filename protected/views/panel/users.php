<?php
/**
 * Created by PhpStorm.
 * User: SlashMan
 * Date: 03.06.2015
 * Time: 15:34
 */
/* @var $form CActiveForm */
?>


<div class="settings-content profile-content col-md-11">
    <div class="col-md-6 col-md-offset-3" style="margin-top: 50px;">
        <table class="table users-table table-striped">
            <thead>
                <tr>
                    <th>Логин</th>
                    <th>Пароль</th>
                    <th>Роль</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                    <tr user-id="<?=$user->id?>">
                        <td>
                            <?php if($user->login == 'admin'): ?>
                                <?=$user->login?>
                            <?php else: ?>
                                <a href="#" id="login" data-type="text" data-pk="<?=$user->id?>" class="xedit" data-url="<?=$this->createUrl('/ajax/updateUser')?>"><?=$user->login?></a>
                            <?php endif; ?>
                        </td>
                        <td><a href="#" id="password" data-type="text" data-pk="<?=$user->id?>" class="xedit" data-url="<?=$this->createUrl('/ajax/updateUser')?>"><?=$user->password?></a></td>
                        <td>
                            <?php if($user->login == 'admin'): ?>
                                Администратор
                            <?php else: ?>
                                <select class="user-role form-control input-sm" user-id="<?=$user->id?>">
                                    <option value="ADMIN" <?=$user->role == 'ADMIN' ? 'selected="selected"' : ''; ?>>Администратор</option>
                                    <option value="OFFICER" <?=$user->role == 'OFFICER' ? 'selected="selected"' : ''; ?>>Офицер</option>
                                </select>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($user->login != 'admin'): ?>
                                <button class="btn btn-danger btn-sm delete-user" user-id="<?=$user->id?>"><i class="fa fa-close"></i></button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="col-md-12 text-center">
            <button class="btn btn-info" id="add-user"><i class="fa fa-plus"></i></button>
        </div>
    </div>
</div>

<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addUserModalLabel"></h4>
            </div>
            <?php
            $user = new User();
            $form=$this->beginWidget('CActiveForm', array(
                'id'=>'add-user-form',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
                'htmlOptions' => ['class' => 'form-horizontal']
            )); ?>
            <div class="modal-body">
                <div class="form-group">
                    <?php echo $form->labelEx($user,'login', ['class' => 'col-md-3 control-label']); ?>
                    <div class="col-md-9">
                        <?php echo $form->textField($user,'login', ['class' => 'form-control', 'id' => 'user_login']); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($user,'password', ['class' => 'col-md-3 control-label']); ?>
                    <div class="col-md-9">
                        <?php echo $form->textField($user,'password', ['class' => 'form-control', 'id' => 'user_password']); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($user,'role', ['class' => 'col-md-3 control-label']); ?>
                    <div class="col-md-9">
                        <?php echo $form->dropDownList($user,'role', ['ADMIN' => 'Администратор', 'OFFICER' => 'Офицер'], ['class' => 'form-control', 'id' => 'user_role']); ?>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id="save-user">Сохранить</button>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
<script>
    $.fn.editable.defaults.mode = 'popup';
    $(document).on('click', '.delete-user', function(e){
        var id = $(this).attr('user-id');
        $.get(
            Yii.app.createUrl('/ajax/deleteUser', {id: id})
        ).done(function(response){
            $('tr[user-id='+id+']').remove();
        });
    });
    $(document).on('change', '.user-role', function(e){
        var id = $(this).attr('user-id');
        var role = $(this).find('option:selected').val();
        $.get(
            Yii.app.createUrl('/ajax/userChangeRole', {id: id, role: role})
        ).done(function(response){});
    });

    $(document).ready(function(){
        $('.xedit').editable();
    });
    $(document).on('click', '#add-user', function(){
        $('#addUserModal').modal('show');
    });
    $(document).on('click', '#save-user', function() {
        if(validateForm())
        {
            var form = new FormData($('#add-user-form')[0]);

            var request = $.ajax({
                url: Yii.app.createUrl('/ajax/addUser'),
                type: "POST",
                processData: false,
                cache: false,
                contentType: false,
                data: form
            });
            request.done(function (user) {
                user = JSON.parse(user);

                if(typeof user.error == 'undefined')
                {
                    var html = '<tr user-id="' + user.id + '">' +
                        '<td><a href="#" id="login" data-type="text" data-pk="' + user.id + '" class="xedit" data-url="' + Yii.app.createUrl('/ajax/updateUser') + '">' + user.login + '</a></td>' +
                        '<td><a href="#" id="password" data-type="text" data-pk="' + user.id + '" class="xedit" data-url="' + Yii.app.createUrl('/ajax/updateUser') + '">' + user.password + '</a></td>' +
                        '<td>' +
                        '<select class="user-role form-control input-sm" user-id="' + user.id + '">' +
                        '<option value="ADMIN" ' + (user.role == 'ADMIN' ? 'selected="selected"' : '') + '>Администратор</option>' +
                        '<option value="OFFICER" ' + (user.role == 'OFFICER' ? 'selected="selected"' : '') + '>Офицер</option>' +
                        '</select>' +
                        '</td>' +
                        '<td>' +
                        '<button class="btn btn-danger btn-sm delete-user" user-id="' + user.id + '"><i class="fa fa-close"></i></button>' +
                        '</td></tr>';

                    $('.users-table tbody').append(html);

                    $('.users-table tbody tr:last .xedit').editable();

                    $('#addUserModal').modal('hide');
                    $('#user_login').val('');
                    $('#user_password').val('');
                }
                else
                {
                    $('#user_login').parent().parent().addClass('has-error');
                }
            });
        }
    });

    function validateForm()
    {
        $('#user_login, #user_password').parent().parent().removeClass('has-error');
        if($('#user_login').val() == '')
        {
            $('#user_login').parent().parent().addClass('has-error');
            return false;
        }

        if($('#user_password').val() == '')
        {
            $('#user_password').parent().parent().addClass('has-error');
            return false;
        }

        return true;
    }
</script>