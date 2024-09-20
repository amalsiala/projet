<?php
// Include the database connection
// Include the database connection
include_once 'connexion.php';

// Retrieve the raw POST data
$data = file_get_contents("php://input");

// Check if the POST data is not empty
if (!empty($data)) {
    // Decode the JSON data
    $requestData = json_decode($data);

    // Check if the project ID and updated data are provided
    if (isset($requestData->projectId) && isset($requestData->label) && isset($requestData->newValue)) {
        // Retrieve the project ID and updated data
        $projectId = $requestData->projectId;
        $label = $requestData->label;
        $newValue = $requestData->newValue;

        // Prepare the SQL query to update the project details
        $sql = "UPDATE projet SET $label = :newValue WHERE id_projet = :projectId";
        echo "Debugging Output:<br>";
        echo "Received Data: " . $data . "<br>";
        echo "Decoded Data: " . print_r($requestData, true) . "<br>";
        echo "Project ID: " . $projectId . "<br>";
        echo "Label: " . $label . "<br>";
        echo "New Value: " . $newValue . "<br>";
        echo "SQL Query: " . $sql . "<br>";
        // Prepare and execute the SQL query
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':projectId', $projectId);
        $stmt->bindParam(':newValue', $newValue);
        
        if ($stmt->execute()) {
            // Send a success response
            echo json_encode(array("message" => "Project updated successfully."));
        } else {
            // Send an error response if the update operation fails
            echo json_encode(array("error" => "Failed to update the project."));
        }
    } else {
        // Send an error response if the project ID, label, or new value is not provided
        echo json_encode(array("error" => "Project ID, label, or new value not provided."));
    }
} else {
    // Send an error response if the POST data is empty
    echo json_encode(array("error" => "No data received."));
}

?>
