<?php

// Function to check if the user is authenticated
function check_authentication() {
   
    // Check if a user session exists
    if (isset($_SESSION['user_id'])) {
        // User is authenticated
        return true;
    } else {
        // User is not authenticated
        return false;
    }
}

?>
