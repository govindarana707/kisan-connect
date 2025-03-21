<?php
// Start the session
session_start();

// Destroy all session data
session_unset();      // Remove all session variables
session_destroy();    // Destroy the session

// Redirect to the homepage or login page after logout
header('Location: login.php');   // Redirect to login page after logging out
exit();
?>
