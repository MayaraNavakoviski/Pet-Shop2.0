function validarCampos() {
    var nome = document.getElementById('nome').value.trim();
    var dono = document.getElementById('dono').value.trim();
    var raca = document.getElementById('raca').value.trim();
    var numero = document.getElementById('numero').value.trim();
    var dia = document.getElementById('dia').value.trim();
    var hora = document.getElementById('hora').value.trim();
    var sexo = document.getElementById('sexo').value.trim();
    var especie = document.getElementById('especie').value.trim();
    var servico = document.getElementById('servico').value.trim();

    let erros = [];

    if (!nome) erros.push("Informe o nome do bichano!");
    if (!dono) erros.push("Informe o dono!");
    if (!raca) erros.push("Informe a raça!");
    if (!numero) erros.push("Informe o número para contato!");
    if (!dia) erros.push("Informe o dia para agendamento de serviço");
    if (!hora) erros.push("Informe a hora para agendamento de serviço");
    if (!sexo) erros.push("Informe o sexo do bichano");
    if (!especie) erros.push("Informe a espécie do bichano");
    if (!servico) erros.push("Informe o tipo de serviço");

    if (erros.length > 0) {
        document.getElementById("mensagem").innerHTML = erros.join("<br>");
        return false;
    }
    return true;
}