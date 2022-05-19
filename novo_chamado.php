<?php

    session_start();

    $verificarPost = false;

    if((isset($_POST['titulo'])) && ($_POST['titulo'] != "") && isset($_POST['categoria']) && ($_POST['categoria'] != "") && isset($_POST['descricao']) && ($_POST['descricao'] != "")){
        $verificarPost = true;
    }

    if($verificarPost){
        CriarBD();
    } else {
        header('location: abrir_chamado.php?chamado=erro');
    }

    function CriarBD(){
        $arquivo = fopen('banco.txt','a');

        $titulo=str_replace('#','-',$_POST['titulo']);
        $categoria=str_replace('#','-',$_POST['categoria']);
        $descricao=str_replace('#','-',$_POST['descricao']);
        $texto=$_SESSION['id'].'#'.$titulo."#".$categoria."#".$descricao.PHP_EOL;
        fwrite($arquivo,$texto);
        fclose($arquivo);

        return header('location: abrir_chamado.php');
    }
?>