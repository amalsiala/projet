// Attente du chargement complet du DOM avant d'exécuter le script
document.addEventListener("DOMContentLoaded", function() {
  // Ajout d'un écouteur d'événements de soumission au formulaire avec l'ID "registerForm
    document.getElementById("registerForm").addEventListener("submit", function(event) {
       // Empêche le comportement par défaut du formulaire
      event.preventDefault(); // Prevent the form from submitting normally
  
      // Collect form data
      var formData = new FormData(this);
  
      //Envoi des données de formulaire au script PHP 
      fetch('register.php', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.text();
      })
      .then(data => {
  
        console.log(data);
        window.location.href = "Authentification/auth.html"; // Redirect to success page
      })
      .catch(error => {
        // Handle error
        console.error('There was a problem with the fetch operation:', error);
      });
    });
  });
  