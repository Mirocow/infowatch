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

        $groups = Group::model()->findAll();

        foreach($groups as $group)
        {
            $newGroup['group'] = $group;
            $newGroup['persons'] = Person::model()->findAllByAttributes(['group_id' => $group->getPrimaryKey()]);

            $persons[] = $newGroup;
        }
        
        $allPersons = Person::model()->findAll();

        $this->active = 'persons';
        $this->render('persons', compact('persons', 'allPersons'));
    }

    public function actionSettings()
    {
        $operators = Operator::model()->findAll();
        $this->active = 'settings';
        $this->render('settings', compact('operators'));
    }
}