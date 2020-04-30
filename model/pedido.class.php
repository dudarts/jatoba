<?php
require_once "pdo.class.php";

class Pedido
{
    private $codigo;
    private $codigoPessoa;
    private $dataPedido;
    private $dataDownload;
    private $status;
    private $formaPagamento;
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
    public function getCodigoPessoa()
    {
        return $this->codigoPessoa;
    }

    /**
     * @param mixed $codigoPessoa
     */
    public function setCodigoPessoa($codigoPessoa)
    {
        $this->codigoPessoa = $codigoPessoa;
    }

    /**
     * @return mixed
     */
    public function getDataPedido()
    {
        return $this->dataPedido;
    }

    /**
     * @param mixed $dataPedido
     */
    public function setDataPedido($dataPedido)
    {
        $this->dataPedido = $dataPedido;
    }

    /**
     * @return mixed
     */
    public function getDataDownload()
    {
        return $this->dataDownload;
    }

    /**
     * @param mixed $dataDownload
     */
    public function setDataDownload($dataDownload)
    {
        $this->dataDownload = $dataDownload;
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

    /**
     * @return mixed
     */
    public function getFormaPagamento()
    {
        return $this->formaPagamento;
    }

    /**
     * @param mixed $formaPagamento
     */
    public function setFormaPagamento($formaPagamento)
    {
        $this->formaPagamento = $formaPagamento;
    }


    /**
     * Pedido constructor.
     * @param null $codigo
     * @param bool $cliente
     * @param bool $aberto
     */
    public function __construct($codigo = null, $cliente = false, $aberto = true)
    {
        if ($codigo) {
            $conMySQL = DB::conexao();

            $stringSQL = "SELECT * FROM pedido WHERE 1=1 ";

            if ($cliente)
                $stringSQL .= " AND codigoPessoa = $codigo";
            else
                $stringSQL .= " AND codigo = $codigo";

            if ($aberto)
                $stringSQL .= " AND status = 1";
            else
                $stringSQL .= " AND status = 0";

            //echo $stringSQL;

            $sql = $conMySQL->prepare($stringSQL);
            $sql->execute();
            $obj = @$sql->fetchAll(PDO::FETCH_ASSOC)[0];

            $this->setCodigo($obj["codigo"]);
            $this->setStatus($obj["status"]);
            $this->setCodigoPessoa($obj["codigoPessoa"]);
            $this->setDataDownload($obj["dataDownload"]);
            $this->setDataPedido($obj["dataPedido"]);
            $this->setFormaPagamento($obj["formaPagamento"]);
        }
        return $this;
    }

    public function selecionar($pedido = null, $produto = null)
    {
        $con = DB::conexao();
        $stringSQL = "SELECT * FROM Pedido_Produto WHERE 1 = 1 ";

        if (func_num_args() > 0) {
            if (!is_null($pedido))
                $stringSQL .= " AND pedido = $pedido";

            if (!is_null($produto)) {
                $stringSQL .= " AND produto = '$produto'";
            }
        }

        $sql = $con->prepare($stringSQL);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function atualizarPedido($codPedido, $codProduto, $quantidade, $valorUnitario, $valorCompra, $valorVenda, $valorLucro)
    {
        $con = DB::conexao();

        $stringSQL = "UPDATE Pedido_Produto
                      SET quantidade = $quantidade,
                      valorUnitario = $valorUnitario,
                      valorCompra =  $valorCompra,
                      valorVenda = $valorVenda,
                      valorLucro = $valorLucro
                      WHERE pedido = $codPedido AND produto = $codProduto";

        //echo $stringSQL;
        //exit;
        $sql = $con->prepare($stringSQL);
        return $sql->execute();
    }


    public function inserirNoPedido($codPedido, $codProduto, $quantidade, $valorUnitario,
                                    $valorCompra, $valorVenda, $valorLucro, $dataInclusao)
    {
        $con = DB::conexao();

        $stringSQL = "INSERT INTO Pedido_Produto
                      VALUES (:codPedido, :codProduto, :quantidade, :valorUnitario, 
                              :valorCompra, :valorVenda, :valorLucro, :dataInclusao)";
        $sql = $con->prepare($stringSQL);
        $sql->bindParam(":codPedido", $codPedido);
        $sql->bindParam(":codProduto", $codProduto);
        $sql->bindParam(":quantidade", $quantidade);
        $sql->bindParam(":valorUnitario", $valorUnitario);
        $sql->bindParam(":valorCompra", $valorCompra);
        $sql->bindParam(":valorVenda", $valorVenda);
        $sql->bindParam(":valorLucro", $valorLucro);
        $sql->bindParam(":dataInclusao", $dataInclusao);

        return $sql->execute();
    }

    public function novo()
    {
        $con = DB::conexao();

        if ($this->getCodigoPessoa()) {
            $stringSQL = "INSERT INTO pedido (dataPedido, status, codigoPessoa)
                      VALUES ( now(), 1, :codigoPessoa)";

            echo $stringSQL;

            $sql = $con->prepare($stringSQL);
            $sql->bindValue("codigoPessoa", $this->getCodigoPessoa());

            return $sql->execute();
        } else {
            return false;
        }
    }

    public function listarProdutos($codPedido)
    {
        $con = DB::conexao();

        $stringSQL = "SELECT pp.*, p.descricao, f.codigo codMarca, f.descricao marca, p.codigo FROM Pedido_Produto pp
                      INNER JOIN produto p ON (p.referencia = pp.produto)
                      INNER JOIN fornecedor f ON (f.codigo = p.fornecedor)
                      WHERE pp.pedido = :codPedido";

        $sql = $con->prepare($stringSQL);
        $sql->bindParam(":codPedido", $codPedido);

        //echo $stringSQL;

        $sql->execute();
        return $sql->fetchAll();
    }

    public function resumoPedido(){
        $con = DB::conexao();

        $stringSQL = "	SELECT SUM(quantidade) TOTAL_PRODUTOS, SUM(valorCompra) TOTAL_COMPRA, SUM(valorVenda) TOTAL_VENDA, SUM(valorLucro) TOTAL_LUCRO
                        FROM jatoba.pedido_produto WHERE pedido =  :codPedido";

        $sql = $con->prepare($stringSQL);
        $sql->bindParam(":codPedido", $this->codigo);

        //echo $stringSQL;

        $sql->execute();
        return $sql->fetchAll();
    }

    public function excluir($produto){
        $con = DB::conexao();

        if ($this){
            $stringSQL = "DELETE FROM pedido_produto WHERE pedido = :pedido AND produto = :produto";

            $sql = $con->prepare($stringSQL);
            $sql->bindValue(":pedido", $this->codigo);
            $sql->bindValue(":produto", $produto);
            //echo $stringSQL;
            return $sql->execute();
        } else {
            return false;
        }

    }

}