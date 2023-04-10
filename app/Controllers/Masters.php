<?php

namespace App\Controllers;

class Masters extends BaseController
{
    // ===================================== Clients =========================================================
    public function client()
    {
        $model = new \App\Models\MastersModel();
        $data['msg'] = "";
        if ($_POST) {
            if ($model->saveClient($_POST) == 1) {
                $data['msg'] = "Client saved successfully !!!";
            }
        }
        $result = $model->getClients();
        $data['records'] = $result;
        $data['datatable'] = json_encode($result);
        return view('dashboard/client', $data);
    }
    public function deleteclient($id)
    {
        $model = new \App\Models\MastersModel();
        $model->deleteClient($id);
        $this->response->redirect(base_url('/masters/client'));
    }

    // ===================================== Categories =========================================================
    public function cate()
    {
        $model = new \App\Models\MastersModel();
        $result = $model->getClientCategoriesSummary();
        $categories = $model->getCategories();
        $data['records'] = $result;
        $data['datatable'] = json_encode($result);
        $data['categories'] = json_encode($categories);
        return view('dashboard/cate', $data);
    }
    public function savecate()
    {
        $model = new \App\Models\MastersModel();
        $result = $model->saveCate($_POST);
        $categories = $model->getCategories();
        return json_encode($categories);
    }

    public function movecate()
    {
        $model = new \App\Models\MastersModel();
        $model->moveCate($_POST);
        $categories = $model->getCategories();
        return json_encode($categories);
        //return json_encode($_POST);
    }
    public function deletecate()
    {
        $model = new \App\Models\MastersModel();
        $model->deleteCate($_POST["id"]);
        $categories = $model->getCategories();
        return json_encode($categories);
    }

    // ===================================== Tags =========================================================
    public function tags()
    {
        $model = new \App\Models\MastersModel();
        $data['msg'] = "";
        if ($_POST) {
            if ($model->saveTag($_POST) == 1) {
                $data['msg'] = "Tag saved successfully !!!";
            }
        }
        $result = $model->getTags();
        $data['records'] = $result;
        $data['datatable'] = json_encode($result);
        return view('dashboard/tags', $data);
    }
    public function deletetag($id)
    {
        $model = new \App\Models\MastersModel();
        $model->deleteTag($id);
        $this->response->redirect(base_url('/masters/tags'));
    }

    // ============================================== companycode ====================================================    
    public function keywords()
    {
        $model = new \App\Models\MastersModel();
        $data['msg'] = "";
        if ($_POST) {
            if ($model->saveCompanyCode($_POST) == 1) {
                $data['msg'] = "saved successfully !!!";
            }
        }
        $result = $model->getCompanyCode();
        $data['records'] = $result;
        $data['datatable'] = json_encode($result);
        return view('dashboard/keywords', $data);
    }
    public function deletekeyword($id)
    {
        $model = new \App\Models\MastersModel();
        $model->deleteCompanyCode($id);
        $this->response->redirect(base_url('/masters/keywords'));
    }
}