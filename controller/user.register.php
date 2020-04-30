<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/model/usuario.class.php");

class UsuarioController
{
    /**
     * @param $post
     */
    public function salvar($post)
    {
        $usuario = new Usuario($post["pCodUsuario"],
            $post["pCodOtica"],
            $post["codPessoa"],
            $post["senha"],
            $post["codPermissao"],
            $post["codStatus"],
            $post["codFilial"]
        );
        $usuario->salvar($usuario);
    }

    public function validar($pCodUsuario)
    {
        $usuario = new Usuario($pCodUsuario);
        $rs = $usuario->selecionar(array("COD_USUARIO" => $pCodUsuario));


    }
}