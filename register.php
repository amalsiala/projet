<?php
require_once 'connexion.php';
$existe = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $nom = $_POST['firstName'];
        $prenom = $_POST['lastName'];
        $cin = $_POST['cin'];
        $mail = $_POST['email'];
        $nomEps = $_POST['companyName'];
        $adresseEps = $_POST['companyAddress'];
        $regCom = $_POST['registerNumber'];
        $pseudo = $_POST['pseudo'];
        $mdp = $_POST['mdp'] ;
        $mdpHashed = password_hash($mdp, PASSWORD_DEFAULT);
        $dbh = new PDO("mysql:host=localhost;dbname=pweb", "root", "");

        $existe = utilisateurExiste($mail, $dbh);

        if (!$existe) {
            // Insert data into database
            $stmt = $dbh->prepare("INSERT INTO startuper (nom, prenom, cin, mail, nomEps, adresseEps, regCom, pseudo, mdp) 
                VALUES (:nom, :prenom, :cin, :mail, :nomEps, :adresseEps, :regCom, :pseudo, :mdp)");

            // Bind parameters
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':cin', $cin);
            $stmt->bindParam(':mail', $mail);
            $stmt->bindParam(':nomEps', $nomEps);
            $stmt->bindParam(':adresseEps', $adresseEps);
            $stmt->bindParam(':regCom', $regCom);
            $stmt->bindParam(':pseudo', $pseudo);
            $stmt->bindParam(':mdp', $mdp);

            if ($stmt->execute()) {
                // JavaScript to display success popup and redirect
                echo "<script>alert('Account created successfully!'); window.location.href = '../View/Authentification/auth.html';</script>";
                exit;
            } else {
                echo "Erreur lors de l'inscription."; // Error message
            }
     } else {
            // JavaScript to display existing user popup
            echo "<script>alert('User already exists. Please use a different email.'); window.location.href = '../View/Inscription/inscri.html';</script>";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage(); // Error message
    }
}
function utilisateurExiste($mail, $dbh) { 

    $sql = "SELECT COUNT(*) FROM startuper WHERE mail = :email";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':email', $mail);
    $stmt->execute();
    $nombreUtilisateurs = $stmt->fetchColumn();
    return ($nombreUtilisateurs > 0);
}
?>
