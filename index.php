<?php

  require_once('config.php'); // Database forbindelse
  require_once('functions.php'); // Funktioner

  $ip_address = $_SERVER['REMOTE_ADDR']; // Find den besøgendes IP adresse

  // Standard-besked der vises til alle
  $number_of_responses = get_number_of_responses($con);
  $standard_message = "Den gennemsnitlige rating er " . get_average($con) . " ud af 5 baseret på " . $number_of_responses . " ratings.";
  $rated_average = round(get_average($con));

  // Hvis IP adressen ikke allerede findes i databsen, registrer rating og returner besked med antal stjerner
  if(isset($_GET['rating'])){
    if(check_ip($con, $ip_address)){
      switch ($_GET['rating']) {
        case 1:
          $rate = 1;
          $message = rating($con, $rate, $ip_address);
          break;
        case 2:
          $rate = 2;
          $message = rating($con, $rate, $ip_address);
          break;
        case 3:
          $rate = 3;
          $message = rating($con, $rate, $ip_address);
          break;
        case 4:
          $rate = 4;
          $message = rating($con, $rate, $ip_address);
          break;
        case 5:
          $rate = 5;
          $message = rating($con, $rate, $ip_address);
          break;
        default:
          $message = "Du har ikke angivet en korrekt rating-værdi.";
      }
    }else {
      $message = "Du har tidligere givet Diving 2000 en rating, så vi gemmer ikke dit svar denne gang. :-)";
    }
  }else {
    $message = "Du har ikke givet en rating.";
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Diving 2000's Service Rating</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="icon" href="https://diving2000.dk/trustpilot/Logo_diving_2000-white-border.png" type="image/x-icon"/>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="style.css">
  
</head>
<body>
  
  <div class="panel">
    <div class="logo">
      <img src="Logo_diving_2000.png" alt="">
      <h1>
        Diving 2000's service rating
      </h1>
      
    </div>
    <?php 
      echo '<p><i class="rate rate-' . $rate . '"></i>' . $message . '</p>'; 
    ?>
  </div>
  <?php
    if($standard_message){
      echo '<div class="panel">';
      echo '<p><i class="rate rate-' . $rated_average . '"></i>' . $standard_message . '</p>';
      echo '</div>';
    }
  ?>
  
</body>
</html>