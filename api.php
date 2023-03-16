<?php 
// api php para usuários

// variável que recebe o conteúdo da requisição do APP decodificando-a (JSON)
$postjson = json_decode(file_get_contents('php://input',true),true);
?>