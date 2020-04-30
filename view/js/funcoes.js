// JavaScript Document

function bloquearEnter() {
    if (event.keyCode == 13) {
        event.keyCode = 0;
        return false;
    }
    return true;
}

function marcarTodos(id, form) {
    objId = eval(document.getElementById(id));
    objForm = eval(document.getElementById(form));
//	alert(objForm.elements.length);
    if (objId.checked) {
        for (i = 0; i < objForm.elements.length; i++)
            if (objForm.elements[i].type == "checkbox")
                objForm.elements[i].checked = 1;
    } else {
        for (i = 0; i < objForm.elements.length; i++)
            if (objForm.elements[i].type == "checkbox")
                objForm.elements[i].checked = 0;
    }
}

function redirecionar(url) {
    location.href = url;
}

function alerta() {
    alert('alerta de teste');
}

function carregaImagemAjax() {
    SubmitAjax('post', '../controller/ajaxCarregaImagem.php', 'form', 'divImagemAjax');
}

function carregaResumoAjax() {
    SubmitAjax('post', '../controller/ajaxResumoPedido.php', 'form', 'divResumoAjax');
}


function carregaListaProdutosPedidoAjax(form) {
    SubmitAjax('post', '../controller/ajaxListaProdutosPedido.php', form, 'divListaProdutoPedidoAjax');
    document.getElementById("fCodProduto").values = "";
    document.getElementById("fQuantidade").values = "";
    carregaResumoAjax();
}

// Set custom style, close if clicked, change title type and overlay color
$(".fancybox-effects-c").fancybox({
    wrapCSS: 'fancybox-custom',
    closeClick: true,

    openEffect: 'none',

    helpers: {
        title: {
            type: 'inside'
        },
        overlay: {
            css: {
                'background': 'rgba(238,238,238,0.85)'
            }
        }
    }
});

function mascaraTelefone() {
    jQuery("input.telefone")
        .mask("(99) 9999-9999?9")
        .focusout(function (event) {
            var target, phone, element;
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;
            phone = target.value.replace(/\D/g, ''); //Remove tudo o que não é dígito
            element = $(target);
            element.unmask();
            if (phone.length > 10) {
                element.mask("(99) 99999-999?9");
            } else {
                element.mask("(99) 9999-9999?9");
            }
        });
}

function confirmaExcluirItem(){
    return confirm("Tem certeza que deseja excluir este item?");
}