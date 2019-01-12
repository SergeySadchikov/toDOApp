<?php
/**
 * Created by PhpStorm.
 * User: Сергий
 * Date: 05.01.2019
 * Time: 12:27
 */

namespace app\core;


class Pagination
{
    public $limit;
    public $count;
    public $route;
    public $currentPage;
    public $offset;
    public $pageCount;

    public function __construct($route, $count, $limit = 4)
    {
        $this->route = $route;
        $this->count = $count;
        $this->limit = $limit;
        $this->setCurrentPage();
        $this->setOffset();
        $this->setPageCount();
    }
    public function setCurrentPage()
    {
        $this->currentPage = !empty($this->route['page']) ? $this->route['page'] : 1;
    }
    public function setOffset()
    {
        $this->offset = ($this->currentPage * $this->limit) - $this->limit;
    }
    public function setPageCount()
    {
        if (!$this->count) {
            $this->pageCount = 1;
        } else {
            $this->pageCount = ceil($this->count / $this->limit);
        }
    }
}