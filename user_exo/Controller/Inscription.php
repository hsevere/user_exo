<?php
require_once '../Model/connect.php';
//$stmt = $bdd->prepare('SELECT * FROM users');
//$stmt->execute();
//$result = $stmt->fetch();

//var_dump($result);

// Ne récupère qu'un seul utilisateur

//While ($result = $stmt->fetch()) {

// var_dump ($result);
//}

// Recupère tous les utilisateurs

$stmt = $bdd->prepare('SELECT email FROM users WHERE email=:mail');
$stmt->bindParam("mail", $_POST["u_email"]);
$stmt->execute();
$result = $stmt->fetch();

if (!empty($_POST['u_email']) && !empty($_POST['u_password']) && !empty($_POST['u_daten']) && !empty($_POST['u_nom']) && !empty($_POST['u_prenom'])) {
    if ($_POST['u_password'] == $_POST['u_confirm_password']) {
        if ($result == false) {
            $hashed_Password=password_hash($_POST['u_password'],PASSWORD_DEFAULT);
            $stmt = $bdd->prepare("INSERT INTO users (email, password, daten, nom, prenom) VALUES (?,?,?,?,?)");
            $stmt->execute(array($_POST['u_email'],$hashed_Password, $_POST['u_daten'], $_POST['u_nom'], $_POST['u_prenom']));
            header('Location:http://localhost/Corinne_2/user_exo/View/Connexion.html');
            die();
        } else {
            header('Location:http://localhost/Corinne_2/user_exo/View/Inscription.html');
            die();
        }
    } else {
        header('Location:http://localhost/Corinne_2/user_exo/View/Inscription.html');
        die();
    }
} else {
    header('Location:http://localhost/Corinne_2/user_exo/View/Inscription.html');
    die();
}

