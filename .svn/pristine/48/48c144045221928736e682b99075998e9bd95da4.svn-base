<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");
$oControle = new Controle(false);


foreach($_POST as $campo=>$valor){
    $$campo = trim($valor);
}

/*if($senha == '123456'){
   print ("1");
   exit();
}*/

if($tipoUsuario == 's'){

    if($oControle->autenticaUsuarioLDAP($login, $senha)){
        if($oControle->isUserCtiCgav()){
          echo "0";
        }else{
           echo "2";
        }
    }
   // print ($oControle->autenticaUsuarioLDAP($login, $senha)) ? "0" : $oControle->msg;
} else {

    $cnpj = str_replace(["-", ".", "/"], "", $cnpj);

    if(is_numeric($cnpj)){
        if(strlen($cnpj) == 14){
            print ($oControle->autenticaEmpresa($cnpj, $senha)) ? "0" : "1";

        } else{
            print ($oControle->autenticaResponsavel($cnpj, $senha)) ? "0" : "1";
        }
    } else {
        print ($oControle->autenticaResponsavel($cnpj, $senha)) ? "0" : "1";
    }

}