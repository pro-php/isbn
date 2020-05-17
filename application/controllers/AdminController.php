<?php

namespace application\controllers;

use application\controllers\TasksController;
use application\core\View;


class AdminController extends Controller {

	public function __construct($route) {
		parent::__construct($route);

		$this->model = $this->loadModel($route['controller']);

		$this->view = new View($route);
		$this->view->layout = 'admin';
	}

	public function loginValidate($post) {
		$config = require 'application/config/admin.php';
		
		if (empty($post['login']) || empty($post['password'])) {
			$this->error = 'Укажите логин и пароль!';
			return false;
		}
				
		if ($config['login'] != $post['login'] or $config['password'] != $post['password']) {
			$this->error = 'Логин или пароль указан неверно!';
			return false;
		}

		return true;
	}

	public function loginAction() {
		if (isset($this->request->session['admin'])) {
			$this->view->redirect('admin/tasks');
		}
		if (!empty($this->request->post)) {
			if (!$this->loginValidate($this->request->post)) {
				$this->view->message('error', $this->error);
			}
			$this->request->session['admin'] = true;
			$this->view->location('admin/edit');
		}
		$this->view->render('Вход');
	}

	public function editAction() {
//
	}

	public function deleteAction() {
//
	}

	public function logoutAction() {
		unset($this->request->session['admin']);
		$this->view->redirect('admin/login');
	}

}