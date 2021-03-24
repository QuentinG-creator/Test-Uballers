<?php
class Controllermain extends Controller
{
	public function index()
	{	
		$this->render("viewmain");
	}

	/**
	 * It is the function register of the controller with her we can register any user
	 *
	 * @return void
	 *
	 */
	public function register()
	{
		//This variable is for get all of the data wen the user submit the form
		$data= [
			'nom' => '',
			'prenom' => '',
			'numero_email' => '',
			'numero_email_conf' => '',
			'numero' => '',
			'email' => '',
			'mdp' => '',
			'jour' => '',
			'mois' => '',
			'annee' => '',
			'naissance' => '',
			'sexe' => '',
			'nom_err' => '',
			'prenom_err' => '',
			'numero_email_err' => '',
			'numero_email_conf_err' => '',
			'mdp_err' => '',
			'naissance_err' => '',
			'valid' => ''
		];

		$this->loadModel("Users");
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{	

			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data= [
				'nom' => trim($_POST['nom']),
				'prenom' => trim($_POST['prenom']),
				'numero_email' => trim($_POST['numero_email']),
				'numero_email_conf' => trim($_POST['numero_email_conf']),
				'numero' => NULL,
				'email' => NULL,
				'mdp' => trim($_POST['mdp']),
				'jour' => trim($_POST['jour']),
				'mois' => trim($_POST['mois']),
				'annee' => trim($_POST['annee']),
				'naissance' => '',
				'sexe' => trim($_POST['sexe']),
				'nom_err' => '',
				'prenom_err' => '',
				'numero_email_err' => '',
				'numero_email_conf_err' => '',
				'mdp_err' => '',
				'naissance_err' => '',
				'valid' => ''
			];

			$mdpValidate="/^[a-zA-Z0-9!@#$%^&*]{8,20}$/";

			$numeroValidate="/^[0-9]{10}$/";

			//Validate of the password
			if(empty($data['mdp']))
			{
				$data['mdp_err']='Veuillez renseigner le champ';
			} 
			else if(!preg_match($mdpValidation,$data['mdp'])) 
			{
				$data['mdp_err']="Votre mot de passe doit contenir 8 caractéres minimum et 20 caractéres maximum";
			}

			//Validate of the email or mobile number
			if(empty($data['numero_email']))
			{
				$data['numero_email_err']='Veuillez renseigner le champ';
			} 

			//We check if the phone number was correctly write
			else if(preg_match("/^[0-9]{10}$/",$data['numero_email']))
			{
				
				$data['numero']=$data['numero_email'];
				if($this->Users->findUserByPhoneNumber($data))
				{
					$data['numero_email_err']='Numéro de téléphone déjà utilisé';
				}
			} 

			//We check the email adresse was correctly write 
			else if(filter_var($data['numero_email'],FILTER_VALIDATE_EMAIL)) 
			{
				$data['email']=$data['numero_email'];
				if($this->Users->findUserByEmail($data))
				{
					$data['numero_email_err']="Email déjà utilisé";
				}
			} 
			else if(empty($data['email']) && empty(['numero']))
			{
				$data['numero_email_err']="Veuillez saisir correctement votre email ou votre numéro de téléphone";
			}



			//Validate of the confirm for the email or the phone number	
			if(empty($data['numero_email_conf']))
			{
				$data['numero_email_conf_err']="Veuillez confirmer votre email ou numéro de téléphone";
			} 
			else if($data['numero_email'] != $data['numero_email_conf'])
			{
				$data['numero_email_conf_err']="Veuillez bien réécrire votre email ou numéro de téléphone";
			}

			//Validation of the first name
			if(empty($data['prenom']))
			{
				$data['prenom_err']="Veuillez renseigner le champ";
			} 

			//Validation of the last name
			if(empty($data['nom']))
			{
				$data['nom_err']="Veuillez renseigner le champ";
			} 

			//Validation of the birthday
			if($data['jour']!="jour" && $data['mois']!="mois" && $data['annee']!="annee")
			{
				$data['naissance']=$data['annee']."-".$data['mois']."-".$data['jour'];
			} 
			else 
			{
				$data['naissance_err']="Veuillez bien completer votre date de naissance";
			}

			
			if(empty($data['naissance_err']) && empty($data['nom_err']) && empty($data['prenom_err']) 
				&& empty($date['numero_email_err']) && empty($data['numero_email_conf_err']) && empty($data['mdp_err']))
			{
				$data['mdp']=password_hash($data['mdp'], PASSWORD_DEFAULT);

				if($this->Users->register($data));
				else echo "probleme sql";
				$data['valid']="Inscription réussi vous pouvez maintenant vous connecter";
			}

		}

		$this->render("viewmain", $data);
	}


	/**
	 * The function login of the controller is for log some user register
	 *
	 * @return void
	 */

	public function login()
	{
		//This variable is for get all of the data wen the user submit the form
		$data= [
			'numero_email_log' => '',
			'mdp_log' => '',
			'login' => '',
			'login_err' => '',
			'mdp_log_err' => '',
			'valid_login' => ''
		];

		$this->loadModel("Users");

		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{	
			
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


			$data= [
				'numero_email_log' => trim($_POST['numero_email_login']),
				'mdp_log' => trim($_POST['mdp_login']),
				'login' => '',
				'login_err' => '',
				'mdp_log_err' => '',
				'valid_login' => ''
			];


			$numeroValidation="/^[0-9]{10}$/";		

			//Validate of the email or mobile number
			if(empty($data['numero_email_log']))
			{
				$data['login_err']='Veuillez renseigner un numéro de téléphone ou un e-mail';
			} 

			//Check if it is a phone number
			else if(preg_match($numeroValidation,$data['numero_email_log']))
			{	
				
				$data['login']=$data['numero_email_log'];
			} 
			//Check if it is an e-mail 
			else if(filter_var($data['numero_email_log'],FILTER_VALIDATE_EMAIL)) 
			{
				$data['login']=$data['numero_email_log'];
			}

			//Validate of password
			if(empty($data['mdp_log']))
			{
				$data['mdp_log_err']="Veuillez renseigner un mot de passe";
			}


			//Check if we doesn't have any error
			if(empty($data['login_err']) && empty($data['mdp_log_err']))
			{
				$loggedUser=$this->Users->login($data['mdp_log'],$data['login']);
				
				if($loggedUser)
				{
					$data['valid_login']="connexion réussi";
				} 
				else
				{
					$data['login_err']="Mauvais mot de passe ou identifiant";
				}
			}
		}

		$this->render("viewmain",$data);
		
	}

}
?>