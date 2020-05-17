<?php

namespace application\controllers;

use application\core\Controller;
use application\core\View;

use application\lib\Pagination;
use application\lib\Isbn;

class AjaxController extends Controller {

	public function __construct($route) {
		parent::__construct($route);

		$this->model = $this->loadModel($route['controller']);

		$this->view = new View($route);
		$this->view->layout = 'ajax';
	}

	public function indexAction() {
		$this->view->render();
	}

	public function pagesAction() {
		$sort = 'id'; 
		$order = 'ASC';
                $page = 0;

		$pagination = new Pagination($this->route, $this->model->booksCount());

		$list = $this->model->booksList($this->route, $sort, $order);
		$list = $this->searchIsbn($list);
		$list = $this->model->booksList($this->route, $sort, $order);

		$vars = [
			'pagination' => $pagination->get(),
			'list' => $list,
		];

		$this->view->render('books', $vars);
	}

	public function searchIsbn($list) {
		$isbn = new Isbn();

		foreach ($list as $value) {
			if ($value['log']!='') continue;

			$arr_isbn = $isbn->getIsbn($value['description_ru']);
			if ($arr_isbn) {
				$isbn_num1 = $isbn_num2 = $isbn_num3 = '';
			        $isbn_num4 = array();

				if ($value['isbn']!='')
					$isbn_num1 = $isbn->cleanIsbn($value['isbn']);
				if ($value['isbn2']!='')
					$isbn_num2 = $isbn->cleanIsbn($value['isbn2']);
				if ($value['isbn3']!='')
					$isbn_num3 = $isbn->cleanIsbn($value['isbn3']);

				if ($value['isbn4']!='') {
					$isbn_num4_arr = explode(",", $value['isbn4']);
					foreach ($isbn_num4_arr as $num4_arr)
						$isbn_num4[] = $isbn->cleanIsbn($num4_arr);
				}

				foreach ($arr_isbn as $new_isbn) {
					$log = '';
					$log = $isbn->addLog($log, 'new '.$new_isbn);

					$isbn_num = $isbn->cleanIsbn($new_isbn);
					$isbn_len = strlen($isbn_num);

					if ($isbn_len==13)
						$res = $isbn->isValidIsbn13($isbn_num);
					else
						$res = $isbn->isValidIsbn10($isbn_num);

					if (!$res) {
						$log = $isbn->addLog($log, 'wrong');
						if ($value['isbn_wrong']='')
							$this->model->updateField($value['id'], 'isbn_wrong', $new_isbn);
						else
							$this->model->updateField($value['id'], 'isbn_wrong', $value['isbn_wrong'].",".$new_isbn);
						continue;
					}

//					if ($isbn_num1!=$isbn_num)
//						$log = $isbn->addLog($log, 'no isbn');

					if ($isbn_num2!=$isbn_num) {
						$log = $isbn->addLog($log, 'add isbn2');
						if ($isbn_num2=='' && $res)
							$this->model->updateField($value['id'], 'isbn2', $new_isbn);
					}

					if ($isbn_num3!=$isbn_num) {
						$log = $isbn->addLog($log, 'add isbn3');
						if ($isbn_num3=='' && $res)
							$this->model->updateField($value['id'], 'isbn3', $new_isbn);
					}

					$search4 = false;
					if (count($isbn_num4)>0) {
						foreach ($isbn_num4 as $num4)
						{				
							if ($num4==$isbn_num)
								$search4=true;
						}						
					}

					if (!$search4 && $res) {
						$log = $isbn->addLog($log, 'add isbn4');
						if ($value['isbn4']=='')
							$this->model->updateField($value['id'], 'isbn4', $new_isbn);
						else
							$this->model->updateField($value['id'], 'isbn4', $value['isbn4'].",".$new_isbn);
					}

					if ($log!='')
					{
						if ($value['log']!='')
							$value['log'] .= ".".$log;
						else
							$value['log'] = $log;
						$this->model->updateField($value['id'], 'log', $value['log']);
					}
				}
			}
		}
	}

}