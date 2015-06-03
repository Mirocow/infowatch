<?php
/**
 * Created by PhpStorm.
 * User: SlashMan
 * Date: 03.06.2015
 * Time: 15:34
 */
?>


<div class="settings-content profile-content col-md-11">
    <div class="col-md-4 col-md-offset-4" style="margin-top: 50px;">
        <table class="table users-table">
            <thead>
                <tr>
                    <th>Логин</th>
                    <th>Роль</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                    <tr user-id="<?=$user->id?>">
                        <td><?=$user->login?></td>
                        <td>
                            <select class="user-role form-control input-sm" user-id="<?=$user->id?>">
                                <option value="ADMIN" <?=$user->role == 'ADMIN' ? 'selected="selected"' : ''; ?>>Администратор</option>
                                <option value="OFFICER" <?=$user->role == 'OFFICER' ? 'selected="selected"' : ''; ?>>Офицер</option>
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm delete-user" user-id="<?=$user->id?>"><i class="fa fa-close"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
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
    })
</script>