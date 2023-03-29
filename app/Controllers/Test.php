<?php

namespace App\Controllers;

class Test extends BaseController
{
    public function index()
    {
        //$var = "Jonh";
        //echo "ok $var";
        //echo random_string('alnum', 16);
        $text = "This text is for slug ČĆŽŠĐ÷×ß¤_.,:;-!\"#$%&/()=?*~ˇ^˘°˛`˙´˝¨¸¸¨Łł€\|@{}[] ¿ Àñdréß l'affreux ğarçon & nøël en forêt ! Andrés Cortez EFI收购Cretaprint Étienne";
        echo "text<br />$text<br />slug<br />" . slugify($text);
    }

    public function getmenucate()
    {
        $model = new \App\Models\MastersModel();
        $result = $model->getMenuCategories();

        echo "<select>";
        echo "<option value=\"-1\">Select</option>";
        foreach ($result as $item) {
            echo "<option value=\"$item->id\">$item->menu</option>";
        }
        echo "</select>";
    }

    public function jtable()
    {
        $dbmodel = new \App\Models\TestModel();
        $data = $dbmodel->getNames();
        echo json_encode($data);
    }
    public function show(string $name)
    {
        // Create a new class manually.
        $userModel = new \App\Models\TestModel();

        echo "welcome $name <br /><pre>";
        print_r($userModel->getNames());
    }

    public function showm(string $name = "default vlaue")
    {
        // Create a new class manually.
        $dbmodel = new \App\Models\DbModels\UserModel();

        echo "welcome $name <br /><pre>";
        print_r($dbmodel->findAll());
    }

    protected function displayparties()
    {
        $dbmodel = new \App\Models\DbModels\PartyModel();
        $data = $dbmodel->findAll();
        echo "<pre>";
        echo "<table border=1 cellspacing=0 cellpadding=5>";
        foreach ($data as $row) {
            echo "<tr><td>$row->partyname</td><td>$row->city</td></tr>";
        }
        echo "</table>";
    }

    public function showparty()
    {
        $this->displayparties();
    }

    public function saveparty()
    {
        $dbmodel = new \App\Models\DbModels\PartyModel();

        // Create
        $entity = new \App\Models\Entities\Party();
        $entity->name = 'Resalt';
        $entity->shahar = 'benglore';
        $entity->contact = 'suresh';
        $entity->contactnumber = '29348978998';
        $dbmodel->save($entity);


        $this->displayparties();
    }


    public function run()
    {
        $urlleft = "http://14.99.86.244/iguruapi/Market/getADRPrices";
        $urlright = "http://14.99.86.244/iguruapi/Market/getGDRPrices";

        $model = new \App\Models\TestModel();
        $rtnleft = $model->testCURL($urlleft);
        $rtnright = $model->testCURL($urlright);

        $data = [
            "left" => $rtnleft,
            "right" => $rtnright,
        ];

        echo view("compaire", $data);

    }

    public function getgainer($exh = "BSE")
    {
        $exh = strtoupper($exh);
        $model = new \App\Models\TestModel();
        $rtndata = $model->testCURL("http://14.99.86.244/iguruapi/home/getTopGainersLosers/Gainers/$exh");

        $data = [
            "exch" => $exh,
            "result" => $rtndata,
        ];
        // echo "<pre>";
        // print_r($rtndata);
        echo view("topgainer", $data);

    }

    public function sensex($exh = "BSE")
    {

        $exh = strtoupper($exh);
        $model = new \App\Models\TestModel();
        $rtndata = $model->testCURL("http://14.99.86.244/iguruapi/home/getBSENSEGraph/$exh");
        $sxdata = convertsensex($rtndata);
        // echo "<pre>";
        // print_r($rtndata);
        $data = [
            "exch" => $exh,
            "result" => $sxdata["result"],
            "open" => $sxdata["open"],
            "lastopen" => $sxdata["lastopen"],
            "lastclose" => $sxdata["lastclose"]
        ];
        //print_r($data);
        return view("testgraph", $data);

    }

    public function sendsms($to, $msg)
    {
        //$rtndata = ["to" => $to, "msg" => $msg];
        $model = new \App\Models\TestModel();
        $rtndata = $model->sendsms($to, $msg);
        print_r($rtndata);

    }

    public function insideview()
    {
        $data = [
            "header" => "Header Section",
        ];
        return view("insideview", $data);
    }
}