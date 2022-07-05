<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" name="robots" content="noindex, nofollow">
    <title>..:: Sistema ::..</title>
	<link rel="shortcut icon" href="../images/icons/cadastro.fw.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" type="text/css" href="../styles/login.css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        //window.alert = function(){};
        var defaultCSS = document.getElementById('bootstrap-css');
        function changeCSS(css) {
            if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />'); 
            else $('head > link').filter(':first').replaceWith(defaultCSS); 
        }
        $( document ).ready(function() {
			var iframe_height = parseInt($('html').height()); 
			window.parent.postMessage( iframe_height, 'https://bootsnipp.com');	

			$("#entrar").click(function() {

				var email = $("#login").val();
				var senha = $("#senha").val();

				// Validação dos campos
				if (email == "") {
					$("#login").css("background-color","#FF6666");
					alert("Informe o seu login!");
					$("#login").focus();
					return false;
				}
				if (senha == "") {
					$("#senha").css("background-color","#FF6666");
					alert("Informe a sua senha!");
					$("#senha").focus();
					return false;
				}
				$.ajax({
					url: "../controller/action_login.php",
					type: "POST",
					data: { postLogin:'login', postEmail:email, postSenha:senha },
					dataType: "html",
					success: function(res) {
						teste = res.substring(2, 1);						
						switch (teste) {
							case "2":
								alert("Usuário não encontrado");
							break;
							case "0":
								alert("Senha incorreta");
							break;
							default: 
								$(form_login).attr("action","teste.php");
								$(form_login).attr("method","post");
								$(form_login).submit();   
						}
						$("#login").val("");
						$("#senha").val("");
					}
				});
			});
		});		
    </script>
</head>
<body>
    <div class="container">
		<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-4">
				<h1 class="text-center login-title">Entre com seu login</h1>
				<div class="account-wall">
					<img class="login-img" src="../images/acesso.png" alt="">
					<form name="form_login" id="form_login" class="form-signin" method="post" action="">
						<input type="text" class="form-control" placeholder="Login" autocomplete="nope" name="login" id="login"></br>
						<input type="password" class="form-control" placeholder="Senha" autocomplete="nope" name="senha" id="senha" >
						<a href="#" class="btn btn-block btn-primary btn-primary" name="entrar" id="entrar"> Entrar</a>
						<label class="checkbox pull-left"><input type="checkbox" value="remember-me">Recuperar senha</label>
						<a href="#" class="pull-right need-help">Precisa de ajuda? </a><span class="clearfix"></span>
					</form>
				</div>
				<a href="cadastro_user.php" class="text-center new-account">Crie uma nova conta </a>
			</div>
		</div>
	</div>
</body>
</html>