<?php
require_once '../Modele/connect.php';
// $stmt = $bdd->prepare('SELECT * FROM user    ');
// $stmt->execute();
// $result = $stmt->fetch();
// // var_dump($result);
// while( $result=$stmt->fetch()){
//     var_dump($result);
// }
// $_->fetch();

// var_dump($_POST);

$stmt = $bdd->prepare("SELECT email FROM user WHERE email=:mail");
$stmt->bindparam("mail", $_POST['u_email']);
$stmt->execute();
$result = $stmt->fetch();
var_dump($result);

if (!empty($_POST['u_email']) && !empty($_POST['u_password']) && !empty($_POST['u_confirm_password']) && !empty($_POST['u_nom']) && !empty($_POST['u_prenom'])) {
    if ($_POST['u_password'] == $_POST['u_confirm_password']) {
        if ($result == false) {
            $hashed_password = password_hash($_POST['u_password'], PASSWORD_DEFAULT);
        
            $stmt = $bdd->prepare("INSERT INTO user (email, password, daten, nom, prenom) VALUES (?,?,?,?,?)");
            $stmt->execute(array($_POST['u_email'], $hashed_password, $_POST['u_daten'], $_POST['u_nom'], $_POST['u_prenom']));
            header('Location:http://localhost/user_exo/Vue/connexion.html');
            die();
            $stmt->execute(array($_POST['u_email'], $_POST['u_password'], $_POST['u_daten'], $_POST['u_nom'], $_POST['u_prenom']));
        } else {
            header('Location:http://localhost/user_exo/Vue/inscription.html');
            die();
        }
    } else {
        header('Location:http://localhost/user_exo/Vue/inscription.html');
        die();
    }
 } else {
    header('Location:http://localhost/user_exo/Vue/inscription.html');
    die();
 }
 
 https://www.php.net/manual/fr/function.password-hash.php