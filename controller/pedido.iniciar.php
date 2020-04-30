<?php
session_start();
require_once "../model/pedido.class.php";
require_once "../config.php";
$pedido = new Pedido($_SESSION["COD_USUARIO"], true);

if (!is_null($pedido->getCodigo())) {
    $_SESSION["ERRO"] = ERRO_PEDIDO_ABERTO;
} else {
    $pedido->setCodigoPessoa($_SESSION["COD_USUARIO"]);

    if ($pedido->novo())
        header("Location: $url/view/pedido.php");
    else
        header("Location: $url/view/pagina.php");

}
