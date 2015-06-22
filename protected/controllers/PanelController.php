<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 15.02.15
 * Time: 22:12
 */

class PanelController extends Controller {

    public $layout = 'panel';
    public $active = 'index';

    public function filters()
    {
        return array(
            'isUser'  // указываем название метода фильтра БЕЗ префикса "filter"
        );
    }

    public function actionIndex()
    {
        $knownDevices = Device::model()->findAll([
            'condition' => 'created >= UNIX_TIMESTAMP() - 5*60 AND person_id IS NOT NULL', // 5 mins
        ]);

        $this->active = 'index';
        $this->render('index', compact('knownDevices'));
    }

    public function actionUnknown()
    {

        $unknownDevices = Device::model()->findAll([
            'condition' => 'created >= UNIX_TIMESTAMP() - 5*60 AND person_id IS NULL', // 5 mins
        ]);

        $this->active = 'unknown';
        $this->render('unknown', compact('unknownDevices'));
    }

    public function actionPersons()
    {
        $persons = [];

        $groups = Group::model()->findAllByAttributes(['parent_id' => null]);

        $tree = $this->displayTree($groups);

        /*foreach(Person::model()->findAllByAttributes(['group_id' => null]) as $person)
        {
            $tree .= '<li data-jstree=\'{"type":"person"}\' id="p'.$person->id.'" person_id="'.$person->id.'">'.$person->name.'</li>';
        }*/
        
        $allPersons = Person::model()->findAll();

        $groups = CHtml::listData(Group::model()->findAll(),'id','name');

        $this->active = 'persons';
        $this->render('persons', compact('persons', 'allPersons', 'tree', 'groups'));
    }

    public function displayTree($groups)
    {
        $return = '';
        foreach($groups as $group)
        {
            $return .= '<li data-jstree=\'{"type":"group"}\' group_id="'.$group->id.'">'.$group->name;
            if((Group::model()->countByAttributes(['parent_id' => $group->id]) + Person::model()->countByAttributes(['group_id' => $group->id])) > 0)
            {
                $return .= '<ul>';
                /*foreach(Person::model()->findAllByAttributes(['group_id' => $group->id]) as $person)
                {
                    $return .= '<li data-jstree=\'{"type":"person"}\' id="p'.$person->id.'" person_id="'.$person->id.'">'.$person->name.'</li>';
                }*/
                $return .= $this->displayTree(Group::model()->findAllByAttributes(['parent_id' => $group->id]));
                $return .= '</ul>';
            }
        }

        return $return;
    }
    public function actionSettings()
    {
        $operators = Operator::model()->findAll();

        $voip = Settings::getByName('voip');
        $gsm = Settings::getByName('gsm');
        $system = Settings::getByName('system');
        $network = Settings::getByName('network');

        $this->active = 'settings';
        $this->render('settings', compact('operators', 'voip', 'gsm', 'system', 'network'));
    }

    public function actionLogs()
    {
        $this->active = 'logs';
        $this->render('logs');
    }

    public function actionProfile()
    {
        $user = User::model()->findByPk(Yii::app()->user->getId());
        if(isset($_POST['User']))
        {
            $user->attributes = $_POST['User'];
            if($_POST['User']['passwordRepeat'] == $user->password && $user->validate())
            {
                $user->save();
                Yii::app()->user->setFlash('SUCCESS', 'Пароль успешно изменен!');
            }
            else {
                Yii::app()->user->setFlash('ERROR', 'Пароли не совпадают!');
            }
            $this->redirect(['/panel/profile']);
        }

        $this->render('profile', compact('user'));
    }

    public function actionUsers()
    {
        $users = User::model()->findAll();
        $this->active = 'users';
        $this->render('users', compact('users'));
    }

    public function actionJs()
    {
        echo json_encode(['hostname' => 'example.com', 'ip' => '192.168.1.113', 'mask' => '255.255.255.0', 'gateway' => '192.168.1.1', 'dns' => '192.168.1.1']);
    }
}