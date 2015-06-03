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

            //echo json_encode(['id' => $person->getPrimaryKey()]);
            echo json_encode($person->attributes);
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
            $ids = json_decode($_POST['id']);
            $criteria = new CDbCriteria();
            $criteria->addInCondition('id', $ids);
            Person::model()->deleteAll($criteria);
        }
    }
    public function actionDeleteGroup()
    {
        if(isset($_POST['id']))
        {
            if(isset($_POST['id']))
            {
                $ids = json_decode($_POST['id']);

                Person::model()->updateAll(['group_id' => null], 'group_id IN (' . implode(',',$ids) . ')');
                Group::model()->updateAll(['parent_id' => null]);
                Group::model()->deleteAll('id IN (' . implode(',',$ids) . ')');
            }
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
    public function actionGetGroup()
    {
        if(isset($_POST['id']))
        {
            $group = Group::model()->findByPk($_POST['id']);
            if($group)
                echo json_encode($group->attributes);
        }
    }
    public function actionGetOperator()
    {
        if(isset($_POST['id']))
        {
            $operator = Operator::model()->findByPk($_POST['id']);
            if($operator)
                echo json_encode($operator->attributes);
        }
    }
    public function actionGetMnc()
    {
        if(isset($_GET['id']))
        {
            $mnc = Mnc::model()->findByAttributes(['id' => $_GET['id']]);
            if($mnc)
                echo json_encode($mnc->attributes);
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
    public function actionSaveGroup()
    {
        if(isset($_POST['Group']))
        {
            $group = Group::model()->findByPk($_POST['Group']['id']);
            $group->attributes = $_POST['Group'];
            $group->save();
            echo json_encode($group->attributes);
        }
    }
    public function actionSaveOperator()
    {
        if(isset($_POST['Operator']))
        {
            $operator = new Operator();
            $operator->attributes = $_POST['Operator'];
            $operator->save();
            $atts = $operator->attributes;
            $atts['textStatus'] = $operator->getStatus();
            echo json_encode($atts);
        }
    }
    public function actionEditOperator()
    {
        if(isset($_POST['Operator']))
        {
            $operator = Operator::model()->findByPk($_POST['Operator']['id']);
            $operator->attributes = $_POST['Operator'];
            $operator->save();
            $atts = $operator->attributes;
            $atts['textStatus'] = $operator->getStatus();
            echo json_encode($atts);
        }
    }

    public function actionDrawUser()
    {
        if(isset($_POST['id']))
        {
            $user = Person::model()->findByPk($_POST['id']);

            if($user)
            {
                $response = ['content' => $this->renderPartial('user', compact('user'), true), 'user' => $user->attributes];
                echo json_encode($response);
            }
        }
    }
    public function actionDrawGroup()
    {
        if(isset($_POST['id']))
        {
            if($_POST['id'])
            {
                $group = Group::model()->findByPk($_POST['id']);
                if($group)
                {
                    $response = ['content' => $this->renderPartial('group', compact('group'), true), 'group' => $group->attributes];
                    echo json_encode($response);
                }
            }
            else {
                $criteria = new CDbCriteria();
                $criteria->condition = 'group_id IS NULL';

                $persons = Person::model()->findAll($criteria);
                $groups = Group::model()->findAll();

                $response = ['content' => $this->renderPartial('without_group', compact('persons', 'groups'), true)];
                echo json_encode($response);
            }

        }
    }
    public function actionSaveSetting()
    {
        if(isset($_POST['name']))
        {
            Settings::model()->updateAll(['value' => json_encode($_POST['params'])], 'name = :name', [':name' => $_POST['name']]);
        }
    }
    public function actionAddPerson(){
        if(isset($_POST['Person'])) {
            $person = new Person();
            $person->attributes = $_POST['Person'];
            if($person->validate() && $person->save())
            {
                Device::model()->updateAll(['person_id' => $person->getPrimaryKey()], 'imsi = :imsi', [':imsi' => $person->imsi]);
                echo json_encode($person->attributes);
            }
        }
    }
    public function actionDeleteUser($id) {
        User::model()->deleteByPk($id);
    }
    public function actionUserChangeRole($id, $role)
    {
        User::model()->updateByPk($id, ['role' => $role]);
    }
}