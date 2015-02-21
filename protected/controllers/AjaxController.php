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
        if(isset($_POST['parent']) && isset($_POST['name']))
        {
            $group = new Group();
            $group->name = $_POST['name'];
            $group->parent_id = $_POST['parent'];
            $group->save();

            echo json_encode($group->attributes);
        }
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
    public function actionDeleteOperator()
    {
        if(isset($_POST['id']))
        {
            Operator::model()->deleteByPk($_POST['id']);
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
    public function actionMoveGroup()
    {
        if(isset($_POST['id']) && isset($_POST['parent']))
        {
            $group = Group::model()->findByPk($_POST['id']);
            if($group)
            {
                $group->parent_id = $_POST['parent'];
                $group->save();
            }
        }
    }


    public function actionGetPerson()
    {
        if(isset($_POST['id']))
        {
            $person = Person::model()->findByPk($_POST['id']);
            if($person)
                echo json_encode($person->attributes);
        }
    }
    public function actionSavePerson()
    {
        if(isset($_POST['Person']))
        {
            $person = Person::model()->findByPk($_POST['Person']['id']);
            $person->attributes = $_POST['Person'];
            $person->save();
            echo json_encode($person->attributes);
        }
    }
    public function actionSaveOperator()
    {
        if(isset($_POST['Operator']))
        {
            $operator = new Operator();
            $operator->attributes = $_POST['Operator'];
            $operator->save();
            echo json_encode($operator->attributes);
        }
    }
}