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
                        echo 'Roedor';
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
                    case 'BT':
                        echo 'Banho e Tosa';
                        break;
                    case 'C':
                        echo 'Consulta';
                        break;
                } ?></p>
            <p class="text-gray-600">Data: <?= $animal['dia'] ?></p>
            <p class="text-gray-600">Hora: <?= $animal['hora'] ?></p>
            <form action="excluir.php" method="get" onsubmit="return confirm('Tem certeza que deseja excluir este pet?');">
                <input type="hidden" name="id" value="<?= $animal['id'] ?>">
                <button type="submit" class="mt-4 w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Excluir
                </button>
            </form>
        </div>
    <?php endforeach; ?>

    <a href="index.html" class="block mt-4 text-center bg-blue-900 hover:bg-blue-900/95 hover:text-gray-300 text-white font-bold py-2 px-4 rounded">
        Voltar
    </a>
</body>

</html>