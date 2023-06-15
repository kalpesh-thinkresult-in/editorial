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

        return view('dashboard/dashboard', $data);
    }
}