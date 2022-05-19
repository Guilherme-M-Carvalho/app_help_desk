<?php
  require_once('verificar_autenticacao.php');
?>

<html>
  <head>
    <meta charset="utf-8" />
    <title>App Help Desk</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
      .card-consultar-chamado {
        padding: 30px 0 0 0;
        width: 100%;
        margin: 0 auto;
      }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
        <img src="logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        App Help Desk
      </a>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="logout.php" class="nav-link">Sair</a>
        </li>
      </ul>
    </nav>

    <div class="container">    
      <div class="row">

        <div class="card-consultar-chamado">
          <div class="card">
            <div class="card-header">
              Consulta de chamado
            </div>
            
            <div class="card-body">
              <?php

                if( is_writable('banco.txt')){

                  $chamados =[];
                  $arquivo = fopen('banco.txt','r');
                  while(!feof($arquivo)){
                    $registro = fgets($arquivo);
                    $chamados[] = $registro;
                  }
                  fclose($arquivo);
                
                  foreach($chamados as $chamado){     
                    $item = explode('#', $chamado);
                    if(count($item)<3){
                      continue;
                    }
                    if ($_SESSION['permissao'] == 1){
                    echo"
                    <div class='card mb-3 bg-light'>
                    <div class='card-body'>
                    <h5 class='card-title'>$item[1]</h5>
                    <h6 class='card-subtitle mb-2 text-muted'>$item[2]</h6>
                    <p class='card-text'>$item[3]</p>
                    </div>
                    </div>";
                    } else if ($_SESSION['permissao'] == 2 && $_SESSION['id'] == $item[0]){
                      echo"
                      <div class='card mb-3 bg-light'>
                      <div class='card-body'>
                      <h5 class='card-title'>$item[1]</h5>
                      <h6 class='card-subtitle mb-2 text-muted'>$item[2]</h6>
                      <p class='card-text'>$item[3]</p>
                      </div>
                      </div>";
                    }
                  }
                } else{
                  echo "
                  <div class='text-danger text-center'>Nenhum registro encontrado!</div>";
                }
              ?>

              <div class="row mt-5">
                <div class="col-6">
                  <a href="home.php" class="btn btn-lg btn-warning btn-block" type="submit">Voltar</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>