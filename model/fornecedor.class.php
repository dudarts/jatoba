<?php

class Fornecedor
{
    private $codigo;
    private $descricao;

    /**
     * Fornecedor constructor.
     * @param $codigo
     */
    public function __construct($codigo = null)
    {
        if ($codigo) {
            $conMySQL = DB::conexao();

            $stringSQL = "SELECT * ";
            $stringSQL .= "FROM  ";
            $stringSQL .= "  fornecedor ";
            $stringSQL .= " WHERE codigo = $codigo ";

            //echo $stringSQL;

            $sql = $conMySQL->prepare($stringSQL);
            $sql->execute();
            $obj = $sql->fetchAll(PDO::FETCH_ASSOC)[0];

            $this->setCodigo($obj["codigo"]);
            $this->setDescricao($obj["descricao"]);
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


}