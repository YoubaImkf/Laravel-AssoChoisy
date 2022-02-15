<?php

namespace App\Models;
use PDO; //utilisation de PDO
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config; //on definie "Config" en ajoutant sonchemin

class PdoAssoChoisy extends Model
{
    use HasFactory;
    private static $serveur;
        private static $bdd;
        private static $user;
        private static $mdp;
        private static $monPdo;
	
/**
 * crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	public function __construct(){
        
        self::$serveur='mysql:host=' . Config::get('database.connections.mysql.host');
        self::$bdd='dbname=' . Config::get('database.connections.mysql.database');
        self::$user=Config::get('database.connections.mysql.username') ;
        self::$mdp=Config::get('database.connections.mysql.password');	  
        $this->monPdo = new PDO(self::$serveur.';'.self::$bdd, self::$user, self::$mdp); 
  		$this->monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		$this->monPdo =null;
	}
	
// -------------------------------------------


/** GESTIONNAIRE
 * Retourne l'utilisateur connecté sous forme d'un tableau associatif
 *
 * @return l'utisateur 
*/        
public function getUser($login,$mdp)
{
    $mdp = hash('sha256',$mdp);       /* ----php hash le mdp entrer POUR MATCHER LE HASHAGE DU SERVEUR ET LE mdp entrer -------*/
    
    $req = "select * from gestionnaire where login = :login and mdp = :mdp";
    $res =  $this->monPdo->prepare($req);
    $res->bindvalue(':login',$login);
    $res->bindvalue(':mdp',$mdp);
    $res->execute();
    $ligne = $res->fetch(); //fetch = rechercher (fetch : quand on recupere une seul ligne)
   
    return $ligne;

}

//----------------- ! faut savoir si on garde "ARTICLE" ou pas ! ---------------

/**
 * Retourne toutes les types sous forme d'un tableau associatif
 *
 * @return le tableau associatif des types 
*/
        public function getLesarticles()
	{
		$req = "select * from articles"; //faire la requete SQL
        $res=  self::$monPdo->query($req);
		$lesLignes = $res->fetchAll(); //(fetch : quand on recupere plusieur lignes et all pour tout recup)
           
		return $lesLignes;
                
	}



	public function getlesarticlesParAct($idactivite)
	{
        $req="select texte,id from articles where idactivites= :idactivite order by datejour desc"; //du plus recent au plus ancien
        $res =  $this->monPdo->prepare($req);
        $res->bindvalue(':idactivite',$idactivite);
        $res->execute();
		
   //condition si plus de 1 article PDO::FETCH_ASSOC sinon BOTH
        $laLigne = $res->fetchAll();
 

		return $laLigne; 

	}

    public function getArticle($id) //on recup l'id dun article
	{
        $req="select texte from articles where id= :id "; 
        
        $res =  self::$monPdo->prepare($req);
        $res->bindvalue(':id',$id);
        $res->execute();

        $laLigne = $res->fetch();
 

		return $laLigne; 

	}

    // A    rticle le plus recent 
    public function getarticleRecent()
    {
        $req="Select texte FROM articles WHERE datejour=(SELECT max(datejour) FROM articles) "; 
        //faire la requete SQL
        $res =  self::$monPdo->query($req);
		$laLigne = $res->fetch(PDO::FETCH_ASSOC); // on comprend pas mais merci wayra et L'INTERNET( on modifie le mode par défaut en /1 ...)

		return $laLigne; 

    }

    public function getTitreActivites($id)
    {

    $req="select libeler,id from activites where id= :id"; 
    
    $res = $this->monPdo->prepare($req);
    $res->bindvalue(':id',$id);
    $res->execute();
    $laLigne = $res->fetchAll();

    return $laLigne; 

    }
                    //////on utilise pas get image pour le moment//////
                    public function getimage($id)
                    {

                    $req="select nomimage from images,imgassocieractivites,activites where images.id = imgassocieractivites.idimage and activites.id = imgassocieractivites.idactivites and idactivites= :id";  // recup les image en fonction de lactivité

                    $res =  self::$monPdo->prepare($req);
                    $res->bindvalue(':id',$id);
                    $res->execute();
                    $laLigne = $res->fetchAll();

                    }

                    
  
 //------------A voir admin-FONCTIONS:  Modifier , Ajouter , Supprimer--------------//

 public function modifierArticle($id ,$texte)
 {

    $req="update articles set texte = '$texte' where id='$id' ";   
    var_dump($req);
    $res=  Pdoassochoisy::$monPdo->exec($req);
    return $res;

  }




}
