<?php
session_start();
require_once "../model/pedido.class.php";
$pedido = new Pedido($_SESSION["COD_USUARIO"], true);

?>
<!DOCTYPE html>
<html lang="en">
<?php require_once "cabecalho.php"; ?>
<body onload="document.getElementById('fCodProduto').focus();carregaListaProdutosPedidoAjax('form');carregaResumoAjax();">
<?php require_once "menu.php"; ?>

<div class="geral">
    <div class="panel panel-default">
        <div class="panel-body">
            <?php
            if (is_null($pedido->getCodigo())) {
                ?>
                <div id="divListaProdutoPedidoAjax">
                    <form action="../controller/pedido.iniciar.php" method="post">
                        <input type="submit" class="btn btn-primary btn-lg center-block" value="Iniciar Novo Pedido">
                    </form>
                </div>
                <?php
            } else {
                ?>

                <!-- Div com o formulario para adicionar itens ao pedido -->
                <form action="#" method="post" name="form" id="form">
                    <input type="hidden" name="fCodPedido" value="<?php echo $pedido->getCodigo(); ?>">
                    <div class="col-lg-2">
                        <div class="form-group row">
                            <label for="example-text-input" class="col-xs-5 col-form-label">Código</label>
                            <div class="col-xs-7">
                                <input class="form-control col-xs-2 pula" type="text" id="fCodProduto"
                                       name="fCodProduto" onblur="carregaImagemAjax();">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-number-input" class="col-xs-5 col-form-label">Quantidade:</label>
                            <div class="col-xs-7">
                                <input class="form-control pula" type="number" min="1" id="fQuantidade"
                                       name="fQuantidade">
                            </div>
                        </div>
                        <div class="form-group row">
                            <button type="button" class="btn btn-primary btn-lg btn-block pula"
                                    onclick="carregaListaProdutosPedidoAjax('form');carregaResumoAjax();">Adicionar
                            </button>
                        </div>

                        <!-- Div para a visualização do Produto -->
                        <div class="panel panel-default form-group row">

                            <div class="panel-body" id="divImagemAjax" style="padding: 0px;">

                            </div>
                        </div>

                    </div>
                </form>


                <div id="divListaProdutoPedidoAjax" class="col-lg-7">

                </div>

                <!-- Resumo do Pedido -->
                <div class="col-lg-3" id="divResumoAjax">

                </div>
                <?php
            }
            ?>
        </div>


    </div>
</div>
</div>


</body>
</html>
<script>
    $(document).ready(function () {
        /* ao pressionar uma tecla em um campo que seja de class="pula" */
        $('.pula').keypress(function (e) {
            /* * verifica se o evento é Keycode (para IE e outros browsers) * se não for pega o evento Which (Firefox) */
            var tecla = (e.keyCode ? e.keyCode : e.which);
            /* verifica se a tecla pressionada foi o ENTER */
            if (tecla == 13) {
                /* guarda o seletor do campo que foi pressionado Enter */
                campo = $('.pula');
                /* pega o indice do elemento*/
                indice = campo.index(this);
                /*soma mais um ao indice e verifica se não é null *se não for é porque existe outro elemento */
                if (campo[indice + 1] != null) {
                    /* adiciona mais 1 no valor do indice */
                    proximo = campo[indice + 1];
                    /* passa o foco para o proximo elemento */
                    proximo.focus();
                    proximo.select();
                    return true;
                } else {
//                    adicionei este else para atender uma necessidade especpifica.
                    /* adiciona mais 1 no valor do indice */
                    proximo = campo[0];
                    /* passa o foco para o primeiro elemento */
                    proximo.focus();
                    proximo.select();
                    return true; // returna true para confirmar o clique no botao
                }
            }
        })
    })
</script>