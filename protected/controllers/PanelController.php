<?php
/**
 * Created by PhpStorm.
 * User: slashman
 * Date: 15.02.15
 * Time: 22:12
 */

class PanelController extends Controller {

    public $layout = 'panel';

    public function actionIndex()
    {
        $unknownDevices = Device::model()->findAll([
            'condition' => 'created >= UNIX_TIMESTAMP() - 5*60 AND person_id IS NULL', // 5 mins
        ]);

        $knownDevices = Device::model()->findAll([
            'condition' => 'created >= UNIX_TIMESTAMP() - 5*60 AND person_id IS NOT NULL', // 5 mins
        ]);

        $this->render('index', compact('unknownDevices', 'knownDevices'));
    }

    public function actionPersons()
    {
        $persons = Person::model()->findAll([
            'order' => 'group_id',
        ]);
        $this->render('persons', compact('persons'));
    }

    public function actionSettings()
    {
        $this->render('settings');
    }
}