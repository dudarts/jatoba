<?php
session_start();
require_once "../config.php";


if ($_POST) {
    require_once "../model/pedido.class.php";

    $pedido = new Pedido($_POST["fPedido"]);

    if ($pedido->excluir($_POST["fCodProduto"]))
        $_SESSION["EXCLUIDO"] = "Item <strong>EXCLUÍDO</strong> com Sucesso!";
    else
        $_SESSION["ERRO"] = ERRO_EXCLUSAO;
} else {
    $_SESSION["ERRO"] = ERRO_GRAVAR_FORMULARIO;
}
header("Location: ../view/pedido.php");