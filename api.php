<?php 
// api php para usuários
include_once('classes/usuario.php');
// variável que recebe o conteúdo da requisição do APP decodificando-a (JSON)
$postjson = json_decode(file_get_contents('php://input',true),true);


if  ($postjson['requisicao']=='add'){
    $usuario = new Usuario($postjson['nome'],$postjson['usuario'],$postjson['senha'],$postjson['nivel'],1);
    $usuario->insert();
    if ($usuario->getId()>0) {
        $resultado = json_encode(array('success'=>true,'id'=>$usuario->getId()));
    }else{
        $resultado = json_encode(array('success'=>false, 'msg'=>'Falha ao inserir usuário'));
    }
    echo $resultado;
}// fim do método add
if ($postjson['requisicao']=='listar') {
    $user = new Usuario();
    if ($postjson['nome']=='') {
        $res = $user->getlist();
    }else{
        $res = $user->search($postjson['nome']);
    }
    for ($i=0; $i < count($res); $i++) { 
        $dados[][] = array(
            'id'=>$res[$i]['id'],
            'nome'=>$res[$i]['nome'],
            'usuario'=>$res[$i]['usuario'],
            'senha'=>$res[$i]['senha'],
            'senha_original'=>$res[$i]['senha_original'],
            'nivel'=>$res[$i]['nivel'],
            'ativo'=>$res[$i]['ativo']
        );
    }
    if (count($res)>0) {
        $resultado = json_encode(array('success'=>true,'result'=>$dados));
    }else{
        $resultado = json_encode(array('success'=>false,'result'=>'Eitaa Cláudiaaa.......'));
    }
    echo $resultado;
}

?>