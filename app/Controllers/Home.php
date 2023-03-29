<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (isset($_SESSION["loggedin"])) {
            if ($_SESSION["loggedin"] != "true") {
                $this->response->redirect(base_url('/login'));
            } else {
                $this->response->redirect(base_url('/dashboard'));
            }
        } else {
            $this->response->redirect(base_url('/dashboard'));
        }

    }
}