<?php
  include("../fonction.php");
  $DB = open_DB();
  $req = $DB->prepare("SELECT pseudo FROM users");
	$req->execute();
  $array_pseudo = array();
  
  while (($ligne = $req->fetch())) {
    array_push($array_pseudo, $ligne['pseudo']);
  }
  
  $dataLen = count($array_pseudo);
  sort($array_pseudo);
  
  $results = array();
  for ($i = 0 ; $i < $dataLen && count($results) < 10 ; $i++) {
    if (stripos($array_pseudo[$i], $_GET['s']) === 0) { 
      array_push($results, $array_pseudo[$i]); 
    }
  }
  echo implode(' ', $results);
?>
