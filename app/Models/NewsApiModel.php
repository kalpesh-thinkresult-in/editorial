<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsApiModel extends Model
{

    public function validateClient()
    {
        $key = $_SERVER['HTTP_HOST'];

        $db = db_connect();
        $client = $db->query("SELECT * FROM clientmaster 
                            WHERE CONCAT('/',baseurl) like '%/$key%' 
                            OR CONCAT('.',baseurl) like '%.$key%'")->getRow();

        $db->close();
        if (empty($client)) {
            return false;
        }
        return true;
    }
    public function getNewsList($lang, $cates, $page, $count, $priority)
    {
        $rtndata = null;
        if ($cates != "default") {
            $cateids = str_replace(";", ",", $cates);
            $sql = "SELECT 
                        DISTINCT n.* 
                    FROM categorymaster AS cm 
                    INNER JOIN news AS n ON FIND_IN_SET(cm.id,n.categories)
                    WHERE (FIND_IN_SET(cm.id,'$cateids') OR FIND_IN_SET(cm.parent_cate_id,'$cateids'))
                    AND n.priority = $priority
                    ORDER BY n.createdon DESC LIMIT $page, $count";
        } else {
            $sql = "SELECT 
                        DISTINCT n.* 
                    FROM news AS n 
                    WHERE n.lang='$lang' AND n.priority = $priority
                    ORDER BY n.createdon DESC LIMIT $page, $count";
        }

        $db = db_connect();
        $query = $db->query($sql);
        $rtndata = $query->getResult();
        $db->close();

        return $rtndata;
    }

    public function getNewsDetails($id = "")
    {
        $rtndata = [];
        $db = db_connect();
        $query = $db->query("SELECT * FROM news WHERE id= $id");
        $rtndata = $query->getRow();
        $db->close();
        //updating pageHit
        $this->updatePageHit($rtndata->id, $rtndata->pagehits);
        return $rtndata;
    }

    public function getNewsByKeywords($lang, $keywords, $page, $count)
    {
        $rtndata = [];
        $db = db_connect();
        $keywordsstring = "(";

        if (!empty($keywords)) {
            $keys = explode(";", $keywords);
            $or = "";
            foreach ($keys as $key) {
                if (!empty($key)) {
                    $keywordsstring .= $or . " CONCAT(',',hashtags,',') like '%,$key,%'";
                    $or = " or";
                }
            }
            $keywordsstring .= ")";
        }
        $query = $db->query("SELECT * FROM news WHERE lang='$lang' AND $keywordsstring ORDER BY createdon DESC LIMIT $page, $count");
        $rtndata = $query->getResult();
        $db->close();
        return $rtndata;

    }
    public function getNewsByStockCodes($lang, $stockcodes, $page, $count)
    {
        $rtndata = [];
        $db = db_connect();
        $stockcodestring = "(";

        if (!empty($stockcodes)) {
            $keys = explode(";", $stockcodes);
            $or = "";
            foreach ($keys as $key) {
                if (!empty($key)) {
                    $stockcodestring .= $or . " CONCAT(',',stockcodes,',') like '%,$key,%'";
                    $or = " or";
                }
            }
            $stockcodestring .= ")";
        }
        $query = $db->query("SELECT * FROM news WHERE lang='$lang' AND $stockcodestring ORDER BY createdon DESC LIMIT $page, $count");
        $rtndata = $query->getResult();
        $db->close();
        return $rtndata;

    }

    //===============================================================================================
//============================= Protected Functions =============================================
//===============================================================================================

    public function updatePageHit($id, $curhit)
    {
        try {
            $db = db_connect();
            $this->db->table("news")->where(["id" => $id])->set(["pagehits" => $curhit + 1])->update();
            $db->close();
        } catch (\Exception $e) {

        }
    }

}