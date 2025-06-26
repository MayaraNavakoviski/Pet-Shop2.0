 <?php

    require_once("util/Conexao.php");
    require_once("DAO/AnimalDAO.php");

    //Pegar o ID do Animal
    if (! isset($_GET['id'])) {
        echo "ID do animal não informado!";
        echo "<a href='index.php'>Voltar</a>";
        exit;
    }


    $id = $_GET['id'];

    // Usar o DAO para excluir o animal
    $dao = new AnimalDAO();
    $dao->excluirAnimal($id);

    $con = Conexao::getConexao();

    // Reorganizar os IDs restantes
    // 1. Define uma variável de usuário @count e inicializa com 0
    // 2. Atualiza a coluna 'id' de cada registro, atribuindo valores sequenciais começando de 1
    // 3. Redefine o valor inicial do AUTO_INCREMENT para 1, garantindo que novos registros sigam a sequência correta
    $sqlReorganizar = "SET @count = 0; 
                       UPDATE Animal SET id = (@count := @count + 1); 
                       ALTER TABLE Animal AUTO_INCREMENT = 1;";
    $stmReorganizar = $con->prepare($sqlReorganizar);
    $stmReorganizar->execute();


    // Redirecionar para o index.php
    header("location: index.html");
    exit;
