<?php
// Include the database connection
include_once 'connexion.php';

// Retrieve the raw POST data
$data = file_get_contents("php://input");

// Check if the POST data is not empty
if (!empty($data)) {
    // Decode the JSON data
    $requestData = json_decode($data);

    // Check if the project ID is provided
    if (isset($requestData->projectId)) {
        // Retrieve the project ID
        $projectId = $requestData->projectId;

        // Prepare and execute the SQL query to delete the project
        $stmt = $dbh->prepare("DELETE FROM projet WHERE id_projet = :projectId");
        $stmt->bindParam(':projectId', $projectId);

        if ($stmt->execute()) {
            // Send a success response
            echo json_encode(array("message" => "Project deleted successfully."));
        } else {
            // Send an error response if the deletion operation fails
            echo json_encode(array("error" => "Failed to delete the project."));
        }
    } else {
        // Send an error response if the project ID is not provided
        echo json_encode(array("error" => "Project ID not provided."));
    }
} else {
    // Send an error response if the POST data is empty
    echo json_encode(array("error" => "No data received."));
}
?>
