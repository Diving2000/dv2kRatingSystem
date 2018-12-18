<?php

  require_once('config.php'); // Database forbindelse
  require_once('functions.php'); // Funktioner

  // Standard-besked der vises til alle
  $number_of_responses = get_number_of_responses($con);
  $standard_message = "Den gennemsnitlige rating er " . get_average($con) . " ud af 5 baseret på " . $number_of_responses . " ratings.";
  $rated_average = round(get_average($con));

  // Hvis IP adressen ikke allerede findes i databsen, registrer rating og returner besked med antal stjerner
  if(isset($_GET['rating'])){
    switch($_GET['rating']) {
      case 1:
        $rate = 1;
        $message = shopRating($con, $rate);
        break;
      case 2:
        $rate = 2;
        $message = shopRating($con, $rate);
        break;
      case 3:
        $rate = 3;
        $message = shopRating($con, $rate);
        break;
      case 4:
        $rate = 4;
        $message = shopRating($con, $rate);
        break;
      case 5:
        $rate = 5;
        $message = shopRating($con, $rate);
        break;
      default:
        $message = "Du har ikke angivet en korrekt rating-værdi.";
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
      	Er du tilfreds?
    	</h1>
		</div>
		<?php
			if(!isset($_GET['rating'])){
		?>
		<p>
			Giv os din mening om den butiksservice du lige har modtaget...
		</p>
		<br>
    <?php 
			for($i = 5; $i >= 1; $i--){
				echo '<p><a href="?rating=' . $i . '"><i class="rate rate-' . $i . '"></i></a></p>'; 
			}
			}else {
				echo '<p>' . $message . '</p>';
				echo '<meta http-equiv="refresh" content="4;url=https://diving2000.dk/rating/shop.php" />';
			}
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