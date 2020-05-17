<?php

namespace application\controllers;

use application\core\Controller;
use application\core\View;

use application\lib\Pagination;


class MainController extends Controller {

	public function __construct($route) {
		parent::__construct($route);

		$this->model = $this->loadModel($route['controller']);

		$this->view = new View($route);
		$this->view->layout = 'default';
	}

	public function indexAction() {
		$this->view->render('Журнал книг');
	}

	public function scanAction() {
		$this->view->render('Сканировать базу');
	}

	public function aboutAction() {
		$this->view->render('О программе');
	}
 
}