<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" media="screen" type="text/css" href="/mvc/views/css/style.css?ver=2">
</head>



<body>

	<nav class="nav" name="barredeconnection" >
		<form name="connexion" method="post" action="/mvc/Controllermain/login">
			<div class="nav__inner">
				<ul class="nav__list">
					<li class="nav__item">
						<h5 class="nav__h5">adresse e-mail ou mobile</h5>
						<input type="text" name="numero_email_login" placeholder="Votre login" value="<?php echo $data['numero_email_log']?>"/><BR/>
					</li>
					<li class="nav__item">
						<h5 class="nav__h5">Mot de passe</h5>
						<input type="password" name="mdp_login" placeholder="Votre mot de passe"/>
					</li>

					<li class="nav__item">
						<input type="submit" class="submit__connex" name="connexion" value="connexion" method="post">
					</li>
					<h6 class="info__h6">informations de compte oublier ?</h6>
					<span class="form__err"><?php echo $data['login_err'];?></span>
					<span><?php echo $data['valid_login'];?></span>
				</ul>
			</div>
		</form>
	</nav>
		
	<?php echo $content ?>

</body>
</html>