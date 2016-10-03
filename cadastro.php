<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="estiloCadastro.css">
<?php
	if (isset($_POST['usuario']) && isset($_POST['senha']) && isset($_POST['opcao'])){
		$usuario=$_POST['usuario'];
		$senha=$_POST['senha'];
		$opcao=$_POST['opcao'];
        
        include "conexao.php";
        $con = EstabeleceConexao();
        
        $sql="INSERT INTO Usuario VALUES ('$usuario','$senha','$opcao')"
        $status=sqlsrv_query($con,$sql);

		if ($opcao=='Doador'){
			include "cadastroDoador.inc.php";
			if(isset($_POST['nome'])&&isset($_POST['email'])&& isset($_POST['endereco'])
				isset($_POST['frequencia'])&&isset($_POST['RG'])&&isset($_POST['telefone']){

					$nome=$_POST['nome'];
					$email=$_POST['email'];
					$endereco=$_POST['endereco'];
					$frequencia=$_POST['frequencia'];
					$RG= $_POST['RG'];
					$telefone=$_POST['telefone'];
					

					$sql2 = "INSERT INTO Doador VALUES ('$nome','$telefone','$endereco','$frequencia','$RG','$email')";
					$status2 = sqlsrv_query($con,$sql2);

					$sql3= "INSERT INTO usuarioDoador VALUES ($usuario,(SELECT codDoador FROM Doador WHERE nome='$nome'))";      
                    $status3=sqlsrv_query($con,$sql3);
            }
		}

		if ($opcao=='Carente'){
			include "cadastroCarente.inc.php";
            if (isset($_POST['nome'])&&isset($_POST['email'])&& isset($_POST['endereco'])
				isset($_POST['renda'])&&isset($_POST['RG'])&&isset($_POST['telefone']){
                    
                    $nome=$_POST['nome'];
					$email=$_POST['email'];
					$endereco=$_POST['endereco'];
					$renda=$_POST['renda'];
					$RG= $_POST['RG'];
					$telefone=$_POST['telefone'];
                    
					$sql2 = "INSERT INTO Carente VALUES ($nome,$telefone,$renda,$RG,$email,$endereco)";
					$status2 = sqlsrv_query($con,$sql2);
                    
                    $sql3="INSERT INTO usuarioCarente VALUES ($usuario,(SELECT codCarente FROM Carente WHERE nome='$nome'))"; 
			        $status3= sqlsrv_query($con,$sql3);

            }              
        }

		if($opcao=='Voluntário'){
			include "cadastroVoluntario.inc.php";
            if (isset($_POST['nome'])&&isset($_POST['email'])&& isset($_POST['RG'])&&isset($_POST['telefone']){
                $nome=$_POST['nome'];
				$email=$_POST['email'];
                $RG= $_POST['RG'];
				$telefone=$_POST['telefone'];
                
                $sql2 = "INSERT INTO Voluntario VALUES ($nome,$telefone,$RG,$email)";
				$status2 = sqlsrv_query($con,$sql2);
                
                 $sql3="INSERT INTO usuarioVoluntario VALUES ($usuario,(SELECT codVoluntario FROM Voluntario WHERE nome='$nome'))"; 
			     $status3= sqlsrv_query($con,$sql3);.
            }
            
        }

	}
?>

	</head>
	<body>
        <?php include 'menu.inc.php' ?>
		<div id="cadastro">
			<h2>Preencha os seguintes campos para prosseguir o cadastro</h2>
			<form>
			<label>Nome de usuário: </label><input type="text">
			<br>
			<br>
			<label>Senha: </label><input type="password">
			<br>
			<br>
			<label>O que você é?</label>
				<select>
					<option>Carente</option>
					<option>Voluntário</option>
					<option>Doador</option>
				</select>
            <input type="submit" value="Enviar" class="botao">    
			</form>
		</div>
		<img src="cadastro.png"></img>
	</body>
</html>
