<?php

/* Point global sur toute la programmation de ce test.
 * Pour ce qui est du temps passer dessus il est d'environ 12h au total.
 * Le php m'a pris environ 8h
 * La partie HTML5 CSS m'a pris 4h environ
 *
 *
 * Difficulter rencontrait :
 * 1.Quelques soucis au niveau de la programmation de l'enregistrement des utilisateurs et de la connexion.
 * 2.Sur la partie css des difficultés a bien mettre en place la page d'inscription.
 * 3.Au niveau de la partie HTML pas vraiment de difficulté rencontrer.
 * 
 * Pour ce qui est des commentaires j'ai essayé de les faire au maximum en anglais.
 * 
 * Version : 1.0
 */

//We go to generate an constant for get the road of index.php
define('ROOT', str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));


//We separate the parameters
$parameters=explode('/',$_GET['p']);

require_once(ROOT.'app/Model.php');
require_once(ROOT.'app/Controller.php');
//If we have one parameters else we go to the controller main at the method index 
if($parameters[0] != "")
{
	//We save the first parameters of the controller and we go to put seem first case in upper
	$controller=ucfirst($parameters[0]);

	//if we don't have any action we go to take the action index
	$action= isset($parameters[1]) ? $parameters[1] : 'index';

	//I call the controller
	require_once(ROOT.'controller/'.$controller.".php");

	//We instantiate the controller
	$controller = new $controller();

	//We call the action of the controller
	if (method_exists($controller,$action)) {
		unset($parameters[0]);
		unset($parameters[1]);
		

		//we call the method
		call_user_func_array([$controller,$action], $parameters);
	}	
	else {
		//we send an error 404 and a message
		http_response_code(404);
        echo "La page recherchée n'existe pas";
	}
} 
else
{
	require_once(ROOT.'controller/Controllermain.php');

	$controller = new Controllermain();

	$controller->index();

}
