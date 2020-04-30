<?php
session_start();
require_once "../config.php";


if ($_POST) {
    //var_dump($_POST);
    if ($_POST["fAceitaTermos"] == "on") {
        require_once "../model/pessoa.class.php";
        $pessoa = new Pessoa($_SESSION["COD_USUARIO"]);

        if (isset($_POST["fCodigo"])) {
            $pessoa->setCodigo($_POST["fCodigo"]);
        }
        if (isset($_POST["fNome"])) {
            $pessoa->setNome($_POST["fNome"]);
        }
        if (isset($_POST["fUsuario"])) {
            $pessoa->setUsuario($_POST["fUsuario"]);
        }
        if (isset($_POST["fEndereco"])) {
            $pessoa->setEndereco($_POST["fEndereco"]);
        }
        if (isset($_POST["fBairro"])) {
            $pessoa->setBairro($_POST["fBairro"]);
        }
        if (isset($_POST["fCep"])) {
            $pessoa->setCep($_POST["fCep"]);
        }
        if (isset($_POST["fTelefone1"])) {
            $pessoa->setTelefone1($_POST["fTelefone1"]);
        }
        if (isset($_POST["fTelefone2"])) {
            $pessoa->setTelefone2($_POST["fTelefone2"]);
        }
        if (isset($_POST["fTelefone3"])) {
            $pessoa->setTelefone3($_POST["fTelefone3"]);
        }
        if (isset($_POST["fEmail"])) {
            $pessoa->setEmail($_POST["fEmail"]);
        }
        if (isset($_POST["fCpf"])) {
            $pessoa->setCpf($_POST["fCpf"]);
        }
        if (isset($_POST["fSenha"])) {
            $pessoa->setSenha($_POST["fSenha"]);
        }

        $pessoa->setDataUltimaAtualizacao(date("Y-m-d H:i:s"));
        $pessoa->setFlgAceiteTermo(1);

        if ($pessoa->atualizar()) {
            $pessoa->gravaAceite();
            header("Location: $url/view/pagina.php");
            //header("Location: $url/view/confirmaDados.php");
        } else {
            $_SESSION["ERRO"] = ERRO_GRAVAR_FORMULARIO;
            header("Location: $url/view/confirmaDados.php");
        }
    } else {
        $_SESSION["ERRO"] = ERRO_ACEITAR_TERMOS;
        header("Location: $url/view/confirmaDados.php");
    }
} else {
    $_SESSION["ERRO"] = ERRO_POST;
    header("Location: $url");
}