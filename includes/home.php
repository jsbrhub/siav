<!-- Static navbar -->
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-controls="navbar">
                <span class="sr-only">Menu Principal</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <div class="col-md-4">
            <ul class="nav navbar-nav">
                <li class="">  <a style="text-decoration: none"><span class="glyphicon glyphicon-globe"></span>  &nbsp;&nbsp;Seja bem-vindo(a),
                         <strong><i><?=$_SESSION['usuarioAtual']['nome']?></i></strong></a></li>
                
            </ul>
            </div>
            <div class="col-md-4">
                <ul class="nav navbar-nav">
                    <li class=""></li>

                </ul>
            </div>
            <div class="col-md-6">
                <ul class="nav navbar-nav" style="list-style: none">
                    <li class=""></li>

                </ul>
            </div>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>
<div>
    <div  class="col-xs-6 col-md-4 text-center">
        <div class="thumbnail">
            <img src="img/cityscape.png" height="64px" width="64px" alt="...">
            <div class="caption">
               <a href="empresa" class="btn btn-primary btn-sm" role="button">Empresas</a>
            </div>
        </div>
    </div>
    <div  class="col-xs-6 col-md-4  text-center">
        <div class="thumbnail">
            <img src="img/stats.png" height="64px" width="64px" alt="...">
            <div class="caption">
                <a href="pivotable.php" class="btn btn-primary btn-sm" role="button">Business Intelligence</a>
            </div>
        </div>
    </div>
    <div  class="col-xs-6 col-md-4  text-center">
        <div class="thumbnail">
            <img src="img/004-checking.png" height="64px" width="64px" alt="...">
            <div class="caption">
                <a href="#" class="btn btn-primary btn-sm" role="button">Inadimplência</a>
            </div>
        </div>
    </div>
</div>