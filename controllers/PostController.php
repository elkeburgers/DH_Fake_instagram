<?php

include_once "models/Posts.php";
// chamando o Posts.php porque ele que sabe como cadastrar os dados no banco, para o controller poder fazer o servico com estes dados. depois tem que criar uma funcao ($post) para o controller poder trabalhar com ele (linhas 48 aprox)

class PostController{
    public function acao($rotas){
        switch ($rotas) {
            case 'posts':
                // posts tem que ser igual ao citado no case do index.php.
                $this->listarPosts();
                // $this->viewPosts();
                //viewPosts substituido por listarPosts - codigo do Vinicius 20/11/2019
                //metodo para usuario ver a pagina dos posts.
            break;
            
            case "formulario-post":
                $this->viewFormularioPost();
                //eh o metodo da funcao que criamos abaixo, para enviar o usuario para a pagina newPost.
            break;

            case "cadastrar-post":
                $this->cadastroPost();
            break;
        }
    }

    //primeiro criamos a funcao abaixo, depois colocamos o this para executar a funcao acima.
    // fazer private para que apenas o controller tennha acesso ao view, qualquer outra classe nao tem acesso.
    // nao usamos o  include, criamos uma funcao nova porque engaveta outras funcoes futuramente, eh um processo mais solido.
    private function viewFormularioPost(){
        include "views/newPost.php";
    }
    private function viewPosts(){
        include "views/posts.php";
    }

    private function cadastroPost(){
        // $post = new Post();
        // incluido conforme arquivo do Vinicius - 20/11/2019
        $descricao = $_POST['descricao'];
        // descricao igual ao name que estah no formulario no newPost
        $nomeArquivo = $_FILES['img']['name'];
        // criando o temporario, com o input igual ao name do formulario do  newPost
        $linkTemp = $_FILES['img']['tmp_name'];
        $caminhoSalvar = "views/img/$nomeArquivo";
        // dizendo onde quero salvar estes arquivos

        move_uploaded_file($linkTemp, $caminhoSalvar);
        //caminho de onde vem e para onde vai o arquivo

        // abaixo funcao referida no primeiro comentario, sobre include do model posts.php
        $post = new Post();
        $resultado = $post->criarPost($caminhoSalvar, $descricao);

        // criacao do metodo da funcao cadastroPost para encerrar o codigo
        if($resultado){
            header('Location:/DH_Fake_instagram/posts');
            // header eh funcao do php que consegue mudar o lugar para onde o usuario vai
            // toda vez que faz um location ele perde a referencia, por isso tem que colocar o caminho inteiro
            // esse codigo todo foi para fazer o usuario voltar para a pagina de posts apos enviar o formulario (nova postagem). Carregou no banco de dados, mas ainda nao carrega na pagina de posts a img e descricao recem cadastrados.
        }else{
            echo "Erro na carga.";
        }
    }

    // funcao inserida conforme codigo do Vinicius - 20/11/2019
    private function listarPosts(){
        $post = new Post();
        $listaPosts = $post->listarPosts();
        $_REQUEST['posts'] = $listaPosts;
        $this->viewPosts();
    }
}





