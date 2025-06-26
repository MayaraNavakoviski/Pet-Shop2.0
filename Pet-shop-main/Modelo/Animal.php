<?php


class Animal {

    // Atributos
    private $id;
    private $nome;
    private $dono;
    private $raca;
    private $numero;
    private $sexo;
    private $especie;
    private $servico;
    private $dia;
    private $hora;
    private $imagem;

    // Construtor
    public function __construct($id, $nome, $dono, $raca, $numero, $sexo, $especie, $servico, $dia, $hora, $imagem) {
        $this->id = $id;
        $this->nome = $nome;
        $this->dono = $dono;
        $this->raca = $raca;
        $this->numero = $numero;
        $this->sexo = $sexo;
        $this->especie = $especie;
        $this->servico = $servico;
        $this->dia = $dia;
        $this->hora = $hora;
        $this->imagem = $imagem;
    }

    // GETs e SETs
    public function getId() {
        return $this->id;
    }
    public function setId($id): self {
        $this->id = $id;
        return $this;
    }

    public function getNome() {
        return $this->nome;
    }
    public function setNome($nome): self {
        $this->nome = $nome;
        return $this;
    }

    public function getDono() {
        return $this->dono;
    }
    public function setDono($dono): self {
        $this->dono = $dono;
        return $this;
    }

    public function getRaca() {
        return $this->raca;
    }
    public function setRaca($raca): self {
        $this->raca = $raca;
        return $this;
    }

    public function getNumero() {
        return $this->numero;
    }
    public function setNumero($numero): self {
        $this->numero = $numero;
        return $this;
    }

    public function getSexo() {
        return $this->sexo;
    }
    public function setSexo($sexo): self {
        $this->sexo = $sexo;
        return $this;
    }

    public function getEspecie() {
        return $this->especie;
    }
    public function setEspecie($especie): self {
        $this->especie = $especie;
        return $this;
    }

    public function getServico()  {
        return $this->servico;
    }
    public function setServico($servico): self  {
        $this->servico = $servico;
        return $this;
    }

    public function getDia() {
        return $this->dia;
    }
    public function setDia($dia): self {
        $this->dia = $dia;
        return $this;
    }

    public function getHora() {
        return $this->hora;
    }
    public function setHora($hora): self {
        $this->hora = $hora;
        return $this;
    }

    public function getImagem() {
        return $this->imagem;
    }
    public function setImagem($imagem): self {
        $this->imagem = $imagem;
        return $this;
    }
}

    