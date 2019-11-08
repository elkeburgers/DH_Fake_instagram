<?php

include_once "Conexao.php";

// classe que será responsavel por acoes no banco de dados, como criar, carregar e deletar um post
// essa classe herda as caractersticas da classe Conexao (extends)
class Post extends Conexao {

    public function criarPost($imagem, $descricao){
        $db = parent::criarConexao();
        //parent para acessar um metodo (criarConexao) da classe pai (Conexao em Conexao.php)
        $query = $db->prepare("INSERT INTO  postagem (img, descricao) values(?,?)");
        // prepare e depois execute, para  proteger de ataques inject
        // como sao apenas dois parametros, coloca interrogacao no values
        return $query->execute([$imagem, $descricao]);
        // incluiu um return para retornar o dado para o controller. Essa classe só registra no banco, nao eh funcao dele encaminhar o usuario de volta para a pagina de posts, eh do controller (rota).
    }
}