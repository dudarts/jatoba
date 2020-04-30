<?php
require_once "pdo.class.php";

class Produto
{
    private $codigo;
    private $referencia;
    private $descricao;
    private $preco;
    private $desconto;
    private $fornecedor;
    private $status;

    /**
     * Produto constructor.
     * @param null $codigo
     * @param bool $referencia Se true, busca pela referencia da revista, se false (default) busca pelo codigo.
     */

    public function __construct($codigo = null, $referencia = false)
    {
        if ($codigo) {
            $conMySQL = DB::conexao();

            $stringSQL = "SELECT * FROM produto WHERE";
            if ($referencia)
                $stringSQL .= " referencia = $codigo ";
            else
                $stringSQL .= " codigo = $codigo ";

            //echo $stringSQL;

            $sql = $conMySQL->prepare($stringSQL);
            $sql->execute();
            // var_dump($sql->fetchAll(PDO::FETCH_ASSOC));
            //if (count($sql->fetchAll(PDO::FETCH_ASSOC)) > 0) {

                $obj = @$sql->fetchAll(PDO::FETCH_ASSOC)[0];

                $this->setCodigo($obj["codigo"]);
                $this->setStatus($obj["status"]);
                $this->setDesconto($obj["desconto"]);
                $this->setDescricao($obj["descricao"]);

                require_once "fornecedor.class.php";
                $fornecedor = new Fornecedor($obj["fornecedor"]);

                $this->setFornecedor($fornecedor);
                $this->setPreco($obj["preco"]);
                $this->setReferencia($obj["referencia"]);
            //}

        }
        return $this;
    }

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
    public function getReferencia()
    {
        return $this->referencia;
    }

    /**
     * @param mixed $referencia
     */
    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getPreco()
    {
        return $this->preco;
    }

    /**
     * @param mixed $preco
     */
    public function setPreco($preco)
    {
        $this->preco = $preco;
    }

    /**
     * @return mixed
     */
    public function getDesconto()
    {
        return $this->desconto;
    }

    /**
     * @param mixed $desconto
     */
    public function setDesconto($desconto)
    {
        $this->desconto = $desconto;
    }

    /**
     * @return mixed
     */
    public function getForncedor()
    {
        return $this->fornecedor;
    }

    /**
     * @param mixed $fornecedor
     */
    public function setFornecedor($fornecedor)
    {
        $this->fornecedor = $fornecedor;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }


    public function selecionar($codigo = null, $descricao = null, $referencia = true)
    {

        $con = DB::conexao();

        $stringSQL = " SELECT * FROM Produto WHERE 1 = 1 ";

        if (func_num_args() > 0) {
            if (!is_null($codigo))
                if ($referencia)
                    $stringSQL .= " AND referencia = '$codigo'";
                else
                    $stringSQL .= " AND codigo = '$codigo'";

            if (!is_null($descricao))
                $stringSQL .= " AND descricao = '$descricao'";
        }
        $stringSQL .= ";";
        //echo $stringSQL;

        $sql = $con->prepare($stringSQL);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function listaProdutosProton()
    {
        $conOracle = new DB_ORACLE();

        $stringSQL = " SELECT ";
        $stringSQL .= "  CODIGO_PRIMARIO codigo, ";
        $stringSQL .= "  REFERENCIA referencia, ";
        $stringSQL .= "  DESCRICAO descricao, ";
        //$stringSQL .= "  F.TFOR_FANTASIA NOM_fornecedor, ";
        $stringSQL .= "  PRECO_VENDA preco, ";
        $stringSQL .= "  D.TPED_DESCONTO_FAIXA1 desconto, ";
        $stringSQL .= "  FORNECEDOR fornecedor, ";
        $stringSQL .= "  ATIVO_VENDA status ";
        $stringSQL .= " FROM  ";
        $stringSQL .= "  DBAUSER.VEDI_MERCADORIA M ";
        $stringSQL .= " INNER JOIN DBAUSER.TFOR_FORNECEDOR F ON (F.TFOR_FORNECEDOR_PK = M.FORNECEDOR) ";
        $stringSQL .= " LEFT JOIN DBAUSER.VEDI_PROMO_ITENS D ON (D. TPED_PROMOCAO_ITEM_FK_PK = 1 AND D.TPED_CODIGO_PRI_FK_PK = M.CODIGO_PRIMARIO) ";
        $stringSQL .= " WHERE M.FORNECEDOR <> 76 AND M.UNIDADE_NEGOCIOS = 1";
        $stringSQL .= " and  M.ATIVO_VENDA = 'S' ";
        $stringSQL .= " ORDER BY DESCRICAO ";

        //echo $stringSQL;

        return $conOracle->query($stringSQL);
    }

    public function listaProdutosWeb($ativos = true)
    {
        $conMySQL = DB::conexao();

        $stringSQL = "SELECT CODIGO, REFERENCIA, DESCRICAO, PRECO, DESCONTO, fornecedor, STATUS ";
        $stringSQL .= "FROM  ";
        $stringSQL .= "  produto ";
        $stringSQL .= " WHERE 1 = 1 ";

        if ($ativos) {
            $stringSQL .= " and  status = 'S' ";
        }

        $stringSQL .= "ORDER BY DESCRICAO ";

        //echo $stringSQL;

        $sql = $conMySQL->prepare($stringSQL);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function inserir()
    {
        if ($this) {
            $conMySQL = DB::conexao();

            $stringSQL = "INSERT INTO  produto VALUES (:cod, :ref, :des, :prc, :dsc, :mar, :sts);";
            $sql = $conMySQL->prepare($stringSQL);
            $sql->bindParam(":cod", $this->codigo);
            $sql->bindParam(":ref", $this->referencia);
            $sql->bindParam(":des", $this->descricao);
            $sql->bindParam(":prc", $this->preco);
            $sql->bindParam(":dsc", $this->desconto);
            $sql->bindParam(":mar", $this->fornecedor);
            $sql->bindParam(":sts", $this->status);

            return $sql->execute();
        } else {
            return false;
        }
    }

    public function atualizar()
    {
        if ($this) {
            $conMySQL = DB::conexao();

            $stringSQL = " UPDATE produto SET ";
            $stringSQL .= " REFERENCIA = :ref,";
            $stringSQL .= " DESCRICAO = :des,";
            $stringSQL .= " PRECO = :prc,";
            $stringSQL .= " DESCONTO = :dsc,";
            $stringSQL .= " fornecedor = :mar,";
            $stringSQL .= " STATUS = :sts WHERE codigo = :cod;";

            $sql = $conMySQL->prepare($stringSQL);
            $sql->bindParam(":cod", $this->codigo);
            $sql->bindParam(":ref", $this->referencia);
            $sql->bindParam(":des", $this->descricao);
            $sql->bindParam(":prc", $this->preco);
            $sql->bindParam(":dsc", $this->desconto);
            $sql->bindParam(":mar", $this->fornecedor);
            $sql->bindParam(":sts", $this->status);

            return $sql->execute();
        } else {
            return false;
        }
    }
}

