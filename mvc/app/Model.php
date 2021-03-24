<?php
class Model
{
	//Database variable 
    private $host = "localhost";
    private $db_name = "Site_test";
    private $username = "inserer votre nom d'utilisateur ici";
    private $password = "inserer votre mot de passe ici";

    //Property used for connection instance
    protected $_connexion;

    //Property used to customize request
    public $table;
    public $id;

    /**
     * Function of initialisation of the database
     *
     * @return void
     */
    public function getConnection(){
        //Removing the old connection
        $this->_connexion = null;

        //Try to connect at the DataBase
        try{
            $this->_connexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->_connexion->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }

    /**
     * With this method we retrieve user information via the id
     *
     * @return void
     */
    public function getOne(){
        $sql = "SELECT * FROM ".$this->table." WHERE id=".$this->id;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();    
    }

    /**
     * For get all of information in the Database at the table
     *
     * @return void
     */
    public function getAll(){
        $sql = "SELECT * FROM ".$this->table;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();    
    }
}
?>