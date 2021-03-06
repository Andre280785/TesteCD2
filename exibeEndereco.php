<?php require_once("classes". DIRECTORY_SEPARATOR ."Cep.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Meta tags Obrigatórias -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <title>Endereço</title>        
    </head>
    <body>
        <header class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">André T. Machado</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNav">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="index.php">Início</a>
                        <a class="nav-link" href="http://www.linkedin.com/in/andretavaresmachado">linkedin</a>
                        <a class="nav-link" href="https://www.facebook.com/andre.tavaresmachado">Facebook</a>                        
                    </div>
                </div>
            </div>
        </header>
                
        <section class="section py-5">
            <div>
                <?php
                try{
                    $retorno = !isset($_POST['cep']) ? 0 : $_POST['cep']; 
                    $cep = new Cep();
                    $cep->cunsultaCep($retorno);
                } catch(Exception $e){               
                    echo "
                        <div class='alert alert-danger fixed-top mt-5' id='cepNull' style='display: none;' role='alert'>
                            ". $mensagem . "Codigo: ".$e->getCode()."
                        </div>
                    ";                                       
                } 
                                                                                    
                ?>                
            </div>
        </section>
        <footer class="rodape bg-dark"> 
            <p>Copyright &copy; www.cd2.com.br</p>
        </footer>

        <!-- JavaScript (Opcional) -->
        <script src="js/alertas.js"></script>
        <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>