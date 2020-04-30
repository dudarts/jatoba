<?php

/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 15/03/16
 * Time: 17:10
 */
class Funcoes
{
    public static function getStringWhereSQL($ArrayFielsValue, $operador = "AND", $validaTipo = false)
    {
        $stringSQL = " ";
        $k = 1;
        if (func_num_args() > 0) {
            $stringSQL .= " WHERE ";

            foreach ($ArrayFielsValue as $campo => $valor) {
                $stringSQL .= $campo;

                if (gettype($valor) == "string" && $validaTipo) {
                    $stringSQL .= " like ";
                    $stringSQL .= "'%" . $valor . "%'";
                } else {
                    $stringSQL .= " = '" . $valor . "'";
                }

                if ($k++ < count($ArrayFielsValue)) {
                    $stringSQL .= " $operador ";
                }

            }

        }
        return $stringSQL;
    }

    public static function queryStringSQL()
    {
        if (func_num_args() > 0) {
            $stringSQL = func_get_arg(0);

            for ($i = 1; $i < func_num_args() - 1; $i = $i + 2) {
                $stringSQL = str_replace(func_get_arg($i), func_get_arg($i + 1), $stringSQL);
            }
            return $stringSQL;
        } else {
            return false;
        }
    }

    public static function avisoErro()
    {
        echo '<div class="alert - danger" >';
        if (isset($_SESSION{"ERRO"})) {
            echo $_SESSION["ERRO"];
            $_SESSION["ERRO"] = "";
        }

        echo '</div>';
    }

//    public function renomear(){
//        $dir = "C:/xampp/htdocs/jatoba/view/img/imagens";
//        $files1 = scandir($dir);
//
//        foreach ($files1 as $chave => $valor) {
//            if ($chave > 1) {
//                // echo "$chave: $valor<br>";
//
//                $arquivos = scandir("$dir/$valor");
//
//                foreach ($arquivos as $k => $v) {
//                    $foto = explode(".", $v);
//                    if ($k > 1) {
//                        if ($valor <> $foto[0]) {
//
//
//                            if (rename("$dir/$valor/$v", "$dir/$valor/$valor.$foto[1]")){
//                                echo "Mudou de $v para $valor.$foto[1]";
//                            }
//                            //echo "Antigo: $dir/$valor/$v<br>";
//                            // echo "Novo: $dir/$valor/$valor.$foto[1]<br><br>";
//
//                        }
//                    }
//                }
//            }
//        }
//    }
}

?>