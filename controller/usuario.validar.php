<?php
session_start();

require_once "../model/pessoa.class.php";
require_once "../config.php";
if (isset($_POST)) {
    $_SESSION["ERRO"] = null;
    $pessoa = new Pessoa(null);


    isset($_POST["usuario"]) ? "" : $_SESSION["ERRO"] .= "Usuário Inválido. ";
    isset($_POST["password"]) ? "" : $_SESSION["ERRO"] .= "Senha Inválida. ";

    $codUsuario = addslashes(preg_replace('/[\'"#-]/', '', $_POST["usuario"]));
    $codSenha = addslashes(preg_replace('/[\'"#-]/', '', $_POST["password"]));

    $usuario = $pessoa->validar($codUsuario, $codSenha)[0];

    if ($usuario) {
        $_SESSION["COD_USUARIO"] = $usuario["codigo"];

        if ( $usuario["flgAceiteTermo"] == "" || $usuario["endereco"] == "" || $usuario["email"] == "" || $usuario["telefone1"] == "" || $usuario["mesesSemAcesso"] > TEMPO_ATUALIZAR_DADOS)
            header("Location: $url/view/confirmaDados.php");
        else {
            header("Location: $url/view/pagina.php");
        }
    } else {
        if (!$pessoa->selecionarPorCampo(array("apelido" => $codUsuario, "email" => $codUsuario, "documento" => $codUsuario), "OR")) {
            $_SESSION{"ERRO"} = ERRO_USUARIO_DESCONHECIDO;
        } elseif (!$pessoa->selecionarPorCampo(array("senha" => $codSenha))) {
            $_SESSION{"ERRO"} = ERRO_SENHA_INVALIDA;
        } else {
            $_SESSION["ERRO"] = ERRO_ACESSO_NEGADO;
        }
        header("Location: $url");
    }
} else {
    $_SESSION["ERRO"] = ERRO_FORMULARIO_LOGIN;
    header("Location: $url");
}

?>