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

    // Redirecionar para o index.php
    header("location: index.html");
    exit;
