<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/model/funcoes.class.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/model/pdo.class.php");

class Usuario
{

    public function selecionar()
    {
        $con = DB::conexao();

        $stringSQL = " SELECT COD_USUARIO, COD_PESSOA FROM usuario WHERE COD_OTICA = :otica ";

        if ($pArrayParamentros != null) {
            foreach ($pArrayParamentros as $chave => $valor) {
                $stringSQL .= " AND " . $chave . " = '" . $valor . "'";
            }
        }

        $sql = $con->prepare($stringSQL);
        $sql->bindParam(":otica", $pCodOtica);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_COLUMN, 0);
    }

    public function validar($pCodOtica, $pCodUsuario, $pCodSenha)
    {
        $con = DB::conexao();

        $stringSQL = " SELECT * FROM usuario WHERE COD_OTICA = :codOtica AND COD_USUARIO = :usuario AND SENHA = md5(:senha); ";
        $sql = $con->prepare($stringSQL);
        $sql->bindParam(":codOtica", $pCodOtica);
        $sql->bindParam(":usuario", $pCodUsuario);
        $sql->bindParam(":senha", $pCodSenha);

        //echo Funcoes::queryStringSQL($stringSQL, ":codOtica", $pCodOtica, ":usuario", $pCodUsuario, ":senha", $pCodSenha);

        $sql->execute();
        if ($sql->rowCount() == 1) {
            $usuario = $sql->fetchAll(PDO::FETCH_ASSOC);
            $usuario = $usuario[0];

            $this->setCodOtica($usuario["COD_OTICA"]);
            $this->setCodUsuario($usuario["COD_USUARIO"]);
            $this->setCodFilial($usuario["COD_FILIAL"]);
            $this->setCodPermissao($usuario["COD_PERMISSAO"]);
            $this->setCodPessoa($usuario["COD_PESSOA"]);
            $this->setCodStatus($usuario["COD_STATUS"]);
            return true;
        } else {
            return false;
        }
    }

    public function salvar(Usuario $p)
    {
        $stringSQL = 'INSERT INTO usuario VALUES(';
        $stringSQL .= 'COD_USUARIO = ' . $p->codUsuario . ', ';
        $stringSQL .= 'COD_OTICA = ' . $p->codOtica . ', ';
        $stringSQL .= 'COD_PESSOA = ' . $p->codPessoa . ', ';
        $stringSQL .= 'SENHA = ' . $p->senha . ', ';
        $stringSQL .= 'COD_PERMISSAO = ' . $p->codPermissao . ', ';
        $stringSQL .= 'COD_STATUS = ' . $p->codStatus . ', ';
        $stringSQL .= 'COD_FILIAL = ' . $p->codFilial;
        $con = Conexao::getInstanciar();
        return $con->executar($stringSQL);
    }

    public function atualizar(Usuario $p)
    {
        $stringSQL = 'UPDATE usuario SET ';
        $stringSQL .= 'COD_USUARIO = ' . $p->codUsuario . ', ';
        $stringSQL .= 'COD_OTICA = ' . $p->codOtica . ', ';
        $stringSQL .= 'COD_PESSOA = ' . $p->codPessoa . ', ';
        $stringSQL .= 'SENHA = ' . $p->senha . ', ';
        $stringSQL .= 'COD_PERMISSAO = ' . $p->codPermissao . ', ';
        $stringSQL .= 'COD_STATUS = ' . $p->codStatus . ', ';
        $stringSQL .= 'COD_FILIAL = ' . $p->codFilial;
        $stringSQL .= 'WHERE COD_ARMACAO = ' . $p->codArmacao;

        $con = Conexao::getInstanciar();
        return $con->executar($stringSQL);
    }

    public function excluir()
    {
        if (func_num_args() > 0) {
            $stringSQL = ' delete from usuario';

            $stringSQL .= Funcoes::getStringWhereSQL(func_get_args());

            $con = Conexao::getInstanciar();
            return $con->executar($stringSQL);
        } else {
            return false;
        }

    }


}
