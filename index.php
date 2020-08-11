<style type="text/css">
  .titulo{
    text-align:center;
    background-color:#808080;
  }
  .conteudo{
    position: absolute;
    width:400px;
    height:300px;
    background-color:#DCDCDC;
  }
  .conteudo-left{
    width:150px;
    height:300px;
    float:left;
    background-color:#C0C0C0;
  }
  .conteudo-right{
    width:250px;
    height:300px;
    float:left;
    background-color:#D3D3D3;
  }
</style>

<?php
session_start(); 
require_once __DIR__ . '/vendor/autoload.php';

use Moovin\Job\Backend;

//$exemplo = new Backend\Exemplo;
//echo $exemplo->exemplo();


$account = new Backend\Account;
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="assets/jquery.mask.js"></script>';
echo '<div class="conteudo">';
echo ' Tipo de conta: ';
echo '<select id="conta">
    <option value="">Selecione</option>
    <option value="1">Corrente</option>
    <option value="2">Poupança</option>
    </select>';
echo '<br><br>';
echo '<div id="Corrente" style="display:none">
<div class="titulo">Conta Corrente</div>
<div class="conteudo-left">
    <button type="button" id="DC">Deposito</button><br>
    <button type="button" id="SC">Saque</button><br>
    <button type="button" id="TC">Transferência</button>
</div>
<div class="conteudo-right">
 Saldo:'.$account->getSaleCurrent().'                  
<div id="OperacaoDepositoCorrente" style="display:none"> 
    Valor: <input type="text" size="10px" class="money" id=VDC> 
    <button type="button" id="CDC">Confirmar</button>
</div>
<div id="OperacaoSaqueCorrente" style="display:none"> 
    Valor: <input type="text" size="10px" class="money" id=VSC> 
    <button type="button" id="CSC">Confirmar</button>
</div>
 <div id="OperacaoTransferenciaCorrente" style="display:none"> 
    Conta:'.$account->getSavings().' <br>
    Valor: <input type="text" size="10px" class="money" id=VTC> 
    <button type="button" id="CTC">Confirmar</button>
 </div>
</div>
</div>';

echo '<div id="Poupança" style="display:none">
<div class="titulo">Conta Poupança</div>
<div class="conteudo-left">
    <button type="button" id="DP">Deposito</button><br>
    <button type="button" id="SP">Saque</button><br>
    <button type="button" id="TP">Transferência</button>
</div>
<div class="conteudo-right">
Saldo:'.$account->getSaleSavings().'
<div id="OperacaoDepositoPoupanca" style="display:none"> 
    Valor: <input type="text" size="10px" class="money" id=VDP> 
    <button type="button" id="CDP">Confirmar</button>
</div>
<div id="OperacaoSaquePoupanca" style="display:none"> 
    Valor: <input type="text" size="10px" class="money" id=VSP> 
    <button type="button" id="CSP">Confirmar</button>
</div>
<div id="OperacaoTransferenciaPoupanca" style="display:none">
    Conta:'.$account->getCurrent().'<br> 
    Valor: <input type="text" size="10px" class="money" id=VTP> 
    <button type="button" id="CTP">Confirmar</button>
