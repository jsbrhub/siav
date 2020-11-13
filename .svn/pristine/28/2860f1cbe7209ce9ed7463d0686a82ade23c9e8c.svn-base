<?php

require_once("classes/class.Controle.php");
$oControle = new Controle();
include "rotina.php";
$usuarioAtual = $_SESSION['usuarioAtual'];
$nome = $_SESSION['usuarioAtual']['nome'];
$cnpj = $_SESSION['usuarioAtual']['cnpj'];
$infoEmpresa = $oControle->getInfoAtualEmpresa($cnpj) ;
if($infoEmpresa){
    $nome = $infoEmpresa->razaoSocial;
    $empresa = "empresa";

    if($_SESSION['usuarioAtual']["tipo_perfil"] != "responsavel")
        header("location:$empresa");
    else
        header("location: admResponsaveis");
}
//Util::trace($_SERVER['SCRIPT_FILENAME'],false);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
    <div class="nav-top">
        <div class="top-content">
            <div  >
                <img src="img/SUDAMd.png" height="40">
            </div>
            <div class="hidden-xs nav-top-logo">
                <strong><i>SIAV - Sistema de Avaliação</i></strong><br><i><span class="text-muted" style="font-size: 12px">Incentivos Fiscais</span> </i>

            </div>
            <div >
                <ul class="nav navbar-nav navbar-right nav-bt-user">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle btn-user" data-toggle="dropdown" role="button"><i class="glyphicon glyphicon-user"></i> <?=$nome?> <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
<!--                            <li><a href="principal.php"><i class="glyphicon glyphicon-th-large"></i>  Módulos</a></li>-->
<!--                            <li class="divider"></li>-->
                            <li><a href="logoff"><i class="glyphicon glyphicon-off"></i> Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <?php 
        //require_once("includes/titulo.php");
        require_once("includes/home.php");
        ?>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>