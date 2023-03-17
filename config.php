<?php 

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Request-With');
header('Content-Type: application/json; charset=utf-8');

// inicia sessão de usuário
if (!isset($_SESSION)){
    session_start();
}

// definir padrão de Zona GMT (Timezone)
date_default_timezone_set('America/Sao_Paulo');

// inicia o carregamento de classes do projeto
spl_autoload_register(function($nome_classe){
    $nome_arquivo = "classes".DIRECTORY_SEPARATOR.$nome_classe.".php";
    if (file_exists($nome_arquivo)) {
        require_once($nome_arquivo);
    }

    
});

?>