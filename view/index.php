<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title>..:: Sistema ::..</title>
	<link rel="shortcut icon" href="../images/icons/cadastro.fw.png"/>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" type="text/css" href="../styles/geral.css">
	<script src="../scripts/jquery-1.12.4.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function() {

			$("#botao").click(function() { 		                                       
				if (confirm("Confirma?")) { 
					$(principal).attr("action","teste.php");
					$(principal).attr("method","post");
					$(principal).submit();                
				}      
			});
		});
	</script>
</head>
<body>
<form name="principal" id="principal" method="post" action="">
<?php
include_once("../model/connect.php");
include_once("../controller/trata_geral.php");

echo "<br>";

$res = Query::getUsersPerfil("1");

if ($res) {

	echo("<table>
			<tr>
				<th colspan=4>Usu&aacute;rios</th>
			</tr>
			<tr>
				<th>Login</th>
				<th>Nome</th>
				<th>Perfil</th>
			</tr>");

	while($row = mysqli_fetch_object($res)) {

		echo "<tr>
				<td align=center>".$row->users_name."</td>
				<td>".$row->users_full_name."</td>
				<td>".TrataStrings::exibeSpecialChars($row->perfil_nome)."</td>
		</tr>";
	}
	echo("</table>");
}
?>

<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Entre com seu login</h1>
            <div class="account-wall">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120" alt="">
                <form class="form-signin">
                <input type="text" class="form-control" placeholder="Login" required autofocus>
                <input type="password" class="form-control" placeholder="Senha" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Entre</button>
                <label class="checkbox pull-left">
                <input type="checkbox" value="remember-me">Relembre</label>
                <a href="#" class="pull-right need-help">Precisa de ajuda? </a><span class="clearfix"></span>
                </form>
            </div>
            <a href="#" class="text-center new-account">Crie uma Conta </a>
        </div>
    </div>
</div>
<div style="text-align: center; width:100%; position: relative; top: 0px;">
	<img src="../images/botao_atualizar.fw.png" id="botao" name="botao" />    
</div>
</form>
</body>
</html>