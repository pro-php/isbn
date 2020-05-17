<?php

namespace application\models;

use application\core\Model;


class Ajax extends Model {

	public function booksCount() {
		return $this->db->column('SELECT COUNT(id) FROM books');
	}

	public function booksList($route, $order = 'id', $sort = 'DESC', $max = 10) {
		$page = 0;
		if (isset($route['page']) && $route['page']>0) {
		    $page = $route['page']-1;
		} 

		$params = [
			'start' => ($page * $max),
			'max' => $max,
		];

		return $this->db->row("SELECT * FROM books ORDER BY $order $sort LIMIT :start, :max", $params);
	}

	public function updateField($id, $field, $value) {	
		$params = [
			'id' => $id,
			$field => $value,
		];

		$this->db->query("UPDATE books SET $field = :$field WHERE id = :id", $params);
	}
}