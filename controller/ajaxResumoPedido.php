<?php
session_start();
require_once "../config.php";
require_once "../model/pedido.class.php";
require_once "../model/pessoa.class.php";

$pedido = new Pedido($_SESSION["COD_USUARIO"], true);
$pessoa = new Pessoa($_SESSION["COD_USUARIO"]);

?>

<div class="panel panel-default" id="divResumoPedido">
    <div class="panel-heading">
        <h3 class="panel-title">Resumo</h3>
    </div>


    <div class="panel-body" style="padding: 0px;padding: 10px;">
        <div style="font-weight: bold;">
            <div class="col-lg-7">Limite de Crédito:</div>
            <div class="col-lg-5"><?php echo "R$ " . number_format($pessoa->getLimiteCredito(), 2, ",", "."); ?></div>
        </div>
        <br><br>
        <div>
            <div class="col-lg-6">Quantidade:</div>
            <div class="col-lg-6"><?php echo $pedido->resumoPedido()[0]["TOTAL_PRODUTOS"]; ?></div>
        </div>
        <div>
            <div class="col-lg-6">Total Compra :</div>
            <div class="col-lg-6">
                R$ <?php echo number_format($pedido->resumoPedido()[0]["TOTAL_COMPRA"], 2, ",", "."); ?></div>
        </div>
        <div>
            <div class="col-lg-6">Total Venda:</div>
            <div class="col-lg-6">
                R$ <?php echo number_format($pedido->resumoPedido()[0]["TOTAL_VENDA"], 2, ",", "."); ?></div>
        </div>
        <div style="font-weight: bolder;">
            <div class="col-lg-6">Lucro:</div>
            <div class="col-lg-6">
                R$ <?php echo number_format($pedido->resumoPedido()[0]["TOTAL_LUCRO"], 2, ",", "."); ?></div>
        </div>
    </div>

    <div class="panel-body">
        <?php
        $valorVenda = $pedido->resumoPedido()[0]["TOTAL_VENDA"];
        //echo $pessoa->getLimiteCredito()*(1+intval(PORCENTAGEM_MAX_TOLERANCIA_PEDIDO));
        $desativa = false;
        if ($valorVenda < @VALOR_MINIMO_PEDIDO) {
            $desativa = true;
            $classAlert = "alert-danger";
            $classProgressBar = "progress-bar-danger";
            $texto = "Pedido abaixo do limite!<br>Adicione mais produtos";
        } elseif ($valorVenda > ($pessoa->getLimiteCredito())) {
            $classAlert = "alert-warning";
            $classProgressBar = "progress-bar-warning";
            $texto = "Pedido acima do limite";
        } else {
            $classAlert = "alert-success";
            $classProgressBar = "progress-bar-success";

            $texto = "Você ainda pode comprar mais R$ " . number_format(($pessoa->getLimiteCredito() - $valorVenda), 2, ",", ".") . " em produtos.";
        }
        $porcentagem = ($pedido->resumoPedido()[0]["TOTAL_VENDA"] / ($pessoa->getLimiteCredito() * 1.15)) * 100;
        ?>

        <div class="alert <?php echo $classAlert; ?>" role="alert" style="text-align: center;">
            <strong><?php echo $texto; ?></strong>
        </div>
        <div class="progress" id="painelLimiteCompras">
            <div class="progress-bar <?php echo $classProgressBar; ?>" role="progressbar" title="Dentro do Limite"
                 style="width:<?php echo $porcentagem; ?>%; font-weight: bolder; text-shadow:1px 1px 2px white;">
            </div>
        </div>


        <div>

            <form action="../controller/pedido.encerrar.php" method="post" onsubmit="return finalizaPedido();">
                <input type="hidden" name="fPedido" id="fPedido" value="<?php echo $pedido->getCodigo(); ?>">

                <div class="col-lg-4">
                    <label class="form-check-inline">
                        <input required class="form-check-input" type="radio" name="fFormaPagamento"
                               id="inlineRadio1"
                               value="1">
                        <img class="icone" src="../view/img/1.png" alt="À Vista">
                        <small class="smallTexto">À Vista</small>
                    </label>
                </div>
                <div class="col-lg-4">
                    <label class="form-check-inline">
                        <input required class="form-check-input" type="radio" name="fFormaPagamento"
                               id="inlineRadio2" value="2">
                        <img class="icone" src="../view/img/2.png" alt="Boleto">
                        <span class="smallTexto">Boleto Bancário</span>
                    </label>
                </div>
                <div class="col-lg-4">
                    <label class="form-check-inline">
                        <input required class="form-check-input" type="radio" name="fFormaPagamento"
                               id="inlineRadio3"
                               value="3">
                        <img class="icone" src="../view/img/4.png" alt="Cartão">
                        <span class="smallTexto">Cartão de Crédito</span>
                    </label>
                </div>
                <input <?php echo $desativa ? "disabled" : ""; ?> type="submit" class="btn btn-lg btn-primary btn-block"
                                                                  value="Finalizar Pedido">
            </form>
        </div>

    </div>


</div>
