<?php
namespace Rita\Users\Controller\Admin;

use Rita\Users\Controller\AppController;

class SettingsController extends AppController
{
    public function index()
    {
        $this->redirect(['controller' => 'Dashboard']);
    }
}