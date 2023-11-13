function permitirApenasNumeros(event) {
    // Obtém o valor atual do campo de entrada
    let valorAtual = event.target.value;

    // Remove todos os caracteres não numéricos usando uma expressão regular
    let valorNumerico = valorAtual.replace(/[^0-9]/g, '');

    // Atualiza o valor do campo de entrada apenas com os números
    event.target.value = valorNumerico;
}