    <?php
    session_start(); // Start the session

    // Check if the user is logged in
    if (!isset($_SESSION['startuper'])) {
        // Redirect to the login page if the user is not logged in
        header("Location: ../Authentification/auth.html");
        exit();
    }

    // Include the necessary files
    include_once '../Model/Startuper.php'; // Include the Startuper model
    include_once 'connexion.php'; // Include the database connection

    // Check if the form data has been submitted via POST method
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $titre = $_POST['titre'];
        $descriptionProjet = $_POST['descriptionProjet'];
        $nbrActionsAVendre = $_POST['actAV'];
        $nbrActionsVendues = $_POST['actV'];
        $prixAction = $_POST['prixAct'];

        // Get the idStartuper from the session
        $idStartuper = $_SESSION['startuper']['id'];

        // SQL query to insert the project into the database
        $sql = "INSERT INTO projet (titre, descriptionProjet, nbrActionsAVendre, nbrActionsVendues, prixAction, idStartuper) 
                VALUES (:titre, :descriptionProjet, :nbrActionsAVendre, :nbrActionsVendues, :prixAction, :idStartuper)";

        // Prepare the SQL query
        $stmt = $dbh->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':descriptionProjet', $descriptionProjet);
        $stmt->bindParam(':nbrActionsAVendre', $nbrActionsAVendre);
        $stmt->bindParam(':nbrActionsVendues', $nbrActionsVendues);
        $stmt->bindParam(':prixAction', $prixAction);
        $stmt->bindParam(':idStartuper', $idStartuper);

        // Execute the query
        if ($stmt->execute()) {
            // Project added successfully
            // Redirect back to the profile page
        
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'redirect' =>'../View/Projects_List/Projects_List.php']);
            exit();
        } else {
            // An error occurred while adding the project
            // Handle the error accordingly (display an error message, log the error, etc.)
            echo "Error: Failed to add the project.";
        }
    } else {
        // If the form data is not submitted via POST method, redirect to the homepage
        echo "Error: Failed to add the project1.";
        exit();
    }
    ?>
