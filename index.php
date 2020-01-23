<?php 
    require_once("config.php");
    
    ### Carrega 1 usuario
    // $root = new Usuario();
    // $root->loadById(1);
    //echo $root;

    ### Carrega uma lista de usuarios
    // $list = Usuario::getList();
    // echo json_encode($list);

    ### Pesquisar usuarios
    // $search = Usuario::search('Ma');
    // echo json_encode($search);

    ### Carregar usuario por login e senha
    // $usuario = new Usuario();
    // $usuario->login('jose', '0123');
    // echo $usuario;


    ### Cadastro de usuario
    // $user = new Usuario('Larissa', 'teste');
    // $user->insert();
    // echo $user;

    ### Update de usuario
    // $user = new Usuario();
    // $user->loadById(5);
    // $user->update('Larissa e Thiago', 'teste');
    // echo $user;

    ### Delete de usuario
    $user = new Usuario();
    $user->loadById(4);
    $user->delete();
    echo $user;

?>