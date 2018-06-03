<?php
header("Content-type: text/html; charset=utf-8");

session_start();
ob_start();

$btnCad = filter_input(INPUT_POST, 'cad', FILTER_SANITIZE_STRING);

if($btnCad){
    include_once 'conexao.php';
    include_once 'email.php';//inclui a pagina email onde contem a função de enviar o email
    /*Variaveis que foram criadas para receberem os vetores de dados do formulario ou para a tomada de decisão
    de navegação entre as páginas php*/
    include_once 'funcoes.php';

    $dataIda = ($_POST['dataIda']);
    $dataVolta = ($_POST['dataVolta']);
    $nome = ($_POST['firstName']);
    $dataNascimento = ($_POST['dtNasc']);
    $peso = ($_POST['peso']);
    $email = ($_POST['email']);
    $telefone = ($_POST['inputFone']);
    $NomeContatoEmergencia = ($_POST['nomeContEm']);
    $TelefoneContatoEmergencia = ($_POST['inputFoneEmerg']);

    //convertendo string de data no formato brasileiro dd/mm/aaaa no formato que o sql entendo yyyy-mm-dd
    $dataNascimento = date_converter($dataNascimento);
    $dataIda = date_converter($dataIda);
    $dataVolta = date_converter($dataVolta);

    $result_pax = "INSERT INTO acre (dataIda, dataVolta, nome, pesoEstimado, dataNascimento, contatoPax, email, nomeContatoEmergencia, telContatoEmergencia) VALUES ('$dataIda', '$dataVolta', '$nome', '$peso', '$dataNascimento',
                            '$telefone', '$email', '$NomeContatoEmergencia', '$TelefoneContatoEmergencia')";

    $resultado_pax = mysqli_query($conn, $result_pax);

        if(mysqli_insert_id($conn)){

            $dataNascimento = date_converter_back($dataNascimento);
            $dataIda = date_converter_back($dataIda);
            $dataVolta = date_converter_back($dataVolta);

            /*RELATORIO PARA ENVIO DE EMAIL PARA A EQUIPE DE VOO E PARA O SOLICITANTE*/
                $id = mysqli_insert_id($conn);
                $titulo = "Projeto Acre Vivo:";
                $destinatario = $email;
                $corpoMensagem = "Cadastro de $nome com número de identificação $id <br>
                ---------------------------------------------------------------------------------<br>
                Voo de ida para Jordão<br>
                Origem: Cruzeiro do Sul <br>
                Destino: Feijó <br>
                Data de Ida pretendido: $dataIda <br>
                Data de Volta pretendido: $dataVolta <br>
                ---------------------------------------------------------------------------------<br>
                Dados do Passageiro<br>
                Nome: $nome <br>
                Data de Nascimento: $dataNascimento<br>
                Peso Corporal: $peso<br>
                ---------------------------------------------------------------------------------<br>
                Contatos de Emergência: <br>
                Nome do contato de emergência: $NomeContatoEmergencia<br>
                Telefone contato de emergência: $TelefoneContatoEmergencia<br>
                ---------------------------------------------------------------------------------<br>
                ";

                enviarEmail($titulo, $corpoMensagem, $destinatario);


            echo "<script>alert('Passageiro Salvo Com Sucesso')</script>";
            echo "<script>alert('Foi enviado um e-mail para o email cadastro com os dados cadastrados')</script>";
               // $_SESSION['msg'] = "<div class='alert alert-success'>Usuário cadastrado com sucesso!</div>";
                header("refresh:2; http://missaodoceu.transforme.tech/checkout/transparente/etapa/1/13");
            }else{
                echo "<script>alert('Erro ao Cadastrar Passageiro')</script>>";
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
                    <input type="text" class="form-control" id="dtNasc" name="dtNasc" placeholder="01/01/1990" value="" required>
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


<script src="jquery/jquery-3.3.1.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>