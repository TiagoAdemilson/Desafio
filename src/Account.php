<?php

namespace Moovin\Job\Backend;

class Account{

    public $current = 'Corrente';
    public $savings = 'Poupança';
    public $saleCurrent = 0.00;
    public $saleSavings = 0.00;

    public function getSaleCurrent(){

        if($_SESSION['saldo_corrente']!=''){

            $this->saleCurrent = $_SESSION['saldo_corrente'];
        }
        
        return $this->saleCurrent;
    }

    public function getSaleSavings(){

        if($_SESSION['saldo_poupanca']!=''){
            $this->saleSavings = $_SESSION['saldo_poupanca'];
        }

        return $this->saleSavings;
    }

    public function getCurrent(){

        return $this->current;
    }

    public function getSavings(){

        return $this->savings;
    }

    public function setTransferCurrent($transfer,$type){
        $v = str_replace('.','',$transfer);
        $transfer = str_replace(',','.',$v);
        $_SESSION['saldo_corrente'] = (number_format($_SESSION['saldo_corrente'],2) - number_format($transfer,2));
        $_SESSION['saldo_poupanca'] = (number_format($_SESSION['saldo_poupanca'],2) + number_format($transfer,2));
        $_SESSION['conta'] = 'Poupança';
        return $_SESSION;
    }

    public function setTransferSavings($transfer,$type){
        $v = str_replace('.','',$transfer);
        $transfer = str_replace(',','.',$v);
        $_SESSION['saldo_poupanca'] = (number_format($_SESSION['saldo_poupanca'],2) - number_format($transfer,2));
        $_SESSION['saldo_corrente'] = (number_format($_SESSION['saldo_corrente'],2) + number_format($transfer,2));
        $_SESSION['conta'] = 'Corrente';
        return $_SESSION;
    }

    public function setWithdrawCurrent($Withdraw){
        $_SESSION['Aviso']="";
        $v = str_replace('.','',$Withdraw);
        $Withdraw = str_replace(',','.',$v);

        if(number_format($Withdraw,2) > 600.00){
            $_SESSION['Aviso']="Seu limite de saque por vez é de 600,00";
        }else{
            $_SESSION['saldo_corrente'] = (number_format($_SESSION['saldo_corrente'],2) - number_format($Withdraw,2) - 2.50);
            $_SESSION['Aviso']="Saque Efetuado*"; 
            
        }
        return $_SESSION;
    }

    public function setWithdrawSavings($Withdraw){
        $_SESSION['Aviso']="";
        $v = str_replace('.','',$Withdraw);
        $Withdraw = str_replace(',','.',$v);

        if(number_format($Withdraw,2) > 1000.00){
            $_SESSION['Aviso']="Seu limite de saque por vez é de 1000,00";
        }else{
            $_SESSION['saldo_poupanca'] = (number_format($_SESSION['saldo_poupanca'],2) - number_format($Withdraw,2) - 0.80);
            $_SESSION['Aviso']="Saque Efetuado**";  
            
        }
        return $_SESSION;
    }

    public function setDepositCurrent($value){
        $_SESSION['Aviso']="";
        
        $v = str_replace('.','',$value);
        $value = str_replace(',','.',$v);

        $_SESSION['saldo_corrente'] = number_format((number_format($_SESSION['saldo_corrente'],2) + number_format($value,2,".","")),2,",",".");
        $_SESSION['Aviso']="Deposito Efetuado"; 
        return $_SESSION;
    }

    public function setDepositSavings($value){
        $_SESSION['Aviso']="";
        $v = str_replace('.','',$value);
        $value = str_replace(',','.',$v);
        
        $_SESSION['saldo_poupanca'] = number_format((number_format($_SESSION['saldo_poupanca'],2) + number_format($value,2,".","")),2,",",".");
        $_SESSION['Aviso']="Deposito Efetuado"; 
        return $_SESSION;
    }

}