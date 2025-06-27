<?php
require_once("util/Conexao.php");
$con = Conexao::getConexao();
$sql = "SELECT * FROM Animal";
$stm = $con->prepare($sql);
$stm->execute();
$animais = $stm->fetchAll();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cards dos Pets</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 flex flex-wrap justify-center min-h-screen">
    <a href="index.html"
        class="fixed top-4 left-4 z-50 inline-flex items-center bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-5 rounded shadow transition-all duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Voltar
    </a>
    <?php foreach ($animais as $animal): ?>
        <div class="bg-white shadow-lg rounded-lg w-80 p-4 m-4">
            <h2 class="font-bold text-center">Dados do Pet:</h2>
            <?php if (!empty($animal['imagem'])): ?>
                <img src="<?= $animal['imagem'] ?>" alt="Imagem do bichano" class="w-full h-auto rounded" />
            <?php endif; ?>
            <h2 class="text-xl font-bold text-center mt-4 text-gray-800"><?= $animal['nome'] ?></h2>
            <p class="text-gray-600 mt-2">Dono: <?= $animal['dono'] ?></p>
            <p class="text-gray-600">Raça: <?= $animal['raca'] ?></p>
            <p class="text-gray-600">Número: <?= $animal['numero'] ?></p>
            <p class="text-gray-600">Sexo:
                <?php
                switch ($animal['sexo']) {
                    case 'F':
                        echo 'Fêmea';
                        break;
                    case 'M':
                        echo 'Macho';
                        break;
                }
                ?></p>
            <p class="text-gray-600">Espécie:
                <?php
                switch ($animal['especie']) {
                    case 'C':
                        echo 'Cachorro';
                        break;
                    case 'G':
                        echo 'Gato';
                        break;
                    case 'P':
                        echo 'Pássaro';
                        break;
                    case 'Pe':
                        echo 'Peixe';
                        break;
                    case 'R':
                        echo 'Roedores';
                        break;
                    case 'Re':
                        echo 'Réptil';
                        break;
                    default:
                        echo $animal['especie'];
                }
                ?></p>
            <p class="text-gray-600">Serviço:
                <?php
                switch ($animal['servico']) {
                    case 'B':
                        echo 'Banho';
                        break;
                    case 'T':
                        echo 'Tosa';
                        break;
                    case 'N':
                        echo 'Banho e Tosa';
                        break;
                    case 'C':
                        echo 'Consulta';
                        break;
                } ?></p>
            <p class="text-gray-600">Data: <?= date('d/m/Y', strtotime($a["dia"])) ?></p>
            <p class="text-gray-600">Hora: <?= date('H:i', strtotime($animal['hora'])) ?></p> <!-- strtotime() 
                                                                                                    Essa função converte uma string de data/hora (como 14:30:45) em um timestamp Unix.
                                                                                                    O timestamp é um número que representa o número de segundos desde 1º de janeiro de 1970.  
                                                                                                    date()
                                                                                                    Essa função formata um timestamp Unix em uma string de data/hora no formato desejado.
                                                                                                    Para exibir apenas horas e minutos, usamos o formato 'H:i':
                                                                                                    H: Representa as horas no formato de 24 horas (ex.: 14).
                                                                                                    i: Representa os minutos (ex.: 30).-->
            <form action="excluir.php" method="get" onsubmit="return confirm('Tem certeza que deseja desmarcar o serviço deste pet?');">
                <input type="hidden" name="id" value="<?= $animal['id'] ?>">
                <button type="submit" class="mt-4 w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Desmarcar
                </button>
            </form>
        </div>
    <?php endforeach; ?>


</body>

</html>