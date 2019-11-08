<?php

// configuracao do ponto de entrada do usuario
// sempre precisa fazer este codigo de rota para o usuario entrar no sistema que estamos criando sem ter que digitar codigos na url
// serve tambem para os links que estao dentro do site e que precisamos colocar rotas

    $rotas = key($_GET)?key($_GET):"posts";

    // if ternario para saber o que o usuario digitou e enviar para o local correto. POde ser usado inclusive quando o usuario digita um nome de pagina que nao existe, se prevermos antes.
    switch($rotas){
    case 'posts':
        include "controllers/PostController.php";
        // padrao usar o PostController, no singular para o comando, e post eh para enviar para o controllers, onde estao as classes
        $controller = new PostController();
        // criando a variavel (PostController) citada acima
        $controller->acao($rotas);
        break;

    case "formulario-post":
            include "controllers/PostController.php";
            $controller = new PostController();
            $controller->acao($rotas);
        break;

        //rota para enviar as informacoes de post novo no banco de dados, criado apos o banco de dados e a classe Posts.php
    case "cadastrar-post";
        include "controllers/PostController.php";
        $controller = new PostController();
        $controller->acao($rotas);
    break;
}


