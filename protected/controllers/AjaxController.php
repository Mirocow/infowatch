<?php
/**
 * Created by PhpStorm.
 * User: SlashMan
 * Date: 16.02.2015
 * Time: 11:40
 */

class AjaxController extends Controller
{
    public function actionCreatePerson()
    {
        if(isset($_POST['groupId']))
        {
            $person = new Person();

            $person->group_id = $_POST['groupId'];
            $person->save();

            echo json_encode(['id' => $person->getPrimaryKey()]);
        }
    }
    public function actionCreateGroup()
    {
        $group = new Group();
        $group->save();

        echo json_encode(['id' => $group->getPrimaryKey()]);
    }

    public function actionRenamePerson()
    {
        if(isset($_POST['id']) && isset($_POST['newName']))
        {
            $person = Person::model()->findByPk($_POST['id']);

            if($person)
            {
                $person->name = $_POST['newName'];
                $person->save();
            }
        }
    }
    public function actionRenameGroup()
    {
        if(isset($_POST['id']) && isset($_POST['newName']))
        {
            $group = Group::model()->findByPk($_POST['id']);

            if($group)
            {
                $group->name = $_POST['newName'];
                $group->save();
            }
        }
    }

    public function actionDeletePerson()
    {
        if(isset($_POST['id']))
        {
            Person::model()->deleteByPk($_POST['id']);
        }
    }
    public function actionDeleteGroup()
    {
        if(isset($_POST['id']))
        {
            Group::model()->deleteByPk($_POST['id']);
        }
    }

    public function actionMovePerson()
    {
        if(isset($_POST['id']) && isset($_POST['newParent']))
        {
            $person = Person::model()->findByPk($_POST['id']);
            if($person)
            {
                $person->group_id = $_POST['newParent'];
                $person->save();
            }
        }
    }
}