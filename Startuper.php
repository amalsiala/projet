<?php
    class startuper
    {
        private $id;
        private $nom;
        private $prenom;
        private $cin;
        private $mail;
        private $nomEps;
        private $adresseEps;
        private $regCom;
        private $pseudo;
        private $mdp;
       


        public function __construct($id,$nom,$prenom,$cin,$mail,$nomEps,$adresseEps,$regCom,$pseudo,$mdp)
        {
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->cin = $cin;
            $this->mail = $mail;
            $this->nomEps = $nomEps;
            $this->adresseEps = $adresseEps;
            $this->regCom = $regCom;
            $this->pseudo = $pseudo;
            $this->mdp = $mdp;
            
        }

        
        public function getId()
        {
            return $this->id;
        }
        public function getNom() {
            return $this->nom;
        }
    
        public function getPrenom() {
            return $this->prenom;
        }
    
        public function getCin() {
            return $this->cin;
        }
    
        public function getMail() {
            return $this->mail;
        }
    
        public function getNomEps() {
            return $this->nomEps;
        }
    
        public function getAdresseEps() {
            return $this->adresseEps;
        }
    
        public function getregCom() {
            return $this->regCom;
        }
    
        public function getPseudo() {
            return $this->pseudo;
        }
    
        public function getMdp() {
            return $this->mdp;
        }
    
        // Setters
       
        public function setId($id)
        {
            $this->id = $id;
        }
        public function setNom($nom) {
            $this->nom = $nom;
        }
    
        public function setPrenom($prenom) {
            $this->prenom = $prenom;
        }
    
        public function setCin($cin) {
            $this->cin = $cin;
        }
    
        public function setMail($mail) {
            $this->mail = $mail;
        }
    
        public function setNomEps($nomEps) {
            $this->nomEps = $nomEps;
        }
    
        public function setAdresseEps($adresseEps) {
            $this->adresseEps = $adresseEps;
        }
    
        public function setregCom($regCom) {
            $this->regCom = $regCom;
        }
    
        public function setPseudo($pseudo) {
            $this->pseudo = $pseudo;
        }
    
        public function setMdp($mdp) {
            $this->mdp = $mdp;
        }
    

        // Dans la classe Startuper
public function getProjetsDeposes(PDO $dbh) {
    // Préparation de la requête SQL
    $sql = "SELECT * FROM projet WHERE idStartuper = :idStartuper";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':idStartuper', $this->id);
    $stmt->execute();

    // Récupération des résultats
    $projets = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $projets;
}

    }   
?>