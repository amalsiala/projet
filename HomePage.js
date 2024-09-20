document.addEventListener("DOMContentLoaded", function() {
    // Event handler for the "Add Project" button
    document.querySelector("nav #AddProject").addEventListener("click", function() {
        // Redirect to the startup registration page
        window.location.href = '../HomePage/profil.php';
    });

    // Event handler for the "List Projects" button
    document.querySelector("nav #Project_List").addEventListener("click", function() {
        // Redirect to the Projects_List.php page
        window.location.href = '../Projects_List/Projects_List.php';
    });

    // Event handler for the form submission
    document.querySelector("#ajouter-projet form").addEventListener("submit", function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();

        // Serialize form data into a URL-encoded string
        const formData = new URLSearchParams(new FormData(this)).toString();

        // Send a POST request to projectController.php with the form data
        fetch('../../controller/projectController.php', {
            method: 'POST',
            body: formData,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            // Return the response text
            return response.json();
        })
        .then(data => {
            console.log("Received Data:", data);
            // Check the response text
            if (data.status === "success") {
                // Display a popup with OK button
                alert('Project added successfully!');
                window.location.href = '../Projects_List/Projects_List.php'
            } else {
                // Authentication failed, display an error message
                alert(data);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    document.querySelector("nav #Logout").addEventListener("click", function() {
        // Redirect to the logout page
        window.location.href = '../logout/logout.php';
    });
});
