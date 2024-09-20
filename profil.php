<?php
// Include necessary files and start session
include_once '../../Model/Startuper.php';
include_once '../../Controller/loginController.php';

// Start session
session_start();

// making sure of  $startuper  in the session :: 
if (isset($_SESSION['startuper']) && is_array($_SESSION['startuper'])) {
  // Retrieve $startuper from the session
  $startuperData = $_SESSION['startuper'];
  
  // Check the pk keys exist in the array
  if (isset($startuperData['id'])) {
      // Access the id directly from the array
      $idStartuper = $startuperData['id'];
      $nomStartuper = $startuperData['nom'];
      $prenomStartuper = $startuperData['prenom'];
      
      echo "<script>console.log('ID Startuper: $idStartuper');</script>";
  } else {
      // Redirect to login page if the necessary data is missing
      header("Location: ../Authentification/auth.html");
      exit(); // Stop further execution
  }
} else {
  // Redirect to login page if no user is logged in or the data is not in the expected format
  header("Location: ../Authentification/auth.html");
  exit(); // Stop further execution
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Startuper</title>
  <link rel="stylesheet" href="../../star.css">
</head>
<body>
  <header>
    <h1>Profil Startuper</h1>
    
    <nav>
        <ul>
            <li><a id="AddProject">Ajouter Projet</a></li>
        
            <li><a id="Project_List">Lister Projets Déposés</a></li>
          
            <li><a id="Logout">Déconnexion</a></li>
        </ul>
    </nav>
  </header>
  
  <section id="profil-details">
    <h2>Détails du Profil</h2>
    <!-- Insert user profile details here -->
    <p><?php echo '<div class="nomPrenom">' . $nomStartuper . " " . $prenomStartuper . '</div>';?></p>
    <!-- You can display other profile details here -->
  </section>

  <section id="ajouter-projet">
    <h2>Ajouter Projet</h2>
    <form action="../../controller/ajouterProjet.php" method="post">          
      <label for="titre">Project Title</label>
      <input name="titre" id="titre" type="text"><br>
      <label for="descriptionProjet">Description</label>
      <textarea name="descriptionProjet" id="descriptionProjet"></textarea><br>
      <label for="actAV">Number of Actions for Sale</label>
      <input name="actAV" id="actAV" type="number"><br>
      <label for="actV">Number of Actions Sold</label>
      <input name="actV" id="actV" type="number"><br>
      <label for="prixAct">Price per Action</label>
      <input name="prixAct" id="prixAct" type="number">
      <button type="submit">Add</button>
    </form>
  </section>

  <script src="../JS/HomePage.js"></script>
</body>
</html>
