<?php
session_start();
set_time_limit(0);

require_once "../model/produto.class.php";
require_once "../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once "cabecalho.php"; ?>

<body>


<body>

<?php require_once "menu.php"; ?>

<div class="geral">
    <div class="panel panel-default">
        <div class="panel-body" style="font-size: 70%;">
            <!--                <h3>Proton</h3>-->
            <!--                --><?php
            //                $produto = new Produto();
            //                $arrayProton = array_column($produto->listaProdutosProton(), "CODIGO");
            //                $arrayWeb = array_column($produto->listaProdutosWeb(), "CODIGO");
            //
            //                var_dump($arrayProton);
            //                ?>
            <!--                <h3>Web</h3>-->
            <!--                --><?php
            //                var_dump($arrayWeb);
            //                ?>
            <!---->
            <!--                <h3>Inserir</h3>-->
            <!--                --><?php
            //                var_dump(array_intersect_key($produto->listaProdutosProton(), array_diff($arrayProton, $arrayWeb)));
            //                ?>
            <!---->
            <!--                <h3>Atualizar</h3>-->
            <!--                --><?php
            //                var_dump(array_intersect_key($produto->listaProdutosProton(), array_intersect($arrayProton, $arrayWeb)));
            //                ?>
            <!---->
            <!--                <h3>Inativar</h3>-->
            <!--                --><?php
            //                var_dump(array_intersect_key($produto->listaProdutosWeb(), array_diff($arrayWeb, $arrayProton)));
            //                ?>
            <?php


//            $dir = "C:/xampp/htdocs/jatoba/view/img/imagens";
//            $files1 = scandir($dir);
//            $i = 0;
//            foreach ($files1 as $chave => $valor) {
//                if ($chave > 1) {
//                    // echo "$chave: $valor<br>";
//
//                    $arquivos = scandir("$dir/$valor");
//
//                    foreach ($arquivos as $k => $v) {
//                        if ($k > 1) {
//                            if (!copy("$dir/$valor/$v", "C:/xampp/htdocs/jatoba/view/img/produtos/$v")) {
//                                echo "--------Erro ao Copiar $v<br>";
//                            } else {
//                                echo "OK<br>";
//                                $i++;
//                            }
//                        }
//                    }
//                }
//            }
//            echo "Copiado $i com sucesso!";

            ?>


        </div>

    </div>
</div>
</body>
</html>