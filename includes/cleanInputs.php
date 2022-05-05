<?php

function cleanUserInput($userinput) {

    include '../../database/connection.php';

    // Open your database connection
    
    // check if input is empty
  if (empty($userinput)) {
    return;
  } else {
    
  // Strip any html characters
  $userinput = htmlspecialchars($userinput);
  
  // Clean input using the database  
  $userinput = mysqli_real_escape_string($con, $userinput);
  }
 
  // Return a cleaned string
return $userinput;
}

?>