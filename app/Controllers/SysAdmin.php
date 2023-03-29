<?php

namespace App\Controllers;

class SysAdmin extends BaseController
{
    // ===================================== Roles =========================================================
    public function roles()
    {
        $model = new \App\Models\SysAdminModel();
        $data['msg'] = "";
        if ($_POST) {
            if ($model->saveRole($_POST) == 1) {
                $data['msg'] = "Role saved successfully !!!";
            }
        }
        $result = $model->getRoles();
        $data['records'] = $result;
        $data['datatable'] = json_encode($result);
        return view('dashboard/roles', $data);
    }
    public function deleterole($id)
    {
        $model = new \App\Models\SysAdminModel();
        $model->deleteRole($id);
        $this->response->redirect(base_url('/sysadmin/roles'));
    }

    // =================================== Users ==============================================================
    public function users()
    {
        $model = new \App\Models\SysAdminModel();
        $data['msg'] = "";
        if ($_POST) {
            if ($model->saveUser($_POST) == 1) {
                $data['msg'] = "User info saved successfully !!!";
            }
        }
        $result = $model->getUsers();
        $roles = $model->getRoles();

        $data['records'] = $result;
        $data['roles'] = $roles;
        $data['datatable'] = json_encode($result);
        return view('dashboard/users', $data);
    }
    public function deleteuser($id)
    {
        $model = new \App\Models\SysAdminModel();
        $model->deleteUser($id);
        $this->response->redirect(base_url('/sysadmin/users'));
    }

    // ================================== Role Access =============================================================
    public function roleaccess()
    {
        $model = new \App\Models\SysAdminModel();
        $data['msg'] = "";
        if ($_POST) {

        }

        $users = $model->getUsers();
        $roles = $model->getRoles();
        $roleaccess = $model->getRoleAccess();
        $data['records'] = $users;
        $data['roles'] = $roles;
        $data['datatable'] = json_encode($roleaccess);
        return view('dashboard/roleaccess', $data);
    }

    public function updateaccess()
    {
        if ($_POST) {
            $model = new \App\Models\SysAdminModel();
            $result = $model->updataRoleAccess($_POST);
            print_r($result);
        } else {
            echo "not data received";
        }
    }

}