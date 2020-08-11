<?php
session_start(); 
require_once __DIR__ . '/vendor/autoload.php';

use Moovin\Job\Backend;

$account = new Backend\Account;

if($_SERVER['REQUEST_METHOD']=='POST'){

    if(isset($_POST['valorDepositoC'])){
        $valorD = ($_POST['valorDepositoC']);
        var_dump($account->setDepositCurrent($valorD));
        return $account->setDepositCurrent($valorD);
    }

    if(isset($_POST['valorDepositoP'])){
        $valorD = ($_POST['valorDepositoP']); 
        return $account->setDepositSavings($valorD);
    }

    if(isset($_POST['valorSaqueC'])){
        $valorS = ($_POST['valorSaqueC']); 
        return $account->setWithdrawCurrent($valorS);
    }
    
    if(isset($_POST['valorSaqueP'])){
        $valorS = ($_POST['valorSaqueP']); 
        return $account->setWithdrawSavings($valorS);
    }

    if(isset($_POST['valorTransferenciaC'])){
        $valorT = ($_POST['valorTransferenciaC']); 
        $tipo = ($_POST['Tipo']); 
        return $account->setTransferCurrent($valorT,$tipo);
    }
    
    if(isset($_POST['valorTransferenciaP'])){
        $valorT = ($_POST['valorTransferenciaP']); 
        $tipo = ($_POST['Tipo']); 
        return $account->setTransferSavings($valorT,$tipo);
    }
}