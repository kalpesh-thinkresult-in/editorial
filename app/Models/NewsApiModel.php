<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsApiModel extends Model
{

    public function getNewsLatest($lang, $cates, $page, $count)
    {
        $rtndata = null;
        if (!empty($cates)) {
            $cateids = str_replace(";", ",", $cates);
            $sql = "SELECT 
                        DISTINCT n.* 
                    FROM categorymaster AS cm 
                    INNER JOIN News AS n ON FIND_IN_SET(cm.id,n.categories)
                    WHERE FIND_IN_SET(cm.id,'$cateids') OR FIND_IN_SET(cm.parent_cate_id,'$cateids')
                    ORDER BY n.createdon DESC LIMIT $page, $count";
        } else {
            $sql = "SELECT 
                        DISTINCT n.* 
                    FROM News AS n 
                    WHERE n.lang='$lang'
                    ORDER BY n.createdon DESC LIMIT $page, $count";
        }

        $db = db_connect();
        $query = $db->query($sql);
        $rtndata = $query->getResult();
        $db->close();

        return $rtndata;
    }

    public function getNewsDetails($slug = "")
    {
        $rtndata = [];
        $db = db_connect();
        $query = $db->query("SELECT * FROM news WHERE slug='$slug'");
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