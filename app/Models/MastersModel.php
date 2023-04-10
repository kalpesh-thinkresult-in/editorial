<?php

namespace App\Models;

use CodeIgniter\Model;

class MastersModel extends Model
{

    // ============================================== Client ====================================================
    public function getClients()
    {
        $rtndata = null;
        $db = db_connect();
        $query = $db->query("SELECT * FROM clientmaster WHERE isactive=1");
        $rtndata = $query->getResult();
        $db->close();

        return $rtndata;
    }

    public function saveClient($data)
    {
        //$db->escape($title) 
        $result = null;
        $db = db_connect();
        if ($data["txthdn"] == -1) {
            $data = [
                'guid' => $data["txtguid"],
                'clientname' => $data["txtclient"],
                'baseurl' => $data["txturl"],
                'isactive' => 1,
                'createdby' => $_SESSION["userinfo"]->id,
                'createdon' => date("Y-m-d")
            ];
            $result = $this->db
                ->table('clientmaster')
                ->insert($data);
            $db->close();
        } else {
            $id = $data["txthdn"];
            $data = [
                'clientname' => $data["txtclient"],
                'baseurl' => $data["txturl"],
                'isactive' => 1,
                'modifiedby' => $_SESSION["userinfo"]->id,
                'modifiedon' => date("Y-m-d")
            ];
            $result = $this->db
                ->table('clientmaster')
                ->where(["id" => $id])
                ->set($data)
                ->update();
        }
        return $result;
    }

    public function deleteClient($id)
    {
        $data = [
            'isactive' => 0,
            'modifiedby' => $_SESSION["userinfo"]->id,
            'modifiedon' => date("Y-m-d")
        ];
        $result = $this->db
            ->table('clientmaster')
            ->where(["id" => $id])
            ->set($data)
            ->update();
    }


    // ============================================== Category ====================================================
    public function getClientCategoriesSummary()
    {
        $rtndata = null;
        $db = db_connect();
        $query = $db->query("        
            SELECT 
                clientmaster.id, clientmaster.clientname, clientmaster.baseurl,
                (select count(cme.id) from categorymaster as cme where cme.clientid = clientmaster.id and cme.isactive=1 and cme.lang='eng') as 'engcount',
                (select count(cmh.id) from categorymaster as cmh where cmh.clientid = clientmaster.id and cmh.isactive=1 and cmh.lang='hindi') as 'hndcount'		
            FROM 
                clientmaster
            where
                clientmaster.isactive=1
        ");
        $rtndata = $query->getResult();
        $db->close();

        return $rtndata;
    }
    public function getCategories()
    {
        $rtndata = null;
        $db = db_connect();
        $query = $db->query("SELECT * FROM categorymaster where isactive=1 order by parent_cate_id, category ASC");
        $rtndata = $query->getResult();
        $db->close();

        return $rtndata;
    }

    public function getMenuCategories()
    {
        $sql = "SELECT tbl.id, tbl.guid, tbl.clientid, concat(cln.clientname,' --> ',menu) as menu FROM (select tp1.id, tp1.guid, tp1.clientid, tp1.category as 'menu' FROM 
        categorymaster as tp1
        where parent_cate_id = 0
        UNION
        SELECT ct.id, ct.guid, ct.clientid, concat(ctl.category,' --> ',ct.category) as'menu' FROM 
        categorymaster as ct
        left join categorymaster as ctl on ctl.id = ct.parent_cate_id) 
        as tbl
        left join clientmaster as cln on cln.id = tbl.clientid
        where tbl.menu is not null
        order by cln.clientname, menu";

        $rtndata = null;
        $db = db_connect();
        $query = $db->query($sql);
        $rtndata = $query->getResult();
        $db->close();

        return $rtndata;
    }

    public function saveCate($data)
    {
        $result = null;
        $db = db_connect();
        $id = $data["id"];
        if ($id == -1) {
            $dbdata = [
                'clientid' => $data["clientid"],
                'guid' => $data["guid"],
                'category' => $data["category"],
                'lang' => $data["lang"],
                'parent_cate_id' => ($data["parentid"] < 0) ? 0 : $data["parentid"],
                'createdby' => $_SESSION["userinfo"]->id,
                'createdon' => date("Y-m-d")
            ];
            $result = $this->db
                ->table('categorymaster')
                ->insert($dbdata);

            $db->close();
        } else {
            $dbdata = [
                'clientid' => $data["clientid"],
                'category' => $data["category"],
                'lang' => $data["lang"],
                'parent_cate_id' => ($data["parentid"] < 0) ? 0 : $data["parentid"],
                'modifiedby' => $_SESSION["userinfo"]->id,
                'modifiedon' => date("Y-m-d")
            ];
            $result = $this->db
                ->table('categorymaster')
                ->where(["id" => $id])
                ->set($dbdata)
                ->update();
        }
        return $result;
    }
    public function moveCate($post)
    {
        $data = [
            'parent_cate_id' => ($post["parentid"] < 0) ? 0 : $post["parentid"],
            'modifiedby' => $_SESSION["userinfo"]->id,
            'modifiedon' => date("Y-m-d")
        ];
        $result = $this->db
            ->table('categorymaster')
            ->where(["clientid" => $post["clientid"]])
            ->where(["parent_cate_id" => $post["cateid"]])
            ->set($data)
            ->update();

        return $result;
    }
    public function deleteCate($id)
    {
        $data = [
            'isactive' => 0,
            'modifiedby' => $_SESSION["userinfo"]->id,
            'modifiedon' => date("Y-m-d")
        ];
        $result = $this->db
            ->table('categorymaster')
            ->where(["id" => $id])
            ->set($data)
            ->update();

        return $result;
    }

