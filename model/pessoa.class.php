<?php
require_once "pdo.class.php";
require_once "funcoes.class.php";

/**
 * Created by PhpStorm.
 * User: Eduardo.Mendes
 * Date: 04/11/2016
 * Time: 09:17
 */
class Pessoa
{
    private $codigo;
    private $nome;
    private $usuario;
    private $endereco;
    private $bairro;
    private $cep;
    private $telefone1;
    private $telefone2;
    private $telefone3;
    private $email;
    private $cpf;
    private $senha;
    private $ativo;
    private $saldoDevedor;
    private $limiteCredito;
    private $dataUltimoAcesso;
    private $dataUltimaAtualizacao;
    private $flgAceiteTermo;

    /**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return mixed
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @param mixed $endereco
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    /**
     * @return mixed
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * @param mixed $bairro
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    /**
     * @return mixed
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * @param mixed $cep
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    /**
     * @return mixed
     */
    public function getTelefone1()
    {
        return $this->telefone1;
    }

    /**
     * @param mixed $telefone1
     */
    public function setTelefone1($telefone1)
    {
        $this->telefone1 = $telefone1;
    }

    /**
     * @return mixed
     */
    public function getTelefone2()
    {
        return $this->telefone2;
    }

    /**
     * @param mixed $telefone2
     */
    public function setTelefone2($telefone2)
    {
        $this->telefone2 = $telefone2;
    }

    /**
     * @return mixed
     */
    public function getTelefone3()
    {
        return $this->telefone3;
    }

