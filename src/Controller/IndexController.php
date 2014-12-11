<?php

namespace Users\Controller;

use Users\Controller\AppController;

class IndexController extends AppController {
	
	
    public function index() {
		return $this->render('/index');		
    }
	
}