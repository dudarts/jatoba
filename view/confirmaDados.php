<?php
session_start();
require_once "../model/pessoa.class.php";

$pessoa = new Pessoa(null);
$pessoa = $pessoa->selecionarPorCampo(array("codigo" => $_SESSION["COD_USUARIO"]))[0];

?>
<!DOCTYPE html>
<html lang="en">
<?php require_once "cabecalho.php"; ?>

<body>


<body>

<?php //require_once "menu.php"; ?>

<div class="geral">
    <div style="width: 50%;margin: auto; padding: 2%;">
        <div class="panel panel-default col-centered ">
            <div class="panel-body ">
                <?php Funcoes::avisoErro(); ?>
                <form action="../controller/cliente.cadastrar.php" method="post">
                    <div class="form-group left">
                        <?php
                        if ($_SESSION["COD_USUARIO"]) {
                            ?>
                            <div class="form-group col-lg-5">
                                <label for="exampleInputEmail1">Código do Cliente</label>
                                <input type="text" class="form-control" id="codigo" name="fCodigo"
                                       value="<?php echo $pessoa["codigo"]; ?>" disabled>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="form-group col-lg-7">
                            <label for="exampleInputEmail1">Usuário</label>
                            <input type="text" class="form-control" id="usuario" name="fUsuario"  required
                                   value="<?php echo $pessoa["usuario"]; ?>">
                        </div>
                        <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.
                        </small>-->
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="exampleInputPassword1">Nome</label>
                        <input type="text" class="form-control" id="nome" name="fNome" placeholder="Nome Completo" required
                               value="<?php echo $pessoa["nome"]; ?>">
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="exampleInputPassword1">Endereço</label>
                        <input type="text" class="form-control" id="endereco" name="fEndereco" placeholder="" required
                               value="<?php echo $pessoa["endereco"]; ?>">
                    </div>
                    <div class="form-group">
                        <div class=" form-group col-lg-7">
                            <label for="exampleInputPassword1">Bairro</label>
                            <input type="text" class="form-control" id="bairro" name="fBairro" placeholder="" required
                                   value="<?php echo $pessoa["bairro"]; ?>">
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="exampleInputPassword1">CEP</label>
                            <input type="text" class="form-control" id="cep" name="fCep" placeholder="" required
                                   value="<?php echo $pessoa["cep"]; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group col-lg-4">
                            <label for="telefone1">Telefone</label>
                            <input type="text" class="form-control telefone" id="telefone1" name="fTelefone1" placeholder="" required
                                   value="<?php echo $pessoa["telefone1"]; ?>">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="exampleInputPassword1">Celular</label>
                            <input type="text" class="form-control telefone" id="telefone2" name="fTelefone2" placeholder="" required
                                   value="<?php echo $pessoa["telefone2"]; ?>">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="exampleInputPassword1">Celular 2</label>
                            <input type="text" class="form-control telefone" id="telefone3" name="fTelefone3" placeholder="" required
                                   value="<?php echo $pessoa["telefone3"]; ?>">
                        </div>

                    </div>
                    <div class="form-group form-group">
                        <div class="form-group col-lg-8">
                            <label for="exampleInputPassword1">E-mail</label>
                            <input type="text" class="form-control" id="email" name="fEmail" placeholder="" required
                                   value="<?php echo $pessoa["email"]; ?>">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="exampleInputPassword1">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="fCpf" placeholder="" required disabled
                                   value="<?php echo $pessoa["cpf"]; ?>">
                        </div>
                    </div>
                    <?php
                    if (!isset($_SESSION["COD_USUARIO"])) {
                        ?>
                        <div class="form-group form-group">
                            <div class="form-group col-lg-6">
                                <label for="exampleInputPassword1">Senha</label>
                                <input type="password" class="form-control" id="senha" name="fSenha" placeholder="" required
                                       value="<?php echo $pessoa["email"]; ?>">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="exampleInputPassword1">Confirmar Senha</label>
                                <input type="password" class="form-control" id="confirmaSenha" name="fConfirmaSenha" placeholder="" required
                                       value="<?php echo $pessoa["documento"]; ?>">
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="form-group col-lg-12 table-bordered">
                        <iframe src="arq/TERMOS%20E%20CONDIÇÕES%20DE%20USO.html" width="100%" height="100" style="border: none;"></iframe>
                    </div>

                    <div class="form-group col-lg-6">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="fAceitaTermos" required>
                                Li e aceito os <a href="arq/TermosDeUso.pdf" target="_blank"
                                                  title="Clique aqui para visualizar o Termos de Uso do sistema web">Termos
                                    de Uso</a>
                            </label>
                        </div>
                    </div>

                    <div class="form-group form-group col-lg-6">
                        <button type="submit" name="fBtnSalvar" class="btn btn-primary col-lg-12">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    $('#cep').mask('99.999-999');
    $('#cpf').mask('999.999.999-99');
    mascaraTelefone();
</script>

