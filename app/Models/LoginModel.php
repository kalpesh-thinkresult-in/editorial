<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    public function authenticate($data)
    {
        $rtndata = "false";
        $db = db_connect();
        $query = $db->query("SELECT * FROM users WHERE email='" . $data["email"] . "' AND password ='" . md5($data["pwd"]) . "' AND isactive =1");
        $data = $query->getRow();
        if (isset($data)) {
            $_SESSION["loggedin"] = "true";
            $_SESSION["userinfo"] = $data;
            $menuaccess = $this->getMenuAccess($data->roleid, $db);
            $_SESSION["menuaccess"] = isset($menuaccess) ? $menuaccess : [];
            $rtndata = "true";
        }
        $db->close();
        return $rtndata;
    }

    protected function getMenuAccess($roleid, $db)
    {
        $query = $db->query("SELECT * FROM rolemenu_mapping WHERE roleid = $roleid AND isactive = 1");
        return $query->getResult();
    }

}