<?php

require_once('Modelo/Animal.php');
require_once('util/Conexao.php');

class AnimalDAO {

    // Buscar todos os animais na base de dados
    public function buscarAnimais() {
        $con = Conexao::getConexao();
        $sql = "SELECT * FROM Animal";
        $stm = $con->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    // Verificar se o dono já tem um serviço marcado para o animal
    public function verificarServicoExistente($dono, $nome, $dia, $hora) {
        $con = Conexao::getConexao();
        $sql = "SELECT * FROM Animal WHERE dono = ? AND nome = ? AND dia = ? AND hora = ?";
        $stm = $con->prepare($sql);
        $stm->execute([$dono, $nome, $dia, $hora]);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    // Inserir um novo animal na base de dados
    public function inserirAnimal($nome, $dono, $raca, $numero, $link, $dia, $hora, $sexo, $especie, $servico) {
        // Só insere se não existir serviço igual para o mesmo dono e animal
        if (count($this->verificarServicoExistente($dono, $nome, $dia, $hora)) == 0) {
            $con = Conexao::getConexao();
            $sql = "INSERT INTO Animal (nome, dono, raca, numero, imagem, dia, hora, sexo, especie, servico)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stm = $con->prepare($sql);
            return $stm->execute([$nome, $dono, $raca, $numero, $link, $dia, $hora, $sexo, $especie, $servico]);
        } else {
            return false; 
        }
    }

    // Excluir um animal da base de dados
    public function excluirAnimal($id) {
        $con = Conexao::getConexao();
        $sql = "DELETE FROM Animal WHERE id = ?";
        $stm = $con->prepare($sql);
        return $stm->execute([$id]);
    }

}
