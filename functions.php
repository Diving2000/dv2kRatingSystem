<?php

  // Check om brugerens IP adresse allerede er registreret (og mere end 2 gange)
  function check_ip($con, $ip_address){
    $sql = "SELECT * FROM blacklist WHERE ip_address = '{$ip_address}'";
    $result = $con->query($sql);
    if($result->num_rows < 1){
      return true;
    }else {
      return false;
    }
  }

  // Gem brugerens rating i database-tabellen 'rating', og gem samtidig brugerens IP adresse i tabellen 'blacklist'
  function save_rating($con, $rate, $ip_address){
    
    $rate = $con->real_escape_string($rate);
    
    if(is_numeric($rate) && $rate <= 5){
      $sql = "INSERT INTO rating (id, rating, timestamp) VALUES ('', {$rate}, NOW())";
      $con->query($sql);
    }else {
      return;
    }
    
    $blacklist_sql = "INSERT INTO blacklist (id, ip_address, timestamp) VALUES ('', '{$ip_address}', NOW())";
    $con->query($blacklist_sql);
    
  }

  // Returner den gennemsnitlige rating
  function get_average($con){
    
    $arr = array();
    
    $sql = "SELECT rating FROM rating";
    $result = $con->query($sql);
    while($row = $result->fetch_object()){
      $arr[] = $row->rating;
    }
    
    $average = array_sum($arr) / count($arr);
    $average = round($average, 1);
    
    return $average;
    
  }

  // Returner antal rækker i rating-tabellen
  function get_number_of_responses($con){
    
    $sql = "SELECT * FROM rating";
    $result = $con->query($sql);
    
    return $result->num_rows;
    
  }

  // Funktion der simplificerer processen med at gemme - lavet for at spare kode i switch-statement
  function rating($con, $rate, $ip_address){
    save_rating($con, $rate, $ip_address);
    return $message = "Tak for dit svar. Du har nu givet Diving 2000 " . $rate . " stjerner.";
  }
  function shopRating($con, $rate){
    $rate = $con->real_escape_string($rate);
    
    if(is_numeric($rate) && $rate <= 5){
      $sql = "INSERT INTO rating (id, rating, timestamp) VALUES ('', {$rate}, NOW())";
      $con->query($sql);
    }else {
      return;
    }
    
    return $message = "Du har givet Diving 2000 " . $rate . " stjerner.";
  }

