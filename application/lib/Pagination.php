<?php

namespace application\lib;


class Pagination {
    
    private $max = 10;
    private $route;
    private $index = '';
    private $current_page = 1;
    private $total;


    public function __construct($route, $total, $max = 10) {
        $this->route = $route;
        $this->total = $total;
        $this->max = $max;
        $this->amount = $this->amount();

	if ($this->max<1)
		$this->max =1;
        $this->setCurrentPage();
    }
   
    public function get() {
        $links = null;
        $limits = $this->limits();
        $html = '<nav><ul class="pagination">';
        for ($page = $limits[0]; $page <= $limits[1]; $page++) {
            if ($page == $this->current_page) {
                $links .= '<li class="page-item active"><span class="page-link">'.$page.'</span></li>';
            } else {
                $links .= $this->generateHtml($page);
            }
        }
        if (!is_null($links)) {
            if ($this->current_page > 3) {
                $links = $this->generateHtml(1, 'Первая').$links;
            }
            if ($this->current_page < 4 && $this->amount>3) {
                $links .= $this->generateHtml(4, 'Следующая');
            }
	    elseif ($this->current_page < $this->amount) {
                $links .= $this->generateHtml($this->amount, 'Последняя');
            }
        }
        $html .= $links.' </ul></nav>';
        return $html;
    }

    private function generateHtml($page, $text = null) {
        if (!$text) {
            $text = $page;
        }
               
	if ($page == 1) $page = '';
	$sort = '';
	if (isset($this->route['sort']))
		$sort = '-'.$this->route['sort'];

	return '<li class="page-item" id="'.$page.'"><a class="page-link" href="#">'.$text.'</a></li>';	

//	$href = $this->route['controller'].'/'.$this->route['action'].$sort.'/'.$page;
//      return '<li class="page-item"><a class="page-link" href="/'.$href.'">'.$text.'</a></li>';
    }

    private function limits() {
        $left = $this->current_page - round($this->max / 2);
        $start = $left > 0 ? $left : 1;
        if ($start + $this->max <= $this->amount) {
            $end = $start > 1 ? $start + $this->max : $this->max;
        }
        else {
            $end = $this->amount;
            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
        }
        return array($start, $end);
    }

    private function setCurrentPage() {
        if (isset($this->route['page'])) {
            $currentPage = $this->route['page'];
        } else {
            $currentPage = 1;
        }
        $this->current_page = $currentPage;
        if ($this->current_page > 0) {
            if ($this->current_page > $this->amount) {
                $this->current_page = $this->amount;
            }
        } else {
            $this->current_page = 1;
        }
    }

    private function amount() {
        return ceil($this->total / $this->max);
    }
}