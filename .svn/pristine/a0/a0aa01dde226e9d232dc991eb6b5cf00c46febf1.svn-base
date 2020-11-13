<?php
switch($tipo){
    case "erro":    $tipo = "alert-danger";  $m = "Alerta!"; break;
    case "sucesso": $tipo = "alert-success"; $m = "Sucesso!"; break;
    case "atencao": $tipo = "alert-warning"; $m = "Atenção!"; break;
}
?>
<div class="alert alert-dismissible fade in <?=$tipo?> font-12">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
    <h4><?php echo $m;?></h4>
    <p><?php echo $msg;?></p>
</div>