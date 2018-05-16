<?php
header("Content-type: text/html; charset=utf-8");

session_start();
ob_start();

$btnCad = filter_input(INPUT_POST, 'cad', FILTER_SANITIZE_STRING);

if($btnCad){
    include_once 'conexao.php';
    $dataIda = ($_POST['dataIda']);
    $dataVolta = ($_POST['dataVolta']);
    $nome = ($_POST['firstName']);
    $dataVolta = ($_POST['dataVolta']);
    $dataNascimento = ($_POST['dtNasc']);
    $peso = ($_POST['peso']);
    $email = ($_POST['email']);
    $telefone = ($_POST['inputFone']);
    $NomeContatoEmergencia = ($_POST['nomeContEm']);
    $TelefoneContatoEmergencia = ($_POST['inputFoneEmerg']);
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Projeto Acre - Pré Agendamento de Voo</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
</head>
<body>

<div class="jumbotron">
   <div class="col-md-12 order-md-1">
       <h3 class="mb-3 text-center">Pré-Agendamentos de Voos</h3>
    </div>
</div>
<form class="form-group" action="" method="post">
    <div class="container input-group">
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Datas de Voo</h4>
            <form class="needs-validation" novalidate>
                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label for="dataIda">Data Ida</label>
                        <select class="custom-select d-block w-100" id="dataIda" required>
                            <option value="">Escolha...</option>
                            <option>16/07/2018</option>
                            <option>17/07/2018</option>
                            <option>18/07/2018</option>
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid state.
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="dataVolta">Data Volta</label>
                        <select class="custom-select d-block w-100" id="dataVolta" required>
                            <option value="">Escolha...</option>
                            <option>30/07/2018</option>
                            <option>31/07/2018</option>
                            <option>01/08/2018</option>
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid state.
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>


    <div class="container">
        <hr class="mb-4">
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Dados Pessoais</h4>
           <form class="needs-validation" novalidate>
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="firstName">Nome</label>
                        <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="dtNasc">Data Nascimento</label>
                        <input type="date" class="form-control" id="dtNasc" placeholder="" value="" required>
                        <div class="invalid-feedback">
                            Valid last name is required.
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="peso">Peso</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">KG</span>
                            </div>
                            <input type="text" class="form-control" id="peso" placeholder="Peso Corporal em Kilogramas" required>
                            <div class="invalid-feedback" style="width: 100%;">
                                Your username is required.
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <div class="container">
        <hr class="mb-4">
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Contato</h4>
            <form class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email">Email <span class="text-muted">(Opcional)</span></label>
                        <input type="email" class="form-control" id="email" placeholder="seu-email@example.com">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="inputFone">Telefone</label>
                        <input type="text" class="form-control" id="inputFone" placeholder="Telefone" pattern="\([0-9]{2}\)[0-9]{4,6}-[0-9]{3,4}$" required >
                        <div class="invalid-feedback" style="width: 100%;">
                            Telefone para contato é necessário.
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <div class="container">
        <hr class="mb-4">
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Contato em caso de emergência</h4>
            <form class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nomeContEm">Telefone</label>
                        <input type="text" class="form-control" id="nomeContEm" placeholder="Nome Contato Emergencia" required >
                        <div class="invalid-feedback" style="width: 100%;">
                            Nome para contato é necessário.
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="inputFoneEmerg">Telefone</label>
                        <input type="text" class="form-control" id="inputFoneEmerg" placeholder="Telefone" pattern="\([0-9]{2}\)[0-9]{4,6}-[0-9]{3,4}$" required >
                        <div class="invalid-feedback" style="width: 100%;">
                            Telefone para contato é necessário.
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="col-md-8 order-md-1">
            <hr class="mb-4">
            <input type="submit" name="cad" value="Confirmar Cadastro" class="btn btn-primary btn-block">

            <footer class="my-5 pt-5 text-muted text-center text-small">
                <p class="mb-1">&copy; 2018 Albert Otto & Missão do Céu</p>
            </footer>

        </div>
    </div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>