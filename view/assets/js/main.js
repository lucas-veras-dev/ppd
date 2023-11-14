$(document).ready(function () {
    $('.cpf').mask('000.000.000-00');
    $('.telefone').mask('(00) 99999-9999');
});

function permitirApenasNumeros(event) {
    // Obtém o valor atual do campo de entrada
    let valorAtual = event.target.value;

    // Remove todos os caracteres não numéricos usando uma expressão regular
    let valorNumerico = valorAtual.replace(/[^0-9]/g, '');

    // Atualiza o valor do campo de entrada apenas com os números
    event.target.value = valorNumerico;
}

function buscarCidadesPorEstado(idEstado) {
    const url = window.location.protocol + '//' + window.location.host;
    const selectCidade = document.getElementById('cidade');

    $.ajax({
        type: 'POST',
        url: url + '/ajax/buscarCidadesPorEstado.php',
        data: {
            id_estado: idEstado
        },
        dataType: "html",
        success: function (response) {
            selectCidade.innerHTML = response
        },
        error: function (error) {
            alert('Error ao realizar requisição: ' + error)
        }
    });

}

function getParams() {
    const query = location.search.slice(1);
    const partes = query.split('&');
    const parametros = {};
    partes.forEach(function (parte) {
        const chaveValor = parte.split('=');
        const chave = chaveValor[0];
        const valor = chaveValor[1];
        parametros[chave] = valor;
    });

    return parametros;
}

// mostrando mensagem na tela de error ou sucesso
const parametros = getParams();

imprimirMensagemSwal(parametros['idMsg']);