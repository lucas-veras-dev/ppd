// Números de 1000 até 1999 são sucesso!
// Números de 2000 até 2999 são alertas!
// Números de 9000 até 9999 são erros!

let mensagem = new Array();
mensagem["_I18N"] = new Array();

mensagem["_I18N"]['9001'] = 'Erro no Login: Credencias inválidas, tente novamente!';
mensagem["_I18N"]['9002'] = 'Erro ao adicionar!';
mensagem["_I18N"]['9003'] = 'Erro ao atualizar!';
mensagem["_I18N"]['9004'] = 'Parâmetros não encontrados!';
mensagem["_I18N"]['9005'] = 'Dados não encontrados!';
mensagem["_I18N"]['9006'] = 'Ocorreu um erro de processamento!';

mensagem["_I18N"]['1001'] = 'Adicionado com sucesso!';
mensagem["_I18N"]['1002'] = 'Atualizado com sucesso!';
mensagem["_I18N"]['1003'] = 'Dados encontrados!';
mensagem["_I18N"]['1004'] = 'Removido com sucesso!';

function imprimirMensagemSwal(id) {
    let timer = null;
    let tipo = null;

    // timer ex: 1000 = 1s   
    if (id < 2000) {
        timer = "5000";
        tipo = "success";
    } else if (id < 3000) {
        timer = "5000";
        tipo = "warning";
    } else if (id >= 9000) {
        timer = "5000";
        tipo = "error";
    }
    if (timer && tipo) {
        Swal.fire({
            title: mensagem["_I18N"][id],
            icon: tipo
        });
    }
}

