<?php
session_start();
require_once "../model/produto.class.php";
require_once "../model/pedido.class.php";

$pedido = new Pedido($_SESSION["COD_USUARIO"], true);

if ($_POST["fCodProduto"]) {

    $codProduto = $_POST["fCodProduto"];
    $quantidade = $_POST["fQuantidade"];

    $produto = new Produto($codProduto, true);

    //echo "COD: $codProduto";

    //$produtos = $produto->selecionar($codProduto);

    // Este count é para verificar se produto está cadastrado.
    if ($produto->getCodigo()) {
        $pedidoItens = $pedido->selecionar($pedido->getCodigo(), $codProduto);

        $valorCompra = $produto->getPreco() * $quantidade;
        $valorLucro = $valorCompra * ($produto->getDesconto() / 100);
        $valorVenda = $valorCompra - $valorLucro;

        // count = 1 significa que trouxe somente um item da lista do pedido,
        // logo este produto já existe no pedido e só precisa atualizar a tabela.
        if (count($pedidoItens) == 1) {
            // só atualiza se o quantidade for diferente ou maior que zero
            if ($quantidade <> $pedidoItens[0]["quantidade"] and $quantidade > 0) {


                if ($pedido->atualizarPedido($pedido->getCodigo(), $produto->getReferencia(), $quantidade, $produto->getPreco(), $valorCompra, $valorVenda, $valorLucro)) {
                    ?>
                    <div class="alert alert-success text-center" role="alert">
                        Você alterou de <strong><?php echo $pedidoItens[0]["quantidade"]; ?></strong>
                        para <strong><?php echo $quantidade . " "; ?></strong>
                        <?php echo $produto->getDescricao(); ?>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="alert alert-danger text-center" role="alert">
                        <strong>ATENÇÃO!</strong> Houve um erro ao alterar a quantidade.
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="alert alert-warning text-center" role="alert">
                    <strong> Eita!</strong> A quantidade precisa ser maior que zero ou diferente do pedido atual.
                </div>
                <?php
            }
        } else {
            $pedido->inserirNoPedido($pedido->getCodigo(), $produto->getReferencia(), $quantidade, $produto->getPreco(), $valorCompra, $valorVenda, $valorLucro, date("Y-m-d H:i:s"));
            ?>
            <div class="alert alert-success text-center" role="alert">
                <strong> <?php echo $quantidade . " "; ?><?php echo $produto->getDescricao(); ?></strong> adicionado com
                sucesso.
            </div>
            <?php
        }

    } else {
        ?>
        <div class="alert alert-danger text-center" role="alert">
            <strong>Ops!</strong> Não existe produto com este código.
        </div>
        <?php
    }
}

$itens = $pedido->listarProdutos($pedido->getCodigo());

if (count($itens) == 0) {
    echo "Não existe produto em seu pedido.";
} else {

    $msg = "";
    if (isset($_SESSION["EXCLUIDO"])) {
        $alert = "success";
        $msg = $_SESSION["EXCLUIDO"];
        unset($_SESSION["EXCLUIDO"]);
    } elseif (isset($_SESSION["ERRO"])) {
        $alert = "danger";
        $msg = $_SESSION["ERRO"];
        unset($_SESSION["ERRO"]);
    }

    if ($msg){
        ?>
        <div class="alert alert-<?php echo $alert; ?> text-center"
             role="alert">
            <?php
            echo $msg;


            ?>
        </div>
        <?php
    }
    ?>


    <div id="divListaProdutoBarraDeRolagem">
        <table class="table tableListaDePedidos table-hover">
            <thead class="bg-primary">
            <tr>
                <th width="50px"></th>
                <th>Produto</th>
                <th>Qtd</th>
                <th>R$ Unit.</th>
                <th>R$ Compra</th>
                <th>R$ Venda</th>
                <th>R$ Lucro</th>
                <th></th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <td colspan="7">
                    <table id="tableFootLegendaMarcas" width="100%">
                        <tr>
                            <td>
                                <div class="corDaMarcaNaListaDoPedidoSuave">
                                    Suave Fragrance
                                </div>
                            </td>
                            <td>
                                <div class="corDaMarcaNaListaDoPedidoFacinatus">
                                    Facinatus
                                </div>
                            </td>
                            <td>
                                <div class="corDaMarcaNaListaDoPedidoFitoway">
                                    Fitoway
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td></td>
            </tr>
            </tfoot>

            <tbody>
            <?php
            foreach ($itens as $chave => $valor) {
                $idFormQuantidade = "formAlteraQuantidade$chave";

                $filename = '../view/img/produtos/' . $valor["codigo"] . '.jpg';

                if (!file_exists($filename)) {
                    $filename = '../view/img/produtos/' . $valor["codigo"] . '.png';

                    if (!file_exists($filename)) {
                        $filename = '../view/img/produtos/imgNotFound.png';
                    }
                }

                ?>
                <tr>
                    <th style="text-align: center;">
                        <a class="fancybox-effects-c" href="<?php echo $filename; ?>"
                           title="Cód: <?php echo $valor["produto"]; ?> - <?php echo $valor["descricao"]; ?>">

                            <img src="<?php echo $filename; ?>"
                                 style="max-width: 30px; max-height: 20px; width: auto; height: auto;">
                        </a>
                    </th>
                    <td>
                        <?php
                        switch ($valor["codMarca"]) {
                            case 1:
                                $stringClassMarca = "corDaMarcaNaListaDoPedidoSuave";
                                break;
                            case 34:
                                $stringClassMarca = "corDaMarcaNaListaDoPedidoFacinatus";
                                break;
                            case 75:
                                $stringClassMarca = "corDaMarcaNaListaDoPedidoFitoway";
                                break;
                            default:
                                $stringClassMarca = "corDaMarcaNaListaDoPedidoOutros";
                                break;
                        }
                        ?>
                        <div class="<?php echo $stringClassMarca; ?>">
                            <span class="spanDescProduto"><?php echo $valor["descricao"]; ?></span>
                            <small>Cód. <?php echo $valor["produto"]; ?></small>
                        </div>
                    </td>
                    <td style="width: 10%;">
                        <form name="<?php echo $idFormQuantidade; ?>" id="<?php echo $idFormQuantidade; ?>"
                              method="post">
                            <input type="hidden" name="fCodProduto" id="fCodProduto"
                                   value="<?php echo $valor["produto"]; ?>">
                            <input type="hidden" name="fFlgAlteraQuantidade" id="fFlgAlteraQuantidade" value="1">
                            <div>
                                <input type="number" class="form-control form-group-sm" name="fQuantidade"
                                       id="fQuantidade"
                                       value="<?php echo $valor["quantidade"]; ?>" min="1"
                                       onchange="carregaListaProdutosPedidoAjax('<?php echo $idFormQuantidade; ?>');carregaResumoAjax();"
                                       onclick="carregaResumoAjax();" onblur="carregaResumoAjax();">
                            </div>
                        </form>
                    </td>
                    <td><span class="moeda font-maior text-nowrap"><?php echo $valor["valorUnitario"]; ?></span></td>
                    <td><span class="moeda font-maior text-nowrap"><?php echo $valor["valorCompra"]; ?></span></td>
                    <td><span class="moeda font-maior text-nowrap"><?php echo $valor["valorVenda"]; ?></span></td>
                    <td><span class="moeda font-maior text-nowrap"><?php echo $valor["valorLucro"]; ?></span></td>
                    <td>
                        <form onsubmit="return confirmaExcluirItem();" action="../controller/pedido.excluirItem.php"
                              name="<?php echo $idFormQuantidade; ?>" id="<?php echo $idFormQuantidade; ?>"
                              method="post">
                            <input type="hidden" name="fCodProduto" id="fCodProduto"
                                   value="<?php echo $valor["produto"]; ?>">
                            <input type="hidden" name="fPedido" id="fPedido"
                                   value="<?php echo $pedido->getCodigo(); ?>">
                            <input type="hidden" name="fFlgExcluiItem" id="fFlgExcluiItem" value="1">
                            <div>
                                <input type="image" class="lixeiraExcluir" src="../view/img/glyphicons-17-bin.png"
                                       title="Excluir Item">
                            </div>
                        </form>

                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <?php
}
?>