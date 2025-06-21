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
$link = "";
$dia = "";
$hora = "";
$sexo = "";
$especie = "";
$servico = "";

// Verificar se o usuário já clicou no Salvar
if (isset($_POST["nome"])) {

    // Obter os valores digitados pelo usuário
    $nome = trim($_POST["nome"]); // A função TRIM tira os espaços das bordas
    $dono  = trim($_POST["dono"]);
    $raca = $_POST["raca"];
    $numero = $_POST["numero"];
    $link = $_POST["link"];
    $dia = $_POST["dia"];
    $hora = $_POST["hora"];
    $sexo = $_POST["sexo"];
    $especie = $_POST["especie"];
    $servico = $_POST["servico"];

    //Validar os dados
    $erros = array();
    if (! $nome)
        array_push($erros, 'Informe o nome do bichano!');
    if (! $dono)
        array_push($erros, 'Informe o nome do dono!');
    if (! $raca)
        array_push($erros, 'Informe a raça!');
    if (! $numero)
        array_push($erros, 'Informe o número!');
    if (! $dia)
        array_push($erros, 'Informe a data');
    if (! $hora)
        array_push($erros, 'Informe a hora!');
    if (! $sexo)
        array_push($erros, 'Informe o sexo!');
    if (! $especie)
        array_push($erros, 'Informe a espécie');
    else if (! $servico)
        array_push($erros, 'Informe o serviço');


    // Se não houver erros, pode prosseguir com o cadastro no banco de dados
    if (count($erros) == 0) {
        // Inserir as informações na base de dados
        $sucesso = $dao->inserirAnimal($nome, $dono, $raca, $numero, $link, $dia, $hora, $sexo, $especie, $servico);
        if ($sucesso) {
            // Redirecionar para a mesma página a fim de limpar o buffer do navegador
            header("location: formulario.php");
            exit;
        } else {
            $msgErro = "Um serviço já foi marcado para este animal, na mesma data e hora!";
        }
    } else {
        // Junta as mensagens de erro para exibir ao usuário
        $msgErro = implode("<br>", $erros);
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


<body class=" m-auto  text-center content-center bg-gray-900 items-center">



    <h1>Listagem</h1>
    <table class="table-auto border border-white text-white m-auto">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Dono</th>
            <th>Raça</th>
            <th>Número</th>
            <th>Data</th>
            <th>Hora</th>
            <th>Sexo</th>
            <th>Espécie</th>
            <th>Serviço</th>
        </tr>

        <?php foreach ($animais as $a) : ?> <!-- O : é pra não usar chave -->

            <tr>
                <td><?= $a["id"] ?></td> <!-- O igual é basicamente para escrever sem escrever php -->
                <td><?= $a["nome"] ?></td>
                <td><?= $a["dono"] ?></td>
                <td><?= $a["raca"] ?></td>
                <td><?= $a["numero"] ?></td>
                <td><?= $a["dia"] ?></td>
                <td><?= $a["hora"] ?></td>

                <td>
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

                <td>
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
                        case 'Pe':
                            echo "Peixes";
                            break;
                        case 'R':
                            echo "Roedores";
                            break;
                        case 'Re':
                            echo "Répteis";
                            break;
                    }
                    ?>
                </td>

                <td>
                    <?php
                    switch ($a["servico"]) {
                        case 'B':
                            echo "Banho";
                            break;
                        case 'T':
                            echo "Tosa";
                            break;
                        case 'BT':
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
                    <form action="excluir.php" method="get" onsubmit="return confirm('Tem certeza que deseja excluir este pet?');">
                        <input type="hidden" name="id" value="<?= $animal['id'] ?>">
                        <button type="submit" class="mt-4 w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Excluir
                        </button>
                    </form>
                </td>
            </tr>


        <?php endforeach; ?>
    </table>

    <div class="m-auto pt-4 full-box flex content-center items-center w-80 grid min-h-screen ">
        <div class="bg-gray-500 rounded-xl p-2">
            <h2 class="h2 bg-gray-700 rounded-xl items-center text-center text-white p-2">Insira os dados do seu pet </h2>

            <div class="p-4">
                <form class="pt-4" method="POST"
                    action="">


                    <input class="input rounded-md bg-gray-200 placeholder-gray-500 ml-2 pl-2" type="text" name="nome" placeholder="Insira o nome do bichano"
                        value="<?php echo $nome ?>" />
                    <br><br>

                    <input class="input rounded-md bg-gray-200 placeholder-gray-500 ml-2 pl-2" type="text" name="dono" placeholder="Insira o nome do Dono " value="<?php echo $dono ?>" />
                    <br><br>

                    <input class="input rounded-md bg-gray-200 placeholder-gray-500 ml-2 pl-2" type="text" name="raca" placeholder="Insira raça" value="<?php echo $raca ?>" />
                    <br><br>

                    <input
                        style="border-radius:6px; background:#e5e7eb; color:#374151; margin-left:8px; padding-left:8px; height:32px; border:1px solid #ccc; width:200px;"
                        type="text"
                        name="numero"
                        placeholder="Número para contato"
                        value="<?php echo htmlspecialchars($numero) ?>"
                        id="numero"
                        maxlength="15" />
                    <br><br>

                    <input class="input rounded-md bg-gray-200 placeholder-gray-500 ml-2 pl-2" type="text" name="link" placeholder="Insira o link da foto dele(a)" value="<?php echo $link ?>" />
                    <br><br>

                    <input class="input rounded-md bg-gray-200 placeholder-gray-500 ml-2 pl-2" type="date" name="dia" placeholder="Dia do atendimento: " value="<?php echo $dia ?>" />
                    <br><br>

                    <input class="input rounded-md bg-gray-200 placeholder-gray-500 ml-2 pl-2" type="time" name="hora" placeholder="Hora do atendimento: " value="<?php echo $hora ?>" />
                    <br><br>


                    <div class="rounded-md bg-gray-2">
                        <!-- div do select para o sexo -->
                        <div style="margin-bottom: 10px;">
                            <label for="sexo">Sexo: </label>
                            <select name="sexo" id="sexo">

                                <option value="">---Selecione---</option>
                                <!-- Com o selected, mesmo que recarregue a página o valor colocado vai sem manter -->
                                <option value="F" <?php if ($sexo == 'F') {
                                                        echo "selected";
                                                    } ?>>Fêmea</option>
                                <option value="M" <?php if ($sexo == 'M') {
                                                        echo "selected";
                                                    } ?>>Macho</option>

                            </select>
                        </div>


                        <!-- div do select para especie -->
                        <div style="margin-bottom: 10px;">
                            <label for="especie">Espécie: </label>
                            <select name="especie" id="especie">

                                <option value="">---Selecione---</option>
                                <!-- Com o selected, mesmo que recarregue a página o valor colocado vai sem manter -->
                                <option value="C" <?php if ($especie == 'C') {
                                                        echo "selected";
                                                    } ?>>Cachorro</option>
                                <option value="G" <?php if ($especie == 'G') {
                                                        echo "selected";
                                                    } ?>>Gato</option>
                                <option value="P" <?php if ($especie == 'P') {
                                                        echo "selected";
                                                    } ?>>Periquito</option>

                                <option value="Pe" <?php if ($especie == 'Pe') {
                                                        echo "selected";
                                                    } ?>>Peixes</option>
                                <option value="R" <?php if ($especie == 'R') {
                                                        echo "selected";
                                                    } ?>>Roedores</option>
                                <option value="Re" <?php if ($especie == 'Re') {
                                                        echo "selected";
                                                    } ?>>Répteis</option>
                            </select>
                        </div>




                        <!-- div do select para o serviço -->
                        <div style="margin-bottom: 10px;">
                            <label for="servico">Serviços: </label>
                            <select name="servico" id="servico">

                                <option value="">---Selecione---</option>
                                <!-- Com o selected, mesmo que recarregue a página o valor colocado vai sem manter -->
                                <option value="B" <?php if ($servico == 'B') {
                                                        echo "selected";
                                                    } ?>>Banho</option>
                                <option value="T" <?php if ($servico == 'T') {
                                                        echo "selected";
                                                    } ?>>Tosa</option>
                                <option value="BT" <?php if ($servico == 'BT') {
                                                        echo "selected";
                                                    } ?>>Banho e Tosa</option>
                                <option value="C" <?php if ($servico == 'C') {
                                                        echo "selected";
                                                    } ?>>Consulta</option>

                            </select>
                        </div>




                    </div>
            </div>

            <button class="bg-green-900 rounded-md ml-2 p-2 text-white" type="submit">Enviar</button>
            </form>
        </div>

        <div style="color: red;">
            <?= $msgErro ?>
        </div>
    </div>

    <a href="index.html" class="block mt-4 text-center bg-blue-900 hover:bg-blue-900/95 hover:text-gray-300 text-white font-bold py-2 px-4 rounded">
        Voltar
    </a>

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
[ ] Aplicação utilizou orientação a objetos (extra)


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
tela que dura uns 8 segundos com logo e deopis redireciona para a pagina de cadastro -->