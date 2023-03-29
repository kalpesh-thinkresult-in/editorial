<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class DemoApi extends ResourceController
{
    protected $model;
    protected $format = 'json';
    public function __construct()
    {
        //$this->model = new \App\Models\NewsApiModel();
    }

    public function top()
    {
        $clasa = array(
            "0" => array('img' => 'http://localhost/pro/editorial/uploads/news/1b2f19e6efa8bebd511bb3bfe5d76991.jpg', 'title' => 'This Arunachal road blacktopped for 1st time since independence'),
            "1" => array(
                'img' => 'http://localhost/pro/editorial/uploads/news/2c65d8034f609f65f69e5dbfceb954b8.jpg',
                'title' => 'Live: Rahul Gandhi is a habitual liar, BJP hits back'
            ),
            "2" => array('img' => 'http://localhost/pro/editorial/uploads/news/3ee7029c787afe9aa3f755033b8687da.jpg', 'title' => 'Nifty down 10% from highs! Why stop loss is important in a falling market1 Hour ago'),
            "3" => array('img' => 'http://localhost/pro/editorial/uploads/news/9ad53b9f852a3a97d01016080239b46a.jpg', 'title' => 'Mind over Money: Traders must build Zen-like mindset to create wealth, says Alok Jain\'s pro tip for every trade5 Hours ago'),
            "4" => array('img' => 'http://localhost/pro/editorial/uploads/news/SJDFHK34JHK234.jpg', 'title' => 'Wall St Week Ahead-Strength in megacap stocks masks broader U.S. market woes5 Hours ago')
        );

        return $this->respond($clasa);
    }

    public function latest()
    {
        $clasa = array(
            "0" => array(
                'img' => 'http://localhost/pro/editorial/uploads/news/housing-finance-1-770x431.webp',
                'title' => 'Share of affordable homes supply across 7 cities slips to 20% last yr from 40% in 2018'
            ),
            "1" => array('img' => 'http://localhost/pro/editorial/uploads/news/pjimage-4-1-770x433.webp', 'title' => 'Rahul Gandhi\'s disqualification an \'own goal\' by BJP, says Shashi Tharoor'),
            "2" => array('img' => 'http://localhost/pro/editorial/uploads/news/prashant-kishor-770x433.webp', 'title' => 'Sentence awarded to Rahul Gandhi excessive, Centre should have shown a big heart: Prashant Kishor'),
            "3" => array('img' => 'http://localhost/pro/editorial/uploads/news/death-representative-pti-770x433.webp', 'title' => 'DGFT official in Gujarat falls to death from 4th floor after arrest by CBI in bribery case'),
            "4" => array('img' => 'http://localhost/pro/editorial/uploads/news/DSC_4272-1-770x433.avif', 'title' => 'META 2023 | Actor Sushma Seth: ‘TV and films are directors’ medium, while the stage is where the story unfolds’')
        );

        return $this->respond($clasa);
    }


}