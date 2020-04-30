<div>
    <?php


    if ($_POST["fCodProduto"] != "") {
        require_once "../model/produto.class.php";
        $produto = new Produto($_POST["fCodProduto"], true);

        //echo "Fornecedor: " . $produto->getForncedor()->getDescricao() . "<br>";

        $filename = '../view/img/produtos/' . $produto->getCodigo() . '.jpg';

        if (file_exists($filename)) {
            ?>
            <a class="fancybox-effects-c" href="<?php echo $filename; ?>"
               title="<?php echo ucfirst(strtolower($produto->getDescricao())); ?>">
                <img src="<?php echo $filename; ?>" alt="<?php echo ucfirst(strtolower($produto->getDescricao())); ?>"
                     class="visualizarImagem center-block"/>
            </a>
            <small class="smallTexto center-block"><?php echo ucfirst(strtolower($produto->getDescricao())); ?></small>
            <?php
        } else {
            $filename = '../view/img/produtos/' . $produto->getCodigo() . '.png';

            if (file_exists($filename)) {
                ?>
                <a class="fancybox-effects-c" href="<?php echo $filename; ?>"
                   title="<?php echo ucfirst(strtolower($produto->getDescricao())); ?>">
                    <img src="<?php echo $filename; ?>"
                         alt="<?php echo ucfirst(strtolower($produto->getDescricao())); ?>"
                         class="visualizarImagem center-block"/>
                </a>
                <small
                    class="smallTexto center-block"><?php echo ucfirst(strtolower($produto->getDescricao())); ?></small>
                <?php
            } else
                echo '<img src="../view/img/produtos/imgNotFound.png" alt="" class="visualizarImagem">';
        }
    }
    ?>
</div>
