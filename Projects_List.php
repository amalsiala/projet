  <?php
  // Include necessary files and start session
  include_once '../../Model/Startuper.php';
  include_once '../../Controller/loginController.php';

  // Start session
  session_start();

  // Check if $startuper is defined in the session
  if (!isset($_SESSION['startuper']) || !is_array($_SESSION['startuper'])) {
      // Redirect to the login page if the user is not logged in
      header("Location: ../Authentification/auth.html");
      exit();
  }

  //obtenir startuper data from the session
  $startuperData = $_SESSION['startuper'];

  // Extract startuper details
  $idStartuper = $startuperData['id'];
  $nomStartuper = $startuperData['nom'];
  $prenomStartuper = $startuperData['prenom'];

  // Include the database connection
  include_once '../../Controller/connexion.php';

  // Fetch projects submitted by the startuper
  $stmt = $dbh->prepare("SELECT * FROM projet WHERE idStartuper = :idStartuper");
  $stmt->bindParam(':idStartuper', $idStartuper);
  $stmt->execute();
  $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
      <!-- Insert user profile details -->
      <p><?php echo '<div class="nomPrenom">' . $nomStartuper . " " . $prenomStartuper . '</div>';?></p>
      <!-- You can display other profile details  -->
    </section>

    <section id="List-projet">
      <div class="container1">
        <h2>Projets soumis</h2>
        <ul class="responsive-table">
          <li class="table-header">
            <div class="col col-1">Project Title</div>
            <div class="col col-2">Description</div>
            <div class="col col-3">Number of Actions<br />for Sale</div>
            <div class="col col-4">Number of Actions<br />Sold</div>
            <div class="col col-5">Price per Action</div>
            <div class="col col-6">Actions</div> 
          </li>
          <?php foreach ($projects as $project): ?> <!-- boucle  pour itérer sur chaque élément du tableau -->
            <li class="table-row"data-project-id="<?php echo htmlspecialchars($project['id_projet']); ?>">
              
            <div class="col col-1" data-label="Project Title" data-project-id="<?php echo htmlspecialchars($project['id_projet']); ?>" onclick="makeEditable(this, '<?php echo htmlspecialchars($project['id_projet']); ?>', 'Project Title')"><?php echo htmlspecialchars($project['titre']); ?></div>
<div class="col col-2" data-label="Description" onclick="makeEditable(this, '<?php echo htmlspecialchars($project['id_projet']); ?>', 'Description')"><?php echo htmlspecialchars($project['descriptionProjet']); ?></div>
<div class="col col-3" data-label="Nombre d'actions à vendre" onclick="makeEditable(this, '<?php echo htmlspecialchars($project['id_projet']); ?>', 'Nombre d\'actions à vendre')"><?php echo htmlspecialchars($project['nbrActionsAVendre']); ?></div>
<div class="col col-4" data-label="Nombre d'actions vendues" onclick="makeEditable(this, '<?php echo htmlspecialchars($project['id_projet']); ?>', 'Nombre d\'actions vendues')"><?php echo htmlspecialchars($project['nbrActionsVendues']); ?></div>
<div class="col col-5" data-label="Prix par action" onclick="makeEditable(this, '<?php echo htmlspecialchars($project['id_projet']); ?>', 'Prix par action')"><?php echo htmlspecialchars($project['prixAction']); ?></div>

            <div class="col col-6" data-label="Actions">
                <!-- Add delete and edit buttons -->
                <button class="Custom-button" data-project-id="<?php echo htmlspecialchars($project['id_projet']); ?>" onclick="editRow(<?php echo htmlspecialchars($project['id_projet']); ?>)">Edit</button>
                
                <button  class="Custom-button1" onclick="deleteProject(<?php echo htmlspecialchars($project['id_projet']); ?>)">Delete</button>
                
            </div>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </section>

    <script src="../JS/Projects_List.js"></script>
  </body>
  </html>
