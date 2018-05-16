<?php
header("Content-type: text/html; charset=utf-8");

session_start();
ob_start();

   // $resultado_usario = "SELECT idPassageiros, nome FROM passageiros WHERE idPassageiros ='". $_SESSION['id'] ."'";
    //$resultado_usario = mysqli_query($conn, $result_usuario);

   // if(($resultado_usario) AND ($resultado_usario!=0)){

    //}

    $btnCadPax = filter_input(INPUT_POST, 'btnCadPax', FILTER_SANITIZE_STRING);
    $btnant = filter_input(INPUT_POST, 'btnant', FILTER_SANITIZE_STRING);
    $btnNovo = filter_input(INPUT_POST, 'btnNovo', FILTER_SANITIZE_STRING);
    $btnProx = filter_input(INPUT_POST, 'btnProx', FILTER_SANITIZE_STRING);
    if($btnCadPax){
        include_once 'conexao.php';
        $dados_rc = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $erro = false;

        $dados_st = array_map('strip_tags', $dados_rc);
        $dados = array_map('trim', $dados_st);

        if(in_array('',$dados)){
            $erro = true;
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário preencher todos os campos!</div>";
        }else{
            $result_usuario = "SELECT idPassageiros FROM passageiros WHERE nome='". $dados['nome'] ."'";
            $resultado_usuario = mysqli_query($conn, $result_usuario);
            if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
                $erro = true;
                $_SESSION['msg'] = "<div class='alert alert-danger'>Este Usuário já esta cadastrado!</div>";
            }

        }


        //var_dump($dados);
        if(!$erro){
            //var_dump($dados);
            $result_usuario = "INSERT INTO passageiros (nome, peso, data_nascimento, contato_passageiro, email, organizacao, idUsuario) VALUES (
                            '" .$dados['nome']. "',
                            '" .$dados['peso']. "',
                            '" .$dados['dataNascimento']. "',
                            '" .$dados['telefone']. "',
                            '" .$dados['email']. "',
                            '" .$dados['organizacao']. "',
                            '".$_SESSION['id']."'
                            )";
            $resultado_usario = mysqli_query($conn, $result_usuario);
            if($resultado_usario){
                $_SESSION['msg'] = "<div class='alert alert-success'>Usuário cadastrado com sucesso!</div>";
                header("refresh:2; cadastrar_pax.php");
            }else{
                $_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao cadastrar o usuário!</div>";
            }
        }

    }else if($btnProx){
        header("Location: cadVoo.php");
    }else if($btnant){
        header("Location: termo.php");
    }else if($btnNovo){
        header("Location: cadastrar_pax.php");
    }


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastrar - Login</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
</head>
<body>


    <div class="container">
        <div class="form-signin" style="background: #42dea4;">
            <h2 class="text-center">Cadastrar Passageiros</h2>

            <?php
            if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
            <form method="POST" action="">
                <!--<label>Nome</label>-->

                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo" class="form-control"><br>

                <!--<label>E-mail</label>-->
                <label for="email"">Email</label>
                <input type="text" id="email" name="email" placeholder="Digite o seu e-mail" class="form-control"><br>

                <label>Data de Nascimento</label>
                <input type="text" id="dataNascimento" name="dataNascimento" placeholder="Ex: 17/10/2017" class="form-control"><br>

                <label for="telefone">Telefone</label>
                <input type="text" id="telefone" name="telefone" placeholder="Ex: (92) 99999-9999" class="form-control"><br>

                <label for="peso">Peso</label>
                <input type="text" id="peso" name="peso" placeholder="Peso em Kg" class="form-control"><br>

                <label for="organizacao">Organização</label>
                <input type="text" id="organizacao" name="organizacao" placeholder="Organização/igreja ao qual pertence" class="form-control"><br>

                <input type="submit" name="btnant" value="Anterior" class="btn btn-success">
                <input type="submit" name="btnCadPax" value="Salvar Cadastro" class="btn btn-success"><br><br>
                <input type="submit" name="btnProx" value="Solicitar Voo" class="btn btn-success"><br><br>
                <!--<input type="submit" name="btnNovo" value="Novo Passageiro" class="btn btn-success">-->



            </form>
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>