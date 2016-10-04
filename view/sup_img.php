<?php
session_start();
include("../fonction.php");

if (!isset($_GET['id'])
  || empty($_GET['id'])
  || !isset($_SESSION['pseudo'])) {
  header("Location: ../drive");
} else {
  $id = $_GET['id'];
  $pseudo = $_SESSION['pseudo'];
  echo $pseudo;
  if (is_allowed_to_delete($id, $pseudo)) {
    delete_img($id);
    header("Location: ../drive");
  } else {
    echo "Vous n'êtes pas autorisé à supprimer cette image...";
  }
}

?>
