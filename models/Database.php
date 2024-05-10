<?php
class Database {
    private $host = "localhost";
    private $utilisateur = "raphael";
    private $motDePasse = "raphael"; 
    private $baseDeDonnees = "location_run3"; 
    
    private $connexion;
    
    public function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->baseDeDonnees}";
            $options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
            $this->connexion = new PDO($dsn, $this->utilisateur, $this->motDePasse, $options);
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
            exit;
        }
    }
    
    // Méthode pour préparer une requête SQL
    public function prepare($sql) {
        return $this->connexion->prepare($sql);
    }
    
    // Méthode pour exécuter une requête SQL
    public function executer($sql, $params = []) {
        try {
            $statement = $this->connexion->prepare($sql);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            echo "Erreur de requête : " . $e->getMessage();
            exit;
        }
    }
    
    public function lastInsertId() {
        // Utiliser la méthode lastInsertId() de l'objet PDO pour récupérer l'identifiant de la dernière ligne insérée
        return $this->connexion->lastInsertId();
    }
}