    // ============================================== Tags ====================================================    

    public function getTags()
    {
        $rtndata = null;
        $db = db_connect();
        $query = $db->query("SELECT * FROM tagmaster where isactive=1 order by tag ASC");
        $rtndata = $query->getResult();
        $db->close();

        return $rtndata;
    }
    public function saveTag($data)
    {
        //$db->escape($title) 
        $result = null;
        $db = db_connect();
        if ($data["txthdn"] == -1) {
            $data = [
                'tag' => $data["txttag"],
                'isactive' => 1,
                'createdby' => $_SESSION["userinfo"]->id,
                'createdon' => date("Y-m-d")
            ];
            $result = $this->db
                ->table('tagmaster')
                ->insert($data);
            $db->close();
        } else {
            $id = $data["txthdn"];
            $data = [
                'tag' => $data["txttag"],
                'isactive' => 1,
                'modifiedby' => $_SESSION["userinfo"]->id,
                'modifiedon' => date("Y-m-d")
            ];
            $result = $this->db
                ->table('tagmaster')
                ->where(["id" => $id])
                ->set($data)
                ->update();
        }
        return $result;
    }
    public function deleteTag($id)
    {
        $data = [
            'isactive' => 0,
            'modifiedby' => $_SESSION["userinfo"]->id,
            'modifiedon' => date("Y-m-d")
        ];
        $result = $this->db
            ->table('tagmaster')
            ->where(["id" => $id])
            ->set($data)
            ->update();

        return $result;
    }

    // ============================================== companycode ====================================================    

    public function getCompanyCode()
    {
        $rtndata = null;
        $db = db_connect();
        $query = $db->query("SELECT * FROM companycode where isactive=1 order by company ASC");
        $rtndata = $query->getResult();
        $db->close();

        return $rtndata;
    }

    public function getCompanyKeywords()
    {
        $rtndata = null;
        $db = db_connect();
        $query = $db->query("SELECT cc.id, cc.company,cc.stockcode, ck.keyword FROM companykeywords as ck 
                            left join companycode as cc on cc.id=ck.companyid where cc.isactive = 1 order by ck.keyword desc");
        $rtndata = $query->getResult();
        $db->close();

        return $rtndata;
    }
    public function saveCompanyCode($data)
    {
        //$db->escape($title) 
        $result = null;
        $id = $data["txthdn"];

        $db = db_connect();
        if ($data["txthdn"] == -1) {
            $idata = [
                'company' => $data["txtcompany"],
                'keywords' => $data["txtkeywords"],
                'stockcode' => $data["txtstockcode"],
                'isactive' => 1,
                'createdby' => $_SESSION["userinfo"]->id,
                'createdon' => date("Y-m-d")
            ];
            $result = $this->db
                ->table('companycode')
                ->insert($idata);

            $id = $db->insertID();
            $db->close();
        } else {
            $udata = [
                'company' => $data["txtcompany"],
                'keywords' => $data["txtkeywords"],
                'stockcode' => $data["txtstockcode"],
                'isactive' => 1,
                'modifiedby' => $_SESSION["userinfo"]->id,
                'modifiedon' => date("Y-m-d")
            ];
            $result = $this->db
                ->table('companycode')
                ->where(["id" => $id])
                ->set($udata)
                ->update();
        }

        // adding keywords
        $this->db->table('companykeywords')->where(["companyid" => $id])->delete();
        if (!empty($data["txtkeywords"])) {
            $keywords = explode(";", $data["txtkeywords"]);
            if (!empty($keywords)) {
                foreach ($keywords as $keyword) {
                    if (!empty(trim($keyword, " "))) {
                        $kdata = [
                            'companyid' => $id,
                            'keyword' => rtrim(ltrim(trim($keyword, "; "), " "), " ")
                        ];
                        $result = $this->db
                            ->table('companykeywords')
                            ->insert($kdata);
                    }
                }
            }
        }
        return $result;
    }
    public function deleteCompanyCode($id)
    {
        $data = [
            'isactive' => 0,
            'modifiedby' => $_SESSION["userinfo"]->id,
            'modifiedon' => date("Y-m-d")
        ];
        $result = $this->db
            ->table('companycode')
            ->where(["id" => $id])
            ->set($data)
            ->update();

        return $result;
    }
}