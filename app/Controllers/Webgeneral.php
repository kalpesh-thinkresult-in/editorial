<?php

namespace App\Controllers;

class Webgeneral extends WebBaseController
{

    public function stockpage($companycode)
    {
        $url = "https://investmentguruindia.com/Equity_StockQuotes.php?id=IGI&CompanyCode=$companycode";
        header('Location: ' . $url);
        exit;
    }
}