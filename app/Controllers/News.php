<?php

namespace App\Controllers;

use CodeIgniter\Model;

class News extends BaseController
{
    protected $model;
    public function __construct()
    {
        $this->model = new \App\Models\NewsModel();
    }
    public function list($lang = "eng")
    {
        $data['langsmall'] = $lang;
        $data['lang'] = ($lang == "eng") ? "English" : "Hindi";

        $result = $this->model->getNewsListPage($lang);
        $data['list'] = $result;
        $data['datatable'] = json_encode($result);


        // return view('dashboard/listoptions', $data);
        return view('dashboard/newslist', $data);
    }

    public function details($lang = "eng", $id = "LTE=")
    {
        $id = base64_decode($id);

        //================== Save News ==================
        if ($_POST) {
            $id = $this->model->saveNewsInfo($_POST, $_FILES);
        }
        //================== End Save  ==================


        //================== Default page data ==================
        //news header table detials
        $newsdata = $this->model->getNewsDetails($id);

        //menu categories
        $menulist = $this->model->getMenuCategoriesByNews($id, $lang);

        //keywords stock codes
        $keywords_stockcode = $this->model->getStockcodeByNews($id);

        //Tags
        $tags = $this->model->getTagsByNews($id);

        //Stockcode Company details
        $mastermodel = new \App\Models\MastersModel();
        $stockcodes = $mastermodel->getCompanyCode();

        //================== End Default page data ==================

        //================== Setting up page variables ==============
        $data['langsmall'] = $lang;
        $data['lang'] = ($lang == "eng") ? "English" : "Hindi";
        $data['newsid'] = $id;
        $data['newsdata'] = $newsdata;
        $data['menulist'] = $menulist;
        $data['ks'] = $keywords_stockcode;
        $data['tags'] = $tags;
        $data['stockcodes'] = $stockcodes;
        $data['menus'] = json_encode($menulist);

        return view('dashboard/newspage', $data);
    }



    public function test()
    {
        $mastermodel = new \App\Models\MastersModel();
        $result = $mastermodel->getMenuCategories();

        $data['list'] = $result;
        $data['menus'] = json_encode($result);
        return view('dashboard/listoptions', $data);

    }

    public function test2()
    {
        if ($_POST) {
            print_r($_POST);
        }

        //menu categories
        $menulist = $this->model->getMenuCategoriesByNews(1, "eng");

        //keywords stock codes
        $mastermodel = new \App\Models\MastersModel();
        $keywords_stockcode = $mastermodel->getKeywords(1);

        $data['menulist'] = $menulist;
        $data['ks'] = $keywords_stockcode;

        $data['menus'] = json_encode($menulist);
        return view('dashboard/multiselect', $data);

    }

    public function test3()
    {
        if ($_POST) {
            print_r($_POST);
        }

        $mastermodel = new \App\Models\MastersModel();
        $result = $mastermodel->getMenuCategories();

        $data['list'] = $result;
        $data['menus'] = json_encode($result);
        return view('dashboard/editor', $data);

    }
}