<head>
	<title>Page d'inscription</title>
</head>


<section class="section">
	<h1 class="section__item section__police">Inscription</h1>
	<h2 class="section__item" style="font-size: 20px;">c'est gratuit (et ça le restera toujours)</h4>

	<form name="inscription" method="POST" action="/mvc/Controllermain/register">
		
		<div>
			<input class="section__item" type="text" name="prenom" placeholder="Prénom" value="<?php echo $data['prenom']?>">
			
			<input class="section__item" type="text" name="nom" placeholder="Nom de famille" value="<?php echo $data['nom']?>">
			<span class="form__err"><?php echo (empty($data['prenom_err'])) ? "" : "<br>".$data['prenom_err'];?></span>
			<span class="form__err"><?php echo "".$data['nom_err'];?></span>
		</div>
		

		<input class="section__item section_text" type="text" name="numero_email" placeholder="Numéro de mobile ou email" value="<?php echo $data['numero_email']?>">
		<br>
		<span class="form__err">
			<?php echo (empty($data['numero_email_err'])) ? "" : $data['numero_email_err']."<br>";?>
		</span>

		<input class="section__item section_text" type="text" name="numero_email_conf" placeholder="Confirmer Numéro de mobile ou email" value="<?php echo $data['numero_email_conf']?>">
		<br>
		<span class="form__err">
			<?php echo (empty($data['numero_email_conf_err'])) ? "" : $data['numero_email_conf_err']."<br>";?>
		</span>


		<input class="section__item section_text" type="password" name="mdp" placeholder="Nouveau mot de passe">
		<br><span class="form__err"><?php echo $data['mdp_err'];?></span>


		<h4 class="section__item">Date de naissance</h4>

		<select class="section__item" name="jour" value="<?php echo $data['jour']?>">
			<option value="jour">jour</option>
			<?php for($i=1;$i<=31;$i++): ?>
				<option value="<?php echo $i?>"><?php echo $i?></option>
			<?php endfor ?>
		</select>


		<select class="section__item" name="mois" value="<?php echo $data['mois']?>">
			<option value="mois">mois</option>
			<?php for($i=1;$i<=12;$i++): ?>
				<option value="<?php echo $i?>"><?php echo $i?></option>
			<?php endfor ?>
		</select>


		<select class="section__item" name="annee" value="<?php echo $data['annee']?>">
			<option value="annnee">annee</option>
			<?php for($i=0+1950;$i<=2020;$i++): ?>
				<option value="<?php echo $i?>"><?php echo $i?></option>
			<?php endfor ?>
		</select>
		

		
		<h6 class="info__h6" style="width: 150px; display: inline-block;">pourquoi indiquer ma date de naissance ?</h6></BR>
		<br><span class="form__err">
			<?php echo (empty($data['naissance_err'])) ? "" : $data['naissance_err']."<br>";?>
		</span>

		
		<input class="section__item" type="radio" name="sexe" value="homme">
			<label><b>Homme</b></label>
		</input>
		<input class="section__item" type="radio" name="sexe" value="femme">
			<label><b>Femme</b></label>
		</input>


		<h6 class="section__info">En cliquant sur inscription, vous accepter nos condition et indiquez que vous avez lu notre Politique d'utilisation des données, y compris notre Utilisation des cookies. Vous pouvez recevoir des notifications par texto de la part de Facebook et vous pouvez vous désabonnez a tout moment.</h6>

		<input class="submit__insc" type="submit" name="inscription" value="Inscription">
		<br><span class="form__val"><?php echo $data['valid'];?></span>
	</form>
</section>