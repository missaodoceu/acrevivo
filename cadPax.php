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
    $dataNascimento = ($_POST['dtNasc']);
    $peso = ($_POST['peso']);
    $email = ($_POST['email']);
    $telefone = ($_POST['inputFone']);
    $NomeContatoEmergencia = ($_POST['nomeContEm']);
    $TelefoneContatoEmergencia = ($_POST['inputFoneEmerg']);

    $result_pax = "INSERT INTO acre (dataIda, dataVolta, nome, pesoEstimado, dataNascimento, contatoPax, email, nomeContatoEmergencia, telContatoEmergencia) VALUES ('$dataIda', '$dataVolta', '$nome', '$peso', '$dataNascimento',
                            '$telefone', '$email', '$NomeContatoEmergencia', '$TelefoneContatoEmergencia')";

    $resultado_pax = mysqli_query($conn, $result_pax);
            if($resultado_pax){
                 echo "<script>alert('Passageiro Salvo Com Sucesso')</script>";
               // $_SESSION['msg'] = "<div class='alert alert-success'>Usuário cadastrado com sucesso!</div>";
                header("refresh:2; http://missaodoceu.transforme.tech/checkout/transparente/etapa/1/13");
            }else{
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao cadastrar o usuário!</div>";
            }



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
       <?php
            if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
    </div>
</div>
<form method="POST" action="">
    <div class="container input-group">
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Datas de Voo</h4>
            
                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label for="dataIda">Data Ida</label>
                        <select class="custom-select d-block w-100" id="dataIda" name="dataIda" required>
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
                        <select class="custom-select d-block w-100" id="dataVolta" name="dataVolta" required>
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
            
        </div>
    </div>


    <div class="container">
        <hr class="mb-4">
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Dados Pessoais</h4>
           
            <div class="row">

                <div class="col-md-6 mb-3">
                    <label for="firstName">Nome</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="" required>
                    <div class="invalid-feedback">
                        Valid first name is required.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="dtNasc">Data Nascimento</label>
                    <input type="date" class="form-control" id="dtNasc" name="dtNasc" placeholder="" value="" required>
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
                        <input type="text" class="form-control" id="peso" name="peso" placeholder="Peso Corporal em Kilogramas" required>
                        <div class="invalid-feedback" style="width: 100%;">
                            Your username is required.
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
    </div>

    <div class="container">
        <hr class="mb-4">
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Contato</h4>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email">Email <span class="text-muted">(Opcional)</span></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="seu-email@example.com">
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="inputFone">Telefone</label>
                    <input type="text" class="form-control" id="inputFone" name="inputFone" placeholder="Telefone" required >
                    <div class="invalid-feedback" style="width: 100%;">
                        Telefone para contato é necessário.
                    </div>
                </div>

            </div>
            
        </div>
    </div>

    <div class="container">
        <hr class="mb-4">
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Contato em caso de emergência</h4>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nomeContEm">Nome do Contato</label>
                    <input type="text" class="form-control" id="nomeContEm" name="nomeContEm" placeholder="Nome Contato Emergencia" required >
                    <div class="invalid-feedback" style="width: 100%;">
                        Nome para contato é necessário.
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="inputFoneEmerg">Telefone</label>
                    <input type="text" class="form-control" id="inputFoneEmerg" name="inputFoneEmerg" placeholder="Telefone" required >
                    <div class="invalid-feedback" style="width: 100%;">
                        Telefone para contato é necessário.
                    </div>
                </div>

            </div>
            
        </div>
    </div>
    <div class="container">
        <div class="col-md-8 order-md-1">
            <hr class="mb-4">
            <input type="submit" name="cad" id="cad" value="Confirmar Cadastro" class="btn btn-primary btn-block">

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