</div>
</div>';
echo '</div>';
echo '<script>

    var select = document.getElementById("conta");
    select.addEventListener("change", tipoConta);

    document.getElementById("DC").onclick = function() {DepositoCorrente()};
    document.getElementById("CDC").onclick = function() {ConfirmarDepositoCorrente()};
    document.getElementById("SC").onclick = function() {SaqueCorrente()};
    document.getElementById("CSC").onclick = function() {ConfirmarSaqueCorrente()};
    document.getElementById("TC").onclick = function() {TransferenciaCorrente()};
    document.getElementById("CTC").onclick = function() {ConfirmarTransferenciaCorrente()};


    document.getElementById("DP").onclick = function() {DepositoPoupanca()};
    document.getElementById("CDP").onclick = function() {ConfirmarDepositoPoupanca()};
    document.getElementById("SP").onclick = function() {SaquePoupanca()};
    document.getElementById("CSP").onclick = function() {ConfirmarSaquePoupanca()};
    document.getElementById("TP").onclick = function() {TransferenciaPoupanca()};
    document.getElementById("CTP").onclick = function() {ConfirmarTransferenciaPoupanca()};


    function tipoConta() {
        var x = document.getElementById("conta");
        if (x.value == ("1")) {
            document.getElementById("Corrente").style.display = "block";
            document.getElementById("Poupança").style.display = "none";
            
        }
        if (x.value == ("2")) {
            document.getElementById("Poupança").style.display = "block";
            document.getElementById("Corrente").style.display = "none";
            
        }
    }

    function DepositoCorrente() {
        document.getElementById("OperacaoDepositoCorrente").style.display = "block";
        document.getElementById("OperacaoDepositoPoupanca").style.display = "none";
        document.getElementById("OperacaoSaqueCorrente").style.display = "none";
        document.getElementById("OperacaoSaquePoupanca").style.display = "none";
        document.getElementById("OperacaoTransferenciaCorrente").style.display = "none";
        document.getElementById("OperacaoTransferenciaPoupanca").style.display = "none";
        $(".money").mask("000.000.000.000.000,00", {reverse: true});
    }

    function ConfirmarDepositoCorrente(){
        
        var valor = $("#VDC").val();
        $.ajaxSetup({async: false});
        $.post("Validation.php", "valorDepositoC="+valor, function( data ) {
        });
        alert("'.$_SESSION["Aviso"].'")
        window.location.reload();
    }

    function SaqueCorrente() {
        document.getElementById("OperacaoDepositoCorrente").style.display = "none";
        document.getElementById("OperacaoDepositoPoupanca").style.display = "none";
        document.getElementById("OperacaoSaqueCorrente").style.display = "block";
        document.getElementById("OperacaoSaquePoupanca").style.display = "none";
        document.getElementById("OperacaoTransferenciaCorrente").style.display = "none";
        document.getElementById("OperacaoTransferenciaPoupanca").style.display = "none";
        $(".money").mask("000.000.000.000.000,00", {reverse: true});
    }

    function ConfirmarSaqueCorrente(){
        
        var valor = $("#VSC").val();
        $.ajaxSetup({async: false});
        $.post("Validation.php", "valorSaqueC="+valor, function( data ) {
        });
        alert("'.$_SESSION["Aviso"].'")
        window.location.reload();
    }

    function TransferenciaCorrente() {
        document.getElementById("OperacaoDepositoCorrente").style.display = "none";
        document.getElementById("OperacaoDepositoPoupanca").style.display = "none";
        document.getElementById("OperacaoSaqueCorrente").style.display = "none";
        document.getElementById("OperacaoSaquePoupanca").style.display = "none";
        document.getElementById("OperacaoTransferenciaCorrente").style.display = "block";
        document.getElementById("OperacaoTransferenciaPoupanca").style.display = "none";
        $(".money").mask("000.000.000.000.000,00", {reverse: true});
    }

    function ConfirmarTransferenciaCorrente(){
        
        var valor = $("#VTC").val();
        $.ajaxSetup({async: false});
        $.post("Validation.php", "valorTransferenciaC="+valor&"Tipo="+conta, function( data ) {
        });
        alert("'.$_SESSION["Aviso"].'")
        window.location.reload();
    }

    function DepositoPoupanca() {
        document.getElementById("OperacaoDepositoCorrente").style.display = "none";
        document.getElementById("OperacaoDepositoPoupanca").style.display = "block";
        document.getElementById("OperacaoSaqueCorrente").style.display = "none";
        document.getElementById("OperacaoSaquePoupanca").style.display = "none";
        document.getElementById("OperacaoTransferenciaCorrente").style.display = "none";
        document.getElementById("OperacaoTransferenciaPoupanca").style.display = "none";
        $(".money").mask("000.000.000.000.000,00", {reverse: true});
    }

    function ConfirmarDepositoPoupanca(){
        
        var valor = $("#VDP").val();
        $.ajaxSetup({async: false});
        $.post("Validation.php", "valorDepositoP="+valor, function( data ) {
        });
        alert("'.$_SESSION["Aviso"].'")
        window.location.reload();
    }

    function SaquePoupanca() {
        document.getElementById("OperacaoDepositoCorrente").style.display = "none";
        document.getElementById("OperacaoDepositoPoupanca").style.display = "none";
        document.getElementById("OperacaoSaqueCorrente").style.display = "none";
        document.getElementById("OperacaoSaquePoupanca").style.display = "block";
        document.getElementById("OperacaoTransferenciaCorrente").style.display = "none";
        document.getElementById("OperacaoTransferenciaPoupanca").style.display = "none";
        $(".money").mask("000.000.000.000.000,00", {reverse: true});
    }

    function ConfirmarSaquePoupanca(){
        
        var valor = $("#VSP").val();
        $.ajaxSetup({async: false});
        $.post("Validation.php", "valorSaqueP="+valor, function( data ) {
        });
        alert("'.$_SESSION["Aviso"].'")
        window.location.reload();
    }

    function TransferenciaPoupanca() {
        document.getElementById("OperacaoDepositoCorrente").style.display = "none";
        document.getElementById("OperacaoDepositoPoupanca").style.display = "none";
        document.getElementById("OperacaoSaqueCorrente").style.display = "none";
        document.getElementById("OperacaoSaquePoupanca").style.display = "none";
        document.getElementById("OperacaoTransferenciaCorrente").style.display = "none";
        document.getElementById("OperacaoTransferenciaPoupanca").style.display = "block";
        $(".money").mask("000.000.000.000.000,00", {reverse: true});
    }

    function ConfirmarTransferenciaPoupanca(){
        
        var valor = $("#VTP").val();
        var conta = $("#conta").val();
        $.ajaxSetup({async: false});
        $.post("Validation.php", "valorTransferenciaP="+valor&"Tipo="+conta, function( data ) {
        });
        alert("'.$_SESSION["Aviso"].'")
        window.location.reload();
    }

</script>';


