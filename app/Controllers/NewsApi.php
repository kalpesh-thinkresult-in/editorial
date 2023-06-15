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
        //Validate Client Access
        // if ($this->model->validateClient() == false) {
        //     echo "You don't have access to this API.";
        //     die;
        // }

    }
    /*
    =   REGULAR [category wise]         : priority number 1 //​http://investmentguru.co/NewsApi/regular/eng/1
    =   FEATURE [category wise]         : priority number 2 //​http://investmentguru.co/NewsApi/feature/eng/1
    =   LATEST [all]                    : priority number 3 //​http://investmentguru.co/NewsApi/latest/eng/default
    =   TOP [all]                       : priority number 4 //​http://investmentguru.co/NewsApi/top/eng
    =   TOP [category wise]             : priority number 4 //​http://investmentguru.co/NewsApi/top/eng/1
    =   MOST POPULAR [category wise]    : priority number 5 //​http://investmentguru.co/NewsApi/popular/eng/1
    =   RELATED [all]                   : by Hashtags       //​http://investmentguru.co/NewsApi/keywords/eng/politics
    =   STOCK CODES [all]               : by stock codes    //​http://investmentguru.co/NewsApi/stockcodes/eng/stk00123023
    =   Detailed News                   : by news id        //​http://investmentguru.co/NewsApi/news/5
    */
    public function latest($lang = "eng", $cates = "default", $page = 0, $count = 10)
    {
        $page = $page * $count;
        return $this->respond($this->model->getNewsList($lang, $cates, $page, $count, 3));
    }
    public function regular($lang = "eng", $cates = "default", $page = 0, $count = 10)
    {
        $page = $page * $count;
        return $this->respond($this->model->getNewsList($lang, $cates, $page, $count, 1));
    }
    public function feature($lang = "eng", $cates = "default", $page = 0, $count = 10)
    {
        $page = $page * $count;
        return $this->respond($this->model->getNewsList($lang, $cates, $page, $count, 2));
    }
    public function top($lang = "eng", $cates = "default", $page = 0, $count = 10)
    {
        $page = $page * $count;
        return $this->respond($this->model->getNewsList($lang, $cates, $page, $count, 4));
    }
    public function popular($lang = "eng", $cates = "default", $page = 0, $count = 10)
    {
        $page = $page * $count;
        return $this->respond($this->model->getNewsList($lang, $cates, $page, $count, 5));
    }

    public function news($id = "")
    {
        return $this->respond($this->model->getNewsDetails($id));
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