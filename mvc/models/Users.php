<?php
class Users extends Model
{
	public function __construct()
	{
		$this->table="Users";
		$this->getConnection();
	}

	/** 
	 * This function is to find one Users with then Number
	 *
	 * @param Array $data 
	 * @return void
	 */

	public function findUserByPhoneNumber($data)
	{
		try{
	        $query = $this->_connexion->prepare('SELECT * FROM Users WHERE NumeroMob=:numero');
	        $query->bindParam(':table',$this->table);
	        $query->bindParam(':numero',$data['numero']);
	        $query->execute();
	        return $query->fetch();
	        
	    }
	    catch(PDOException $e)
	    {
	        echo 'findUserByPhoneNumber. Error : '.$e->getMessage();
	    }
	}

	/** 
	 * This function is to find one Users with then Email
	 *
	 * @param Array $data 
	 * @return void
	 */

	public function findUserByEmail($data)
	{
		try{
	        $query = $this->_connexion->prepare('SELECT * FROM Users WHERE Email=:email');
	        $query->bindParam(':email',$data['email']);
	        $query->execute();
	        return $query->fetch();
	        
	    }
	    catch(PDOException $e)
	    {
	        echo 'findUserByEmail function. Error : '.$e->getMessage();
	    }
	}

	/**
	 * This function is for the login of many Users
	 * 
	 * @param String $login
	 * @param String $mdp
	 * @return void
	 */
	public function login(String $mdp, String $login)
	{
		try{
			$query = $this->_connexion->prepare('SELECT * FROM Users WHERE Email=:email OR NumeroMob=:numero');

			$query->bindParam(':email',$login);
			$query->bindParam(':numero',$login);
			$query->execute();
			$row=$query->fetch();
			$hashedMdp=$row['Mdp'];

			if(password_verify($mdp,$hashedMdp)){
				return $row;
			}else {
				return false;
			}
			return 0;
		} 
		catch (PDOException $e)
		{
			echo 'Login function. Error : '.$e->getMessage();
		}
			
	}

	/**
	 * The principal function for add the new Users at the database
	 *
	 * @param array $data
	 * @return void
	 */
	public function register(array $data)
	{
		try{
    
	        //We go to insert in the database the data.
	        $query = $this->_connexion->prepare('
	            INSERT INTO Users (id, Prenom, Nom, NumeroMob, Email, Mdp, Date_naissance, Sexe) VALUES 
	            (NULL,:prenom,:nom,:numeroMob,:email,:mdp,:date_naissance,:sexe)');
	        $query->bindParam(':table',$this->table);
	        $query->bindParam(':prenom',$data['prenom']);
	        $query->bindParam(':nom',$data['nom']);
	        $query->bindParam(':numeroMob',$data['numero']);
	        $query->bindParam(':email',$data['email']);
	        $query->bindParam(':mdp',$data['mdp']);
	        $query->bindParam(':date_naissance',$data['naissance']);
	        $query->bindParam(':sexe',$data['sexe']);
	        if($query->execute()) return true;
	        else return false;

	    }
	    catch(PDOException $e)
	    {
	        echo 'Register function. Error : '.$e->getMessage();
	    }
	} 
}
?>