    /**
     * @param mixed $telefone3
     */
    public function setTelefone3($telefone3)
    {
        $this->telefone3 = $telefone3;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    /**
     * @return mixed
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * @param mixed $ativo
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }

    /**
     * @return mixed
     */
    public function getSaldoDevedor()
    {
        return $this->saldoDevedor;
    }

    /**
     * @param mixed $saldoDevedor
     */
    public function setSaldoDevedor($saldoDevedor)
    {
        $this->saldoDevedor = $saldoDevedor;
    }

    /**
     * @return mixed
     */
    public function getLimiteCredito()
    {
        return $this->limiteCredito;
    }

    /**
     * @param mixed $limiteCredito
     */
    public function setLimiteCredito($limiteCredito)
    {
        $this->limiteCredito = $limiteCredito;
    }

    /**
     * @return mixed
     */
    public function getDataUltimoAcesso()
    {
        return $this->dataUltimoAcesso;
    }

    /**
     * @param mixed $dataUltimoAcesso
     */
    public function setDataUltimoAcesso($dataUltimoAcesso)
    {
        $this->dataUltimoAcesso = $dataUltimoAcesso;
    }

    /**
     * @return mixed
     */
    public function getDataUltimaAtualizacao()
    {
        return $this->dataUltimaAtualizacao;
    }

    /**
     * @param mixed $dataUltimaAtualizacao
     */
    public function setDataUltimaAtualizacao($dataUltimaAtualizacao)
    {
        $this->dataUltimaAtualizacao = $dataUltimaAtualizacao;
    }

    /**
     * @return mixed
     */
    public function getFlgAceiteTermo()
    {
        return $this->flgAceiteTermo;
    }

    /**
     * @param mixed $flgAceiteTermo
     */
    public function setFlgAceiteTermo($flgAceiteTermo)
    {
        $this->flgAceiteTermo = $flgAceiteTermo;
    }



    public function listaPessoasProton()
    {
        $conOracle = new DB_ORACLE();

        $stringSQL = "SELECT  ";
        $stringSQL .= "  C.TCLI_CLIENTE_PK CODIGO,  ";
        $stringSQL .= "  C.TCLI_NOME_RAZAO NOME, ";
        $stringSQL .= "  C.TCLI_FANTASIA USUARIO, ";
        $stringSQL .= "  C.TCLI_ENDERECO ENDERECO, ";
        $stringSQL .= "  C.TCLI_BAIRRO BAIRRO, ";
        $stringSQL .= "  C.TCLI_CIDADE_CEP_FK CEP,   ";
        $stringSQL .= "  '(' || C.TCLI_FONE1_DDD || ')' || ' ' || C.TCLI_FONE1_PREFIXO || '-' || C.TCLI_FONE1_FINAL TELEFONE1, ";
        $stringSQL .= "  '(' || C.TCLI_FONE2_DDD || ')' || ' ' || C.TCLI_FONE2_PREFIXO || '-' || C.TCLI_FONE2_FINAL TELEFONE2, ";
        $stringSQL .= "  '(' || C.TCLI_FAX_DDD || ')' || ' ' || C.TCLI_FAX_PREFIXO || '-' || C.TCLI_FAX_FINAL TELEFONE3, ";
        $stringSQL .= "  C.TCLI_EMAIL EMAIL,  ";
        $stringSQL .= "  C.TCLI_NUM_cpf cpf,   ";
        $stringSQL .= "  U.TLNK_SALDO_DEVEDOR SALDO_DEVEDOR, ";
        $stringSQL .= "  U.TLNK_LIMITE_CREDITO LIMITE_CREDITO, ";
        $stringSQL .= "  U.TLNK_ATIVO ";
        $stringSQL .= "FROM  ";
        $stringSQL .= "  DBAUSER.TCLI_CLIENTE C ";
        $stringSQL .= "INNER JOIN DBAUSER.TLNK_CLIENTE_UNIDADE U ON (U.TLNK_CLIENTE_FK_PK = C.TCLI_CLIENTE_PK) ";
        $stringSQL .= "INNER JOIN TLOC_CIDADE_CEP CEP ON (CEP.TLOC_CIDADE_CEP_PK = C.TCLI_CIDADE_CEP_FK) ";
        $stringSQL .= "WHERE U.TLNK_UNIDADE_FK_PK = 1 AND TLOC_NOME = 'FEIRA DE SANTANA'; ";

        //echo $stringSQL;

        return $conOracle->query($stringSQL);
    }

    public function listaPessoasWeb($ativos = true)
    {
        $conMySQL = DB::conexao();

        $stringSQL = "SELECT * ";
        $stringSQL .= "FROM  ";
        $stringSQL .= "  produto ";
        $stringSQL .= " WHERE 1 = 1 ";

        if ($ativos) {
            $stringSQL .= " and  ativo = 'S' ";
        }

        $stringSQL .= "ORDER BY NOME ";

        //echo $stringSQL;

        $sql = $conMySQL->prepare($stringSQL);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function __construct($codigo)
    {
        if ($codigo) {
            $conMySQL = DB::conexao();

            $stringSQL = "SELECT * ";
            $stringSQL .= "FROM  ";
            $stringSQL .= "  pessoa ";
            $stringSQL .= " WHERE codigo = $codigo ";

            //echo $stringSQL;

            $sql = $conMySQL->prepare($stringSQL);
            $sql->execute();
            $obj = $sql->fetchAll(PDO::FETCH_ASSOC)[0];

            $this->setCodigo($obj["codigo"]);
            $this->setNome($obj["nome"]);
            $this->setUsuario($obj["usuario"]);
            $this->setEndereco($obj["endereco"]);
            $this->setBairro($obj["bairro"]);
            $this->setCep($obj["cep"]);
            $this->setTelefone1($obj["telefone1"]);
            $this->setTelefone2($obj["telefone2"]);
            $this->setTelefone3($obj["telefone3"]);
            $this->setEmail($obj["email"]);
            $this->setCpf($obj["cpf"]);
            $this->setSenha($obj["senha"]);
            $this->setAtivo($obj["ativo"]);
            $this->setSaldoDevedor($obj["saldoDevedor"]);
            $this->setLimiteCredito($obj["limiteCredito"]);
            $this->setDataUltimaAtualizacao($obj["dataUltimaAtualizacao"]);
            $this->setDataUltimoAcesso($obj["dataUltimoAcesso"]);
            $this->setFlgAceiteTermo($obj["flgAceiteTermo"]);
            return $this;
        }
    }

    public function selecionarPorCampo($param, $operador = "AND")
    {
        if (is_array($param)) {

            $conMySQL = DB::conexao();

            $stringSQL = "SELECT * FROM jatoba.pessoa";
            $stringSQL .= Funcoes::getStringWhereSQL($param, $operador);
            $stringSQL .= ";";

            //echo $stringSQL;
            //exit;

            $sql = $conMySQL->prepare($stringSQL);
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function inserir()
    {
        if ($this) {
            $conMySQL = DB::conexao();

            $stringSQL = "INSERT INTO  pessoa 
                          VALUES (:codigo, :nome, :usuario, :endereco, :bairro, :cep, :telefone1, :telefone2, :telefone3, 
                          :email, :cpf, :senha, :ativo, :saldoDevedor, :limiteCredito);";
            $sql = $conMySQL->prepare($stringSQL);
            $sql->bindParam(":cod", $this->codigo);
            $sql->bindParam(":ref", $this->referencia);
            $sql->bindParam(":des", $this->descricao);
            $sql->bindParam(":prc", $this->preco);
            $sql->bindParam(":dsc", $this->desconto);
            $sql->bindParam(":mar", $this->marca);
            $sql->bindParam(":sts", $this->status);

            echo $stringSQL;
            exit;

            return $sql->execute();
        } else {
            return false;
        }
    }

    public function atualizar()
    {
        if ($this) {
            $conMySQL = DB::conexao();

            $stringSQL = " UPDATE jatoba.pessoa SET
                            nome = :nome,
                            usuario = :usuario,
                            endereco = :endereco,
                            bairro = :bairro,
                            cep = :cep,
                            telefone1 = :telefone1,
                            telefone2 = :telefone2,
                            telefone3 = :telefone3,
                            email = :email,
                            cpf = :cpf,
                            senha = :senha,
                            ativo = :ativo,
                            saldoDevedor = :saldoDevedor,
                            limiteCredito = :limiteCredito,
                            dataUltimoAcesso = :dataUltimoAcesso,
                            dataUltimaAtualizacao = :dataUltimaAtualizacao,
                            flgAceiteTermo = :flgAceiteTermo
                            WHERE codigo = :codigo;";

            $sql = $conMySQL->prepare($stringSQL);
            $sql->bindValue("codigo", $this->getCodigo());
            $sql->bindValue("nome", $this->getNome());
            $sql->bindValue("usuario", $this->getUsuario());
            $sql->bindValue("endereco", $this->getEndereco());
            $sql->bindValue("bairro", $this->getBairro());
            $sql->bindValue("cep", $this->getCep());
            $sql->bindValue("telefone1", $this->getTelefone1());
            $sql->bindValue("telefone2", $this->getTelefone2());
            $sql->bindValue("telefone3", $this->getTelefone2());
            $sql->bindValue("email", $this->getEmail());
            $sql->bindValue("cpf", $this->getCpf());
            $sql->bindValue("senha", $this->getSenha());
            $sql->bindValue("ativo", $this->getAtivo());
            $sql->bindValue("saldoDevedor", $this->getSaldoDevedor());
            $sql->bindValue("limiteCredito", $this->getLimiteCredito());
            $sql->bindValue("dataUltimoAcesso", $this->getDataUltimoAcesso());
            $sql->bindValue("dataUltimaAtualizacao", $this->getDataUltimaAtualizacao());
            $sql->bindValue("flgAceiteTermo", $this->getFlgAceiteTermo());

            //echo $this->getBairro();
            //echo $stringSQL;
            //exit;

            return $sql->execute();
            // $sql->debugDumpParams();

            // exit;

        } else {
            return false;
        }
    }

    public function validar($usuario, $senha)
    {
        $conMySQL = DB::conexao();

        $stringSQL = "SELECT *, period_diff(date_format(now(), '%Y%m'), date_format(ifnull(dataUltimaAtualizacao, date('1900-01-01')), '%Y%m')) mesesSemAcesso  
                      FROM jatoba.pessoa
                      WHERE (usuario = '$usuario' OR cpf = '$usuario' OR email = '$usuario') 
                      AND senha = md5('$senha');";

        $sql = $conMySQL->prepare($stringSQL);
        $sql->execute();
        $pessoa = $sql->fetchAll(PDO::FETCH_ASSOC);

        if (count($pessoa) == 1) {
            return $pessoa;
        } else {
            return false;
        }
    }

    public function gravaAceite()
    {
        require_once "../config.php";
        $conMySQL = DB::conexao();

        $stringSQL = "INSERT INTO pessoa_aceite SET codigo = :codigo, dataAceite = now(), versaoTermo  = '" . VERSAO_TERMOS_E_CONDICOES . "'";
        $sql = $conMySQL->prepare($stringSQL);
        $sql->bindValue(":codigo", $this->getCodigo());

        return $sql->execute();

    }
}