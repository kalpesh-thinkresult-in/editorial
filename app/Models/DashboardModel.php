<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    public function getPageData()
    {
        date_default_timezone_set('Asia/Kolkata');

        $db = db_connect();

        //todays total english news count
        $engtodaycount = $db->query("select count(id) as newscount from news where lang ='eng' and DATE(createdon) = '" . date("Y-m-d") . "';")->getRow();

        //total english news count
        $engtotalcount = $db->query("select count(id) as newscount from news where lang ='eng';")->getRow();

        //todays total hindi news count
        $hinditodaycount = $db->query("select count(id) as newscount from news where lang ='hindi' and DATE(createdon) = '" . date("Y-m-d") . "';")->getRow();

        //total hindi news count
        $hinditotalcount = $db->query("select count(id) as newscount from news where lang ='hindi';")->getRow();

        //client category wise news count - Todays News and Total News
        $sql = "";
        $sql = "SELECT 
            cl.id as 'clientid' ,
            cl.clientname,
            cl.baseurl,
            cm.id as 'cateid',
            cm.category,
            cm.parent_cate_id,
            (select count(id) from news as nwt where concat(',',nwt.categories) like concat('%,',cm.id,',%') and DATE(nwt.createdon) = '" . date("Y-m-d") . "') as Todaynews,
        (select count(id) from news as nw where concat(',',nw.categories) like concat('%,',cm.id,',%')) as Totalnews
        FROM
            clientmaster as cl
            left join categorymaster as cm on cm.clientid = cl.id
        
        ";
        $catenwesrecord = $db->query($sql)->getResult();

        $db->close();

        $rtnarray = [
            "engtodaycount" => $engtodaycount->newscount,
            "engallcount" => $engtotalcount->newscount,
            "hinditodaycount" => $hinditodaycount->newscount,
            "hindiallcount" => $hinditotalcount->newscount,
            "clientcatewisecount" => $catenwesrecord
        ];

        return $rtnarray;
    }


}