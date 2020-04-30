<?php
require_once "../model/pessoa.class.php";
require_once "../model/pedido.class.php";
require_once "../config.php";

$pessoa = new Pessoa($_SESSION["COD_USUARIO"]);
$pedido = new Pedido($_SESSION["COD_USUARIO"], true);

if (!isset($pessoa)) {
    header("Location: $url");
} else {
    ?>

    <nav class="navbar navbar-default">
        <div class="container-fluid">


            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
                    <li>
                        <a href="pedido.php">
                            <?php
                            if (is_null($pedido->getCodigo()))
                                echo "Novo Pedido";
                            else
                                echo "Continuar Pedido";
                            ?>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Relatórios <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Meus Pedidos</a></li>
                            <li><a href="#">Financeiro</a></li>
                            <!--            <li><a href="#">Something else here</a></li>-->
                            <!--            <li role="separator" class="divider"></li>-->
                            <!--            <li><a href="#">Separated link</a></li>-->
                            <!--            <li role="separator" class="divider"></li>-->
                            <!--            <li><a href="#">One more separated link</a></li>-->
                        </ul>
                    </li>
                </ul>
                <!--      <form class="navbar-form navbar-left">-->
                <!--        <div class="form-group">-->
                <!--          <input type="text" class="form-control" placeholder="Search">-->
                <!--        </div>-->
                <!--        <button type="submit" class="btn btn-default">Submit</button>-->
                <!--      </form>-->
                <ul class="nav navbar-nav navbar-right">
                    <!--        <li><a href="#">Link</a></li>-->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false"><?php echo $pessoa->getNome(); ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Perfil</a></li>
                            <!--            <li><a href="#">Another action</a></li>-->
                            <!--            <li><a href="#">Something else here</a></li>-->
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <?php
}
?>