<?php
session_start();

function open_DB() {
	return new PDO(/*BDDname*/ "mysql:host=localhost; dbname=pp", "root", "6j4EcP5p");
}	

function is_DB($pseudo, $password) {
	$DB = open_DB();
	$req = $DB->prepare("SELECT pseudo, password FROM users WHERE pseudo = :pseudo AND password = :password");
	$req->execute(array("pseudo"=>$pseudo, "password"=>$password));

	if ($req->fetch() == false) {
		return false;
	} else {
		return true;
	}
}

function is_pseudo_used($pseudo) {
	$DB = open_DB();
	$req = $DB->prepare("SELECT pseudo FROM users WHERE pseudo = :pseudo");
	$req->execute(array("pseudo"=>$pseudo));

	if ($req->fetch() == false) {
		return false;
	} else {
		return true;
	}
}

function get_id($pseudo) {
	$DB = open_DB();
	$req = $DB->prepare("SELECT id FROM users WHERE pseudo = :pseudo");
	$req->execute(array("pseudo"=>$pseudo));

	$id = $req->fetch();
	return $id['id'];
}

function bind($picture_id, $user_id) {
	$DB = open_DB();
	$req = $DB->prepare("INSERT INTO identification(id_photos, id_users) VALUES (:id_photos, :id_users) ");
	$req->execute(array("id_photos"=>$picture_id, "id_users"=>$user_id));
}

function are_already_bound($picture_id, $user_id) {
	$DB = open_DB();
	$req = $DB->prepare("SELECT id_photos, id_users FROM identification WHERE id_photos = :id_photos AND id_users = :id_users");
	$req->execute(array("id_photos"=>$picture_id, "id_users"=>$user_id));

	if ($req->fetch() == false) {
		return false;
	} else {
		return true;
	}
}

function display_identification($id_photos) {
	$DB = open_DB();
	$req = $DB->prepare("SELECT pseudo FROM identification, users WHERE id_photos = :id_photos AND id_users = id");
	$req->execute(array("id_photos"=>$id_photos));

	$html = "";
	while (($line = $req->fetch())) {
		$pseudo = $line['pseudo'];
		$html .= "<p>".$pseudo."</p>";
	}

	return $html;
}
		
//user ne doit pas être dans la DB
function add_user($pseudo, $password) {
	$DB = open_DB();
	$req = $DB->prepare("INSERT INTO users(pseudo, password) VALUES (:pseudo, :password)");
	$req->execute(array("pseudo"=>$pseudo, "password"=>$password));
}

function connexion($pseudo) {
	$_SESSION['pseudo'] = $pseudo;
}

function add_files_to_DB($name, $owner) {
	$DB = open_DB();
	$req = $DB->prepare("INSERT INTO photos(name, owner) VALUES (:name, :owner)");
	$req->execute(array("name"=>$name, "owner"=>$owner));
}

function get_all_pictures() {
	$DB = open_DB();
       	$req = $DB->prepare("SELECT id FROM photos ORDER BY id DESC");
	$req->execute();

	$all_pictures = '';
	while (($line = $req->fetch())) {
		$all_pictures .= '<div class="miniature"><a href="../view/?id='.$line['id'].'"><img src="view.php?id='.$line['id'].'"/></a></div>';
		//$all_pictures .= '<div class="miniature"><img src="view.php?id='.$line['id'].'"/></div>';

	}

	return $all_pictures;
}

function get_my_identifications($id) {
	$DB = open_DB();
       	$req = $DB->prepare("SELECT id_photos FROM identification WHERE id_users = :id ORDER BY id_photos DESC");
	$req->execute(array("id"=>$id));

	$all_pictures = '';
	while (($line = $req->fetch())) {
		$all_pictures .= '<div class="miniature"><a href="../view/?id='.$line['id_photos'].'"><img src="view.php?id='.$line['id_photos'].'"/></a></div>';
	}

	return $all_pictures;
}

function get_name($id) {
	$DB = open_DB();
       	$req = $DB->prepare("SELECT name FROM photos WHERE id = :id");
	$req->execute(array('id' => $id));

	$name = $req->fetch();

	return $name['name'];
}

function image_owner($id) {
  $DB = open_DB();
  $req = $DB->prepare("SELECT owner FROM photos WHERE id = :id");
	$req->execute(array("id"=>$id));

	if (($ligne = $req->fetch())) {
    return $ligne['owner'];
  } else {
    return false;
  }
}

function is_allowed_to_delete($id, $pseudo) {
  if ($pseudo == "admin"
    || image_owner($id) == $pseudo) {
    return true;
  } else {
    return false;
  }
}

function delete_img($id) {
  $DB = open_DB();
  $name = get_name($id);
  $req = $DB->prepare("DELETE FROM photos WHERE id = :id");
	$req->execute(array("id"=>$id));
  unlink("../storage/".$name);
  unlink("../storage_mini/".$name);
}

function is_file_in_DB($name) {
	$DB = open_DB();
       	$req = $DB->prepare("SELECT name FROM photos WHERE name = :name");
	$req->execute(array('name' => $name));
	
	if ($req->fetch() == false) {
		return false;
	} else {
		return true;
	}
}

?>

