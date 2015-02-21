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

    public function actionIndex()
    {
        $unknownDevices = Device::model()->findAll([
            'condition' => 'created >= UNIX_TIMESTAMP() - 5*60 AND person_id IS NULL', // 5 mins
        ]);

        $knownDevices = Device::model()->findAll([
            'condition' => 'created >= UNIX_TIMESTAMP() - 5*60 AND person_id IS NOT NULL', // 5 mins
        ]);

        $this->active = 'index';
        $this->render('index', compact('unknownDevices', 'knownDevices'));
    }

    public function actionPersons()
    {
        $persons = [];

        $groups = Group::model()->findAllByAttributes(['parent_id' => null]);

        $tree = $this->displayTree($groups);
        
        $allPersons = Person::model()->findAll();

        $this->active = 'persons';
        $this->render('persons', compact('persons', 'allPersons', 'tree'));
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
                foreach(Person::model()->findAllByAttributes(['group_id' => $group->id]) as $person)
                {
                    $return .= '<li data-jstree=\'{"type":"person"}\' person_id="'.$person->id.'">'.$person->name.'</li>';
                }
                $return .= $this->displayTree(Group::model()->findAllByAttributes(['parent_id' => $group->id]));
                $return .= '</ul>';
            }
        }

        return $return;
    }
    public function actionSettings()
    {
        $operators = Operator::model()->findAll();
        $this->active = 'settings';
        $this->render('settings', compact('operators'));
    }
}