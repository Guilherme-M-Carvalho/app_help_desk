<?php
    session_start();
    $usuario_autenticado = false;
    $usuario_id = null;
    $usuario_permissao = null;

    $usuarios_app = [['id'=>1,'email'=>'guimirand43214@gmail.com','senha'=>'43214','permissao'=>1],['id'=>2,'email'=>'gui@gmail.com','senha'=>'54321','permissao'=>2]];

    foreach($usuarios_app as $user){
        if ($user['email'] == $_POST['email'] && $user['senha'] == $_POST['senha']){
            $usuario_autenticado = true;
            $usuario_id = $user['id'];
            $usuario_permissao = $user['permissao'];
        }
    }

    if($usuario_autenticado){
        $_SESSION['autenticado'] = 'sim';
        $_SESSION['id'] = $usuario_id;
        $_SESSION['permissao'] = $usuario_permissao;
        header('location: home.php');
    }
    else{
        $_SESSION['autenticado'] = 'nao';
        header('location: index.php?login=erro');
    }

?>