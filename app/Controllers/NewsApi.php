<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class NewsApi extends ResourceController
{
    protected $model;
    protected $format = 'json';
    public function __construct()
    {
        $this->model = new \App\Models\NewsApiModel();
    }

    public function latest($lang = "eng", $cates = "", $page = 0, $count = 10)
    {
        $page = $page * $count;
        return $this->respond($this->model->getNewsLatest($lang, $cates, $page, $count));
    }

    public function news($slug = "")
    {
        return $this->respond($this->model->getNewsDetails($slug));
    }

    public function keywords($lang = "eng", $keywords = "", $page = 0, $count = 10)
    {
        $page = $page * $count;
        return $this->respond($this->model->getNewsByKeywords($lang, $keywords, $page, $count));
    }

    public function stockcodes($lang = "eng", $stockcodes = "", $page = 0, $count = 10)
    {
        $page = $page * $count;
        return $this->respond($this->model->getNewsByStockCodes($lang, $stockcodes, $page, $count));
    }

}