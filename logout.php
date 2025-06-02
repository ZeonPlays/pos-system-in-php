<?php  
require 'config/function.php';


if(isset($_SESSION['loggedIn'])) {
    
    logoutSession();
    redirect('login.php', 'Logout successful, see you soon');
} 


?>