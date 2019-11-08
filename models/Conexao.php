<?php

// por ser uma classe, o arquivo tem letra maiuscula e singular
// essa classe eh responsavel apenas por criar a conexao, podendo ser utilizada em mais de um local do sistema
// tem os  mesmos atributos do arquivo de conexao
// sao privados porque soh essa classe sabe utilizah-los

class Conexao{
    private $host = "mysql:host=localhost;dbname=instagram;port=3306";
    private $user = "root";
    private $pass = "";

    // para garantir que so conecte quem ve o banco, vamos usar protect, mas poderia ser public, com menos seguranca
    protected function criarConexao(){
        // para usar o atributo eh sem cifrao, o cifrao fica soh no this (e na criacao dos atributos)
        return new PDO($this->host, $this->user, $this->pass);
    }
}
