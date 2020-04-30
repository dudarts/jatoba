<?php
set_time_limit(0);
// Iniciamos o "contador"
list($usec, $sec) = explode(' ', microtime());
$script_start = (float) $sec + (float) $usec;

require_once "../model/produto.class.php";

$produto = new Produto();
$arrayProton = array_column($produto->listaProdutosProton(), "CODIGO");
$arrayWeb = array_column($produto->listaProdutosWeb(false), "CODIGO");

$arrayInserir = array_intersect_key($produto->listaProdutosProton(), array_diff($arrayProton, $arrayWeb));
$arrayAtualizar = array_intersect_key($produto->listaProdutosProton(), array_intersect($arrayProton, $arrayWeb));
$arrayInativar =  array_intersect_key($produto->listaProdutosWeb(), array_diff($arrayWeb, $arrayProton));

$cont = 0;
foreach ($arrayInserir as $chave => $valor){
    $produto->setCodigo($valor["CODIGO"]);
    $produto->setReferencia($valor["REFERENCIA"]);
    $produto->setDescricao($valor["DESCRICAO"]);
    $produto->setPreco($valor["PRECO"]);
    $produto->setDesconto($valor["DESCONTO"]);
    $produto->setMarca($valor["MARCA"]);
    $produto->setStatus($valor["STATUS"]);


    if ($produto->inserir()) {
        $cont++;
    } else {
       echo "Erro na importação. Gravou $cont produtos";
    }
}
echo "Importou $cont produtos com sucesso.<br>";

$cont = 0;
foreach ($arrayAtualizar as $chave => $valor){
    $produto->setCodigo($valor["CODIGO"]);
    $produto->setReferencia($valor["REFERENCIA"]);
    $produto->setDescricao($valor["DESCRICAO"]);
    $produto->setPreco($valor["PRECO"]);
    $produto->setDesconto($valor["DESCONTO"]);
    $produto->setMarca($valor["MARCA"]);
    $produto->setStatus($valor["STATUS"]);


    if ($produto->atualizar()) {
        $cont++;
    } else {
        echo "Erro na importação. Gravou $cont produtos";
    }
}
echo "Atualizou $cont produtos com sucesso.<br>";

$cont = 0;
foreach ($arrayInativar as $chave => $valor){
    $produto->setCodigo($valor["CODIGO"]);
    $produto->setReferencia($valor["REFERENCIA"]);
    $produto->setDescricao($valor["DESCRICAO"]);
    $produto->setPreco($valor["PRECO"]);
    $produto->setDesconto($valor["DESCONTO"]);
    $produto->setMarca($valor["MARCA"]);
    $produto->setStatus('N');


    if ($produto->atualizar()) {
        $cont++;
    } else {
        echo "Erro na importação. Gravou $cont produtos";
    }
}
echo "Inativou $cont produtos com sucesso.<br><br>";

// Terminamos o "contador" e exibimos
list($usec, $sec) = explode(' ', microtime());
$script_end = (float) $sec + (float) $usec;
$elapsed_time = round($script_end - $script_start, 5);

// Exibimos uma mensagem
echo 'Elapsed time: ', $elapsed_time, ' secs.<br> Memory usage: ', round(((memory_get_peak_usage(true) / 1024) / 1024), 2), 'Mb';

?>