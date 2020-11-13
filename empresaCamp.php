<?php
/**
 * Created by PhpStorm.
 * User: raquelohashi
 * Date: 13/10/17
 * Time: 18:25
 */
require_once("classes/class.Controle.php");
$oControle = new Controle();
$infoEmpresa = $oControle->getInfoAtualEmpresa($cnpj) ;
$nome = $infoEmpresa->razaoSocial;
$cnpj = $_SESSION['usuarioAtual']['cnpj'];
$listaCampanhasAtivas = $oControle->retornaCampanhasAtivasEmpresaLogada($cnpj);
//Util::trace($listaCampanhasAtivas,false);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
    <script>
        $('input[required]').on('invalid', function() {
            this.setCustomValidity($(this).data("required-message"));
        });
    </script>
</head>
<body>
<?php
require_once("includes/modals.php");
include ("includes/topo.php");
?>
<div class="container">
    <?php require_once("includes/menu.php"); ?>
    <div class="border-radius bg-grey font-12  p-20"
         id="notificacoes">
        <div class="col-md-9">
            <?php
            if($listaCampanhasAtivas){
                foreach ($listaCampanhasAtivas as $campanha){
                    //Util::trace($campanha,false);
                ?>
            <ul class="list-group">
                <li class="list-group-item list-group-item-info">
                    <span class="glyphicon glyphicon-hand-right"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="empresaCad"><?=$campanha->oCampanha->campanha?> - Ano Base: <?=$campanha->oCampanha->anoBase?></a><span class="label label-warning pull-right">Pendente</span>
                </li>
            </ul>
            <?php }
            } ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="modal fade" id="modalTrocarSenha" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Trocar Senha de Acesso</h4>
                </div>
                <div class="alert" style="display: none;margin-bottom: 0" >
                    <h4></h4>
                    <p></p>
                </div>
                <form class="form-horizontal" onsubmit="return false;" id="formTrocarSenha">
                    <div class="modal-body" >
                        <div id="form-carregando" style="display: none"><img src="img/blocksLoading.gif">Enviando...</div>
                        <div id="corpoForm">
                            <div class="form-group">
                                <label for="senha" class="col-sm-4 control-label">Senha Atual:</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="senha" placeholder="Senha Atual" required oninvalid="setCustomValidity('Digite a senha atual.')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="password" class="col-sm-4 control-label">Nova Senha:</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="password" placeholder="Mín. 6 caracteres." required oninvalid="setCustomValidity('Digite a nova senha.')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="confirmPassword" class="col-sm-4 control-label">Confirme Nova Senha:</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="confirmPassword" placeholder="Confirme Nova Senha" required oninvalid="setCustomValidity('Confirme a nova senha.')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btn-fechar" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" id="btnTrocarSenha" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php")?>
</body>
</html>