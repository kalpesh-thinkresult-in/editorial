<?php

namespace App\Controllers;

class Login extends LoginbaseController
{
    public function index()
    {
        session_destroy();
        return view('login');
    }

    public function authuser()
    {
        if ($_POST) {
            // authenticate
            $model = new \App\Models\LoginModel();
            $rtndata = $model->authenticate($_POST);
            print_r($rtndata);
        }
    }
}