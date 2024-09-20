<?php
include_once 'connexion.php';
require_once(__DIR__ . "/../Model/startuper.php");

// Check if data has been submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['mdp'];

    // SQL query to check pseudo and password in the database
    $sql = "SELECT * FROM startuper WHERE pseudo = :pseudo AND mdp = :mdp";

    // Prepare the SQL query
    $stmt = $dbh->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':pseudo', $pseudo);
    $stmt->bindParam(':mdp', $mdp);

    // Execute the query
    $stmt->execute();

    // Fetch the result
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the user exists and the password is correct
    if ($utilisateur) {
        // Authentication successful
        // Start session
        session_start();
        
        // Store user data in session
        $_SESSION['startuper'] = $utilisateur;
        
        // Return JSON response indicating success
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'redirect' => '../HomePage/profil.php']);
        exit; // Stop script execution
    } else {
        // Authentication failed
        // Return JSON response indicating failure
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Pseudo or password incorrect.']);
        exit; // Stop script execution
    }
}
?>
