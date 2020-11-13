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
            <ul class="nav navbar-nav">
                <li class="active"><a href="empresaCamp"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <?php
                if($_SESSION['usuarioAtual']['nome']) {
                    ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Empresa <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="admEmpresa"><i class="glyphicon glyphicon-search"></i> Consultar</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Arquivo <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="cadArquivo"><i class="glyphicon glyphicon-folder-open"></i> &nbsp;Importar Arquivo</a>
                            </li>
<!--                            <li><a href="cadArquivo."><i class="glyphicon glyphicon-plus"></i> Cadastrar</a></li>-->
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Campanha <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="admCampanha"><i class="glyphicon glyphicon-search"></i> Consultar Campanha</a>
                            </li>
                            <li><a href="cadCampanha"><i class="glyphicon glyphicon-plus"></i> Cadastrar Campanha</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Retificacões <b
                                    class="caret"></b></a>
                        <ul class="dropdown-menu">
<!--                            <li><a href="admRetificacaosudam"><i class="glyphicon glyphicon-time"></i>-->
<!--                                    Retificações Pendentes</a></li>-->
                            <li><a href="admRetificacaosudam"><i class="glyphicon glyphicon-search"></i>
                                    Consultar</a></li>
                        </ul>
                    </li>
                    <?php
                }else{
                ?>
                    <li class=""><a href="empresaCamp">Campanha</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Retificações<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="cadRetificacaoempresa"><i class="glyphicon glyphicon-plus"></i> Cadastrar</a>
                            </li>
                        </ul>
                    </li>
                <?php
                     }
                ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>