// Function to handle editing a row
function editRow(projectId, label, newValue) {
    // Send the updated data to the server for processing
    saveEdit(projectId, { [label]: newValue });
}

// Function to handle saving the edited data
function saveEdit(projectId, updatedData) {
    // Log the updatedData to check its structure
    console.log("Updated Data:", updatedData);

    // Send the updated data to the server for processing
    fetch('../../Controller/EditProject.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            projectId: projectId,
            updatedData: updatedData
        }),
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Log the response from the server
        // Optionally, update the UI to reflect the changes
        alert(data.message); // Display a message to the user
        window.location.reload(); // Reload the page to reflect the changes
    })
    .catch((error) => {
        console.error('Error:', error);
        alert("An error occurred while saving the changes. Please try again later.");
    });
}

// Function to make a cell editable
function makeEditable(cell, projectId, label) {
    // Get the current text content of the cell
    const text = cell.textContent.trim();

    // Create an input field
    const input = document.createElement('input');
    input.type = 'text';
    input.value = text;

    // Replace the cell's content with the input field
    cell.innerHTML = '';
    cell.appendChild(input);

    // Set focus on the input field
    input.focus();

    // Add an event listener to save changes when the input field loses focus
    input.addEventListener('blur', function() {
        // Get the new value from the input field
        const newValue = input.value;

        // Call the editRow function with the project ID, label, and new value
        editRow(projectId, label, newValue);
    });
}





// Function to handle deleting a project
function deleteProject(projectId) {
    // Send a request to delete the project with the specified ID
    fetch('../../Controller/DeleteProject.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            projectId: projectId,
        }),
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Log the response from the server
        // Optionally, update the UI to reflect the changes
        alert(data.message);
    
        // Reload the page
        window.location.reload();
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}


// Event listener for the DOMContentLoaded event
document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("nav #AddProject").addEventListener("click", function() {
        // Redirect to the startup registration page
        window.location.href = '../HomePage/profil.php';
    });

    // Event handler for the "List Projects" button
    document.querySelector("nav #Project_List").addEventListener("click", function() {
        // Redirect to the Projects_List.php page
        window.location.href = '../Projects_List/Projects_List.php';
    });
    document.querySelector("nav #Logout").addEventListener("click", function() {
        // Redirect to the logout page
        window.location.href = '../logout/logout.php';
    });
    // Add event listeners for edit and delete buttons
    document.querySelectorAll('.Custom-button').forEach(button => {
        button.addEventListener('click', function() {
            const projectId = this.dataset.projectId;
            editRow(projectId);
        });
    });
// delete project 
    document.querySelectorAll('.Custom-button1').forEach(button => {
        button.addEventListener('click', function() {
            const projectId = this.dataset.projectId;
            deleteProject(projectId);
        });
    });
});
