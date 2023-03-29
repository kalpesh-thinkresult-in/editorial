<?php

namespace App\Models;

use CodeIgniter\Model;

class TestModel extends Model
{
    public function getNames()
    {
        $rtndata = null;
        $db = db_connect();
        $query = $db->query("select * from users");
        $rtndata = $query->getResult();
        $db->close();

        return $rtndata;
    }

    public function testCURL($url)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->request('GET', $url);
        $body = $response->getBody();
        $rtndata = null;
        if (strpos($response->header('content-type'), 'application/json') !== false) {
            $rtndata = json_decode($body);
            if (isset($rtndata[0]->Status)) {
                $rtndata = null;
            }
        }
        return $rtndata;
    }

    public function sendsms($to, $msg)
    {
        $URL = "https://www.smsidea.co.in/smsstatuswithid.aspx";
        $msg = urlencode($msg);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "mobile=9320995365&pass=VYXBX&senderid=POOPLU&to=" . $to . "&msg=" . $msg . "&restype=json");
        $content = $response = curl_exec($ch);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        $header = curl_getinfo($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $header = array();
        $header['errno'] = $err;
        $header['errmsg'] = $errmsg;
        $header['content'] = $content;


        // $response = file_get_contents("https://www.smsidea.co.in/smsstatuswithid.aspx?mobile=9320995365&pass=VYXBX&senderid=POOPLU&to=".$contacts."&msg=".$msg."&restype=json");
        $response = json_decode($response, TRUE);

        return $response;

    }
}