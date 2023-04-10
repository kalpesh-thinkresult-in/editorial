<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{

    public function getNewsListPage($lang = "eng")
    {
        $rtndata = null;
        $db = db_connect();
        $query = $db->query("select * from news where isactive=1 and lang='$lang' order by createdon DESC");
        $rtndata = $query->getResult();
        $db->close();

        return $rtndata;
    }

    public function getNewsDetails($id = -1)
    {
        $rtndata = null;
        $db = db_connect();

        //news header
        $query = $db->query("select * from news where id=$id");
        $header = $query->getRow();


        //preparing return data
        $rtndata = $header;



        $db->close();

        return $rtndata;
    }


    public function saveNewsInfo($data = null, $files = null)
    {
        $id = -1;
        if (!empty($data)) {
            $id = $data["hdnid"]; // set actual id later

            //setting up data
            $dbdata = [
                'lang' => $data["hdnlang"],
                'heading' => $data["txttitle"],
                'slug' => $data["txtslug"],
                'news' => $this->addCompanyCodeLink($data["newsdescription"]),
                'source' => $data["txtsource"],
                'author' => "",
                'imagetitle' => $data["txtimagetitle"],
                'videolink' => $data["txtvideolink"],
                'showinrss' => (isset($data["chkshowrss"])) ? 1 : 0,
                'priority' => $data["priority"],
            ];

            //setting up categories
            if (!empty($data["selcategory"])) {
                $cates = "";
                foreach ($data["selcategory"] as $cate) {
                    $cates .= $cate . ",";
                }
                $dbdata['categories'] = $cates;
            }

            //setting up image url
            if (isset($files['txtimageurl'])) {
                if (isset($files['txtimageurl']['name'])) {
                    if (!empty($files['txtimageurl']['name'])) {
                        $file = $this->uploadfile($files['txtimageurl']['name'], $files['txtimageurl']['tmp_name']);
                        $dbdata['imageurl'] = base_url($file);
                    }
                }
            }

            //setting up hastags
            if (!empty($data["tags"])) {
                $tags = "";
                foreach ($data["tags"] as $tag) {
                    $tags .= $tag . ",";
                }
                $dbdata['hashtags'] = $tags;
            }
            //setting up stockcodes
            if (!empty($data["sockcode"])) {
                $stockcodes = "";
                foreach ($data["sockcode"] as $stockcode) {
                    $stockcodes .= $stockcode . ",";
                }
                $dbdata['stockcodes'] = $stockcodes;
            }

            //database operation
            date_default_timezone_set('Asia/Kolkata');
            if (empty($data["hdnid"])) {
                //Insert
                $dbdata['createdby'] = $_SESSION["userinfo"]->id;
                $dbdata['createdon'] = date("Y-m-d h:i:sa");
                $db = db_connect();
                $result = $this->db
                    ->table('news')
                    ->insert($dbdata);

                $id = $db->insertID();
                $db->close();

            } else {
                //Update
                $dbdata['modifiedby'] = $_SESSION["userinfo"]->id;
                $dbdata['modifiedon'] = date("Y-m-d h:i:sa");
                $db = db_connect();
                $result = $this->db
                    ->table('news')
                    ->where(["id" => $id])
                    ->set($dbdata)
                    ->update();
                $db->close();
            }

            //update Tag master
            $this->updateTagMaster($data["tags"]);
        }
        // adding category mapping to database
        //deleteting existing
        // $this->db->table('newscategory_mapping')->where(["newsid" => $id])->delete();
        // if (!empty($data["selcategory"])) {
        //     //newscategory_mapping
        //     $cates = "";
        //     $db = db_connect();
        //     foreach ($data["selcategory"] as $cate) {
        //         $cates .= $cate . ",";
        //         $cdata = [
        //             'categoryid' => $cate,
        //             'newsid' => $id,
        //             'createdby' => $_SESSION["userinfo"]->id,
        //             'createdon' => date("Y-m-d")
        //         ];
        //         $result = $this->db
        //             ->table('newscategory_mapping')
        //             ->insert($cdata);
        //     }
        //     //updating categories
        //     $dbcate['categories'] = $cates;
        //     $db = db_connect();
        //     $result = $this->db
        //         ->table('news')
        //         ->where(["id" => $id])
        //         ->set($dbcate)
        //         ->update();
        //     $db->close();
        // }
        return $id;
    }

    protected function updateTagMaster($tags)
    {
        if (!empty($tags)) {
            $db = db_connect();
            $model = new \App\Models\MastersModel();
            foreach ($tags as $tag) {
                $row = $db->query("SELECT * FROM tagmaster where tag='$tag' order by tag ASC")->getRow();
                if (empty($row)) {
                    $data["txthdn"] = -1;
                    $data["txttag"] = $tag;
                    $model->saveTag($data);
                }
            }
            $db->close();
        }
    }

    protected function addCompanyCodeLink($recdesc)
    {
        $mastermodel = new \App\Models\MastersModel();
        $keywords = $mastermodel->getCompanyKeywords();
        if (!empty($keywords)) {
            foreach ($keywords as $kitem) {
                $pos = strpos(strtolower($recdesc), strtolower($kitem->keyword));
                if (!empty($pos)) {
                    $start = ($pos == 0) ? 0 : $pos - 1;
                    if (substr($kitem->keyword, $start, 1) != "#") {
                        $anchor = '<a href="' . base_url("webgeneral/stockpage/") . $kitem->stockcode . '" target="_blank">' .
                            $kitem->keyword . '</a>';
                        $recdesc = str_replace(strtolower($kitem->keyword), $anchor, strtolower($recdesc));
                    }
                }
            }
        }
        return $recdesc;
    }

    public function getMenuCategoriesByNews($id = 0, $lang = "eng")
    {
        // $sql = "Select 
        //             tbl.id, tbl.guid, tbl.lang, cmp.id as newsid, tbl.clientid, concat(cln.clientname,' --> ',menu) as menu 
        //         from (
        //                 select 
        //                     tp1.id, tp1.lang, tp1.guid, tp1.clientid, tp1.category as 'menu' 
        //                 from 
        //                     categorymaster as tp1
        //                     where parent_cate_id = 0
        //                 UNION
        //                 SELECT 
        //                     ct.id, ct.lang, ct.guid, ct.clientid, concat(ctl.category,' --> ',ct.category) as'menu' 
        //                 FROM 
        //                     categorymaster as ct
        //                     left join categorymaster as ctl on ctl.id = ct.parent_cate_id
        //             ) as tbl
        //                 left join clientmaster as cln on cln.id = tbl.clientid
        //                 left join newscategory_mapping cmp on cmp.categoryid = tbl.id and cmp.newsid = $id
        //             where 
        //                 tbl.menu is not null  and tbl.lang='$lang'

        //             order by cln.clientname, menu";
        $sql = "
                Select 
                    tbl.id, tbl.guid, tbl.lang, cmp.id as newsid, tbl.clientid, concat(cln.clientname,'-',menu) as menu 
                from (
                        select 
                            tp1.id, tp1.lang, tp1.guid, tp1.clientid, tp1.category as 'menu' 
                        from 
                            categorymaster as tp1
                            where parent_cate_id = 0
                        UNION
                        SELECT 
                            ct.id, ct.lang, ct.guid, ct.clientid, concat(ctl.category,'-',ct.category) as'menu' 
                        FROM 
                            categorymaster as ct
                            left join categorymaster as ctl on ctl.id = ct.parent_cate_id
                    ) as tbl
                        left join clientmaster as cln on cln.id = tbl.clientid
                        left join (
                        	select categorymaster.* from 
                            categorymaster 
                            inner join news on find_in_set(categorymaster.id,news.categories)
                            where news.id = $id
                        ) as cmp on cmp.id = tbl.id
                    where 
                        tbl.menu is not null  and tbl.lang='$lang'
                        
                    order by cln.clientname, menu
        
        ";

        $rtndata = null;
        $db = db_connect();
        $query = $db->query($sql);
        $rtndata = $query->getResult();
        $db->close();

        return $rtndata;
    }

    public function getTagsByNews($id = 0)
    {
        $sql = "SELECT 1 as id, n.hashtags
                FROM 
                news as n
                where n.id=$id
                union ALL
                select 0 as id, GROUP_CONCAT(t.tag)as hashtags
                from
                tagmaster as t";

        $db = db_connect();
        $query = $db->query($sql);
        $result = $query->getResult();
        $ar1 = array();
        $isar1news = false;
        $ar2 = array();
        if (isset($result[0])) {
            $ar1 = explode(",", $result[0]->hashtags);
            if ($result[0]->id == 1)
                $isar1news = true;
            //array_search("bluze",$a);
            //print_r(array_merge($a1,$a2));
            //$rtndata = array_unique(explode(",", $row->hashtags));
        }
        if (isset($result[1])) {
            $ar2 = explode(",", $result[1]->hashtags);
        }

        if (!empty($ar1)) {
            if (!empty($ar2)) {
                foreach ($ar2 as $tag) {
                    //searching master tag in news tags
                    if (array_search($tag, $ar1) == "") {
                        //not found then adding with #%@ mark as master tag
                        array_push($ar1, $tag . "#%@");
                    }
                }
            } else {
                if ($isar1news == false) {
                    foreach ($ar1 as $tag) {
                        //adding with #%@ mark as master tag
                        array_push($ar2, $tag . "#%@");
                    }
                    $ar1 = array();
                    $ar1 = $ar2;
                }
            }
        }
        return $ar1;

    }

    public function getStockcodeByNews($id = 0)
    {
        $sql = "SELECT 1 as id, n.stockcodes
                FROM 
                news as n
                where n.id=$id
                union ALL
                select 0 as id, GROUP_CONCAT(t.stockcode)as stockcodes
                from
                companycode as t";

        $db = db_connect();
        $query = $db->query($sql);
        $result = $query->getResult();

        $ar1 = array();
        $isar1news = false;
        $ar2 = array();
        if (isset($result[0])) {
            $ar1 = explode(",", $result[0]->stockcodes);
            if ($result[0]->id == 1)
                $isar1news = true;
        }
        if (isset($result[1])) {
            $ar2 = explode(",", $result[1]->stockcodes);
        }

        if (!empty($ar1)) {
            if (!empty($ar2)) {
                foreach ($ar2 as $tag) {
                    //searching master tag in news tags
                    if (array_search($tag, $ar1) == "") {
                        //not found then adding with #%@ mark as master tag
                        array_push($ar1, $tag . "#%@");
                    }
                }
            } else {
                if ($isar1news == false) {
                    foreach ($ar1 as $tag) {
                        //adding with #%@ mark as master tag
                        array_push($ar2, $tag . "#%@");
                    }
                    $ar1 = array();
                    $ar1 = $ar2;
                }
            }
        }
        return $ar1;

    }

    protected function uploadfile($file, $tempfile)
    {
        $guid = bin2hex(openssl_random_pseudo_bytes(16));

        $filename = $file;
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        $target_dir = "uploads/news/";
        $target_file = $target_dir . $guid . "." . $ext;

        if (move_uploaded_file($tempfile, $target_file)) {
            return $target_file;
        } else {
            return "";
        }

    }
}