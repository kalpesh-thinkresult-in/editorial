<?php

namespace App\Models;

use CodeIgniter\Model;

class SysAdminModel extends Model
{

    // ================================================ Roles ====================================================
    public function getRoles()
    {
        $rtndata = null;
        $db = db_connect();
        $query = $db->query("select id, role, description from rolemaster where isactive=1 and id !=1");
        $rtndata = $query->getResult();
        $db->close();

        return $rtndata;
    }

    public function saveRole($data)
    {
        //$db->escape($title) 
        $result = null;
        $db = db_connect();
        if ($data["txthdn"] == -1) {
            $data = [
                'role' => $data["txtrole"],
                'description' => $data["txtdesc"],
                'isactive' => 1,
                'createdby' => $_SESSION["userinfo"]->id,
                'createdon' => date("Y-m-d")
            ];
            $result = $this->db
                ->table('rolemaster')
                ->insert($data);
            $db->close();
        } else {
            $id = $data["txthdn"];
            $data = [
                'role' => $data["txtrole"],
                'description' => $data["txtdesc"],
                'isactive' => 1,
                'modifiedby' => $_SESSION["userinfo"]->id,
                'modifiedon' => date("Y-m-d")
            ];
            $result = $this->db
                ->table('rolemaster')
                ->where(["id" => $id])
                ->set($data)
                ->update();
        }
        return $result;
    }

    public function deleteRole($id)
    {
        $data = [
            'isactive' => 0,
            'modifiedby' => $_SESSION["userinfo"]->id,
            'modifiedon' => date("Y-m-d")
        ];
        $result = $this->db
            ->table('rolemaster')
            ->where(["id" => $id])
            ->set($data)
            ->update();
    }

    // ================================================ Users ====================================================
    public function getUsers()
    {
        $rtndata = null;
        $db = db_connect();
        $query = $db->query("select u.*, r.role from users as u left join rolemaster as r on r.id = u.roleid
        where u.isactive=1 and u.id !=1");
        $rtndata = $query->getResult();
        $db->close();

        return $rtndata;
    }
    public function saveUser($data)
    {
        //$db->escape($title) 
        $result = null;
        $db = db_connect();
        if ($data["txthdn"] == -1) {
            $data = [
                'fullname' => $data["txtname"],
                'email' => $data["txtemail"],
                'password' => md5($data["txtpassword"]),
                'roleid' => $data["selrole"],
                'isactive' => 1,
                'createdby' => $_SESSION["userinfo"]->id,
                'createdon' => date("Y-m-d")
            ];
            $result = $this->db
                ->table('users')
                ->insert($data);
            $db->close();
        } else {
            $id = $data["txthdn"];
            $data = [
                'fullname' => $data["txtname"],
                'email' => $data["txtemail"],
                'roleid' => $data["selrole"],
                'isactive' => 1,
                'modifiedby' => $_SESSION["userinfo"]->id,
                'modifiedon' => date("Y-m-d")
            ];
            $result = $this->db
                ->table('users')
                ->where(["id" => $id])
                ->set($data)
                ->update();
        }
        return $result;
    }
    public function deleteUser($id)
    {
        $data = [
            'isactive' => 0,
            'modifiedby' => $_SESSION["userinfo"]->id,
            'modifiedon' => date("Y-m-d")
        ];
        $result = $this->db
            ->table('users')
            ->where(["id" => $id])
            ->set($data)
            ->update();
    }

    // ============================================ Role Access ===================================================
    public function getRoleAccess()
    {
        $rtndata = null;
        $db = db_connect();
        $query = $db->query("select * from rolemenu_mapping where isactive = 1");
        $rtndata = $query->getResult();
        $db->close();

        return $rtndata;
    }

    public function updataRoleAccess($data)
    {
        $db = db_connect();
        $result = 0;
        $this->db
            ->table('rolemenu_mapping')
            ->where(["roleid" => $data["roleid"]])
            ->delete();

        foreach ($data["data"] as $item) {
            $item['createdby'] = $_SESSION["userinfo"]->id;
            $item['createdon'] = date("Y-m-d");
            $result = $this->db
                ->table('rolemenu_mapping')
                ->insert($item);
        }
        $db->close();
        return $result;
    }
}