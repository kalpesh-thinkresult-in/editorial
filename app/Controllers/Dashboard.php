<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    protected $model;
    public function __construct()
    {
        $this->model = new \App\Models\DashboardModel();
    }
    public function index()
    {
        $data = $this->model->getPageData();
        // echo "<pre>";
        // print_r($data);
        // die;
        return view('dashboard/dashboard', $data);
    }
}