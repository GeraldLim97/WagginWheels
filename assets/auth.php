<?php
function csrf_token($csrfToken) {
    //checks if csrf token matches, renews it check.
    if (!isset($_SESSION['csrf_token'])) { // Generate a new CSRF token if it doesnt exist
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    if ($csrfToken === $_SESSION['csrf_token']){
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        return true;
    } 
    return false;
}


?>