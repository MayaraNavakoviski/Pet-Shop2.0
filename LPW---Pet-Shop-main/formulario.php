<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("DAO/AnimalDAO.php");
require_once("util/Conexao.php");

$dao = new AnimalDAO();

// Buscar os animais já salvos na base de dados
$animais = $dao->buscarAnimais();

$msgErro = "";
$nome = "";
$dono = "";
$raca = "";
$numero = "";
$link = "";
$dia = "";
$hora = "";
$sexo = "";
$especie = "";
$servico = "";

// Inicialize a variável $erros para evitar erros de acesso
$erros = array(
    "nome" => "",
    "dono" => "",
    "raca" => "",
    "numero" => "",
    "dia" => "",
    "hora" => "",
    "sexo" => "",
    "especie" => "",
    "servico" => ""
);

// Verificar se o usuário já clicou no Salvar
if (isset($_POST["nome"])) {
    // Obter os valores digitados pelo usuário
    $nome = trim($_POST["nome"]);
    $dono  = trim($_POST["dono"]);
    $raca = $_POST["raca"];
    $numero = $_POST["numero"];
    $link = $_POST["link"];
    $dia = $_POST["dia"];
    $hora = $_POST["hora"];
    $sexo = $_POST["sexo"];
    $especie = $_POST["especie"];
    $servico = $_POST["servico"];

    // Validar os dados
    if (!$nome) $erros["nome"] = 'Informe o nome do bichano!';
    if (!$dono) $erros["dono"] = 'Informe o nome do dono!';
    if (!$raca) $erros["raca"] = 'Informe a raça!';
    if (!$numero) $erros["numero"] = 'Informe o número!';
    if (!$dia) $erros["dia"] = 'Informe a data!';
    if (!$hora) $erros["hora"] = 'Informe a hora!';
    if (!$sexo) $erros["sexo"] = 'Informe o sexo!';
    if (!$especie) $erros["especie"] = 'Informe a espécie!';
    if (!$servico) $erros["servico"] = 'Informe o serviço!';

    // Se não houver erros, pode prosseguir com o cadastro no banco de dados
    if (count(array_filter($erros)) == 0) {
        $sucesso = $dao->inserirAnimal($nome, $dono, $raca, $numero, $link, $dia, $hora, $sexo, $especie, $servico);
        if ($sucesso) {
            header("location: formulario.php");
            exit;
        } else {
            $msgErro = "Um serviço já foi marcado para este animal, na mesma data e hora!";
            echo "<script>alert('$msgErro');</script>";
        }
    } else {
        $msgErro = implode("<br>", array_filter($erros));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>


<body class="bg-gradient-to-r from-violet-950 via-violet-950 to-purple-950 m-auto min-h-screen flex justify-center text-center content-center items-center">
    <a href="index.html"
        class="fixed top-4 left-4 z-50 inline-flex items-center bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-5 rounded shadow transition-all duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Voltar
    </a>
    <!-- Logo centralizada acima do formulário -->
    <div class="fixed top-2  left-0 right-0 flex justify-center ">
        <img src="imagens/logo.jpg" alt="Logo Pet Shop" class="w-20 h-20 rounded-full shadow-lg border-4 border-violet-700 bg-white object-cover" />
    </div>

    <div class="bg-indigo-950 mx-auto px-* rounded-xl mt-28 p-4 w-[500px] text-left shadow-2xl ">
        <div class="flex items-center gap-2 mb-4">

        </div>
        <h2 class="text-3xl font-bold text-violet-300 drop-shadow h2 bg-gray-700 rounded-xl items-center text-center text-white p-2">Insira os dados do pet para agendar um serviço </h2>

        <div class="p-4 text-left ml-4 ">
            <form class="pt-4" method="POST"
                action="">
                <input class="input rounded-md bg-gray-200 placeholder-gray-500 ml-2 p-2 text-left" type="text" name="nome" placeholder="Insira o nome do bichano"
                    value="<?php echo $nome ?>" />
                <br>
                <span class="text-red-500 text-sm pl-2"><?php echo $erros["nome"]; ?></span>
                <br><br>

                <input class="input rounded-md bg-gray-200 placeholder-gray-500 ml-2 p-2" type="text" name="dono" placeholder="Insira o nome do Dono " value="<?php echo $dono ?>" />
                <br>
                <span class="text-red-500 text-sm pl-2"><?php echo $erros["dono"]; ?></span>
                <br><br>

                <input class="input rounded-md bg-gray-200 placeholder-gray-500 ml-2 p-2" type="text" name="raca" placeholder="Insira a raça" value="<?php echo $raca ?>" />
                <br>
                <span class="text-red-500 text-sm pl-2"><?php echo $erros["raca"]; ?></span><br><br>

                <input
                    class="input rounded-md bg-gray-200 placeholder-gray-500 ml-2 p-2"
                    type="text"
                    name="numero"
                    placeholder="Número para contato"
                    value="<?php echo htmlspecialchars($numero) ?>"
                    id="numero"
                    maxlength="15" />
                <br>
                <span class="text-red-500 text-sm pl-2"><?php echo $erros["numero"]; ?></span>
                <br><br>

                <input class="input rounded-md bg-gray-200 placeholder-gray-500 ml-2 p-2" type="text" name="link" placeholder="Insira o link da foto dele(a)" value="<?php echo $link ?>" />
                <br><br>
                <input class="input rounded-md bg-gray-200 placeholder-gray-500 ml-2 p-2 text-left cursor-pointer" type="date" name="dia" placeholder="Dia do atendimento: " value="<?php echo $dia ?>" id="dia" title="Selecione a data do atendimento do pet" />
                <br>
                <span class="text-red-500 text-sm pl-2"><?php echo $erros["dia"]; ?></span><br><br>

                <input class="input rounded-md bg-gray-200 placeholder-gray-500 ml-2 p-2 cursor-pointer" type="time" name="hora" placeholder="Hora do atendimento: " value="<?php echo $hora ?>" title="Selecione a hora do atendimento do pet" />
                <br>
                <span class="text-red-500 text-sm pl-2"><?php echo $erros["hora"]; ?></span><br><br>


                <div class="rounded-md bg-gray-2 text-left">
                    <!-- div do select para o sexo -->
                    <div style="margin-bottom: 10px;">

                        <select name="sexo" id="sexo" class="input rounded-md bg-gray-200 placeholder-gray-500 ml-2 p-2 text-left cursor-pointer">

                            <option value="">---Selecione o sexo do bichano---</option>
                            <!-- Com o selected, mesmo que recarregue a página o valor colocado vai sem manter -->
                            <option value="F" <?php if ($sexo == 'F') {
                                                    echo "selected";
                                                } ?>>Fêmea</option>
                            <option value="M" <?php if ($sexo == 'M') {
                                                    echo "selected";
                                                } ?>>Macho</option>

                        </select>
                        <br>
                        <span class="text-red-500 text-sm pl-2"><?php echo $erros["sexo"]; ?></span>
                    </div>


                    <!-- div do select para especie -->
                    <div style="margin-bottom: 10px;">

                        <select name="especie" id="especie" class="input rounded-md bg-gray-200 placeholder-gray-500 ml-2 p-2 cursor-pointer">

                            <option value="">---Selecione a espécie---</option>
                            <!-- Com o selected, mesmo que recarregue a página o valor colocado vai sem manter -->
                            <option value="C" <?php if ($especie == 'C') {
                                                    echo "selected";
                                                } ?>>Cachorro</option>
                            <option value="G" <?php if ($especie == 'G') {
                                                    echo "selected";
                                                } ?>>Gato</option>
                            <option value="P" <?php if ($especie == 'P') {
                                                    echo "selected";
                                                } ?>>Pássaros</option>

                            <option value="X" <?php if ($especie == 'X') {
                                                    echo "selected";
                                                } ?>>Peixes</option>
                            <option value="R" <?php if ($especie == 'R') {
                                                    echo "selected";
                                                } ?>>Roedores</option>
                            <option value="E" <?php if ($especie == 'E') {
                                                    echo "selected";
                                                } ?>>Répteis</option>
                        </select>
                        <br>
                        <span class="text-red-500 text-sm pl-2"><?php echo $erros["especie"]; ?></span>
                    </div>




                    <!-- div do select para o serviço -->
                    <div style="margin-bottom: 10px;">

                        <select name="servico" id="servico" class="input rounded-md bg-gray-200 placeholder-gray-500 ml-2 p-2 cursor-pointer">

                            <option value="">---Selecione o serviço desejado---</option>
                            <!-- Com o selected, mesmo que recarregue a página o valor colocado vai sem manter -->
                            <option value="B" <?php if ($servico == 'B') {
                                                    echo "selected";
                                                } ?>>Banho</option>
                            <option value="T" <?php if ($servico == 'T') {
                                                    echo "selected";
                                                } ?>>Tosa</option>
                            <option value="N" <?php if ($servico == 'N') {
                                                    echo "selected";
                                                } ?>>Banho e Tosa</option>
                            <option value="C" <?php if ($servico == 'C') {
                                                    echo "selected";
                                                } ?>>Consulta</option>

                        </select>
                        <br>
                        <span class="text-red-500 text-sm pl-2"><?php echo $erros["servico"]; ?></span>
                    </div>




                </div>
        </div>

        <button class="bg-green-900 rounded ml-2 p-2 text-white hover:scale-105 transition-transform duration-200" type="submit">Enviar</button>
        </form>

    </div>














    <table class="table-auto border border-white text-white m-auto">
        <tr>
            <th class="border border-white p-4">ID</th>
            <th class="border border-white p-4">Nome</th>
            <th class="border border-white p-4">Dono</th>
            <th class="border border-white p-4">Raça</th>
            <th class="border border-white p-4">Número</th>
            <th class="border border-white p-4">Data</th>
            <th class="border border-white p-4">Hora</th>
            <th class="border border-white p-4">Sexo</th>
            <th class="border border-white p-4">Espécie</th>
            <th class="border border-white ">Serviço</th>
        </tr>

        <?php foreach ($animais as $a) : ?> <!-- O : é pra não usar chave -->

            <tr>
                <td class="border border-white p-4"><?= $a["id"] ?></td> <!-- O igual é basicamente para escrever sem escrever php -->
                <td class="border border-white p-4"><?= $a["nome"] ?></td>
                <td class="border border-white p-4"><?= $a["dono"] ?></td>
                <td class="border border-white p-4"><?= $a["raca"] ?></td>
                <td class="border border-white p-4"><?= $a["numero"] ?></td>
                <td class="border border-white p-4"><?= date('d/m/Y', strtotime($a["dia"])) ?></td>
                <td class="border border-white p-4"><?= date('H:i', strtotime($a["hora"])) ?></td>
                <td class="border border-white">
                    <?php
                    switch ($a["sexo"]) {
                        case 'F':
                            echo "Fêmea";
                            break;
                        case 'M':
                            echo "Macho";
                            break;
                    }
                    ?>
                </td>

                <td class="border border-white p-4">
                    <?php
                    switch ($a["especie"]) {
                        case 'C':
                            echo "Cães";
                            break;
                        case 'G':
                            echo "Gatos";
                            break;
                        case 'P':
                            echo "Pássaros";
                            break;
                        case 'X':
                            echo "Peixes";
                            break;
                        case 'R':
                            echo "Roedores"; //SE ALTERAR AQUI O ERRO SOME, SÓ QUE AI VAI FICAR COM O R E O RE TROCADO.
                            break;
                        case 'E':
                            echo "Répteis";
                            break;
                    }
                    ?>
                </td>

                <td class="border border-white p-4">
                    <?php
                    switch ($a["servico"]) {
                        case 'B':
                            echo "Banho";
                            break;
                        case 'T':
                            echo "Tosa";
                            break;
                        case 'N':
                            echo "Banho e Tosa";
                            break;
                        case 'C':
                            echo "Consulta";
                            break;
                        default:
                            echo "Não informado";
                    }
                    ?>
                </td>
                <td>
                    <form action="excluir.php" method="get" onsubmit="return confirm('Tem certeza que deseja desmarcar o serviço deste pet?');">
                        <input type="hidden" name="id" value="<?= $a['id'] ?>">
                        <button type="submit" class="mt-4 w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Desmarcar
                        </button>
                    </form>
                </td>
            </tr>


        <?php endforeach; ?>
    </table>

    </div>



    <script src="js/validacoes.js"></script>
    <script>
        // Máscara para telefone brasileiro (formato: (99) 99999-9999)
        document.getElementById('numero').addEventListener('input', function(e) {
            let v = e.target.value.replace(/\D/g, '');
            if (v.length > 10) {
                v = v.replace(/^(\d{2})(\d{5})(\d{4}).*/, '($1) $2-$3');
            } else if (v.length > 5) {
                v = v.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, '($1) $2-$3');
            } else if (v.length > 2) {
                v = v.replace(/^(\d{2})(\d{0,5})/, '($1) $2');
            } else {
                v = v.replace(/^(\d*)/, '($1');
            }
            e.target.value = v;
        });
    </script>

</html>

<!-- [X] Script SQL para criar a tabela foi desenvolvido
[X] Tabela e formulário possuem no mínimo 5 campos, sendo 2 selects
[X] Aplicação possui funcionalidade de listagem, inserção e exclusão
[X] Aplicação valida todos os campos como obrigatórios
[X] Aplicação possui mais duas validações além dos campos obrigatórios
[X] Aplicação foi estilizada com CSS
[x] Aplicação possui uma página com listagem em forma de cards (extra)
[X] Aplicação utilizou orientação a objetos (extra)


nome do animal
    nome do dono
    raca do animal
    sexo do animal
    espécie do animal
    telefone para contato
    tipo de tratamento sla


 ideias: podemos manter a ideia de colcoar a foto do bichano por url



colcoar a tabela dos pets cadastrados anteriormente jutno da parte de formulario
e na parte de cards vai estar armazenado todos os pets antigos tambem, mas vai ser em formato de card. 
da pra ver de colocoar a data de atendiemnto e o horario tambem
depois que terminar tudo e estiver funcionando da pra colocar o dao e model
tela que dura uns 8 segundos com logo e depois redireciona para a pagina de cadastro 

ae não apresentar hoje: e arrumar para que a datas anteriores não sejam aceitas, arrumar para que exiba por ordem de horario -->