<?php
require_once '../Model/connect.php';
session_start();

$stmt = $bdd->prepare('SELECT * FROM users WHERE email=:mail');
$stmt->bindParam("mail", $_POST["u_email"]);
$stmt->execute();
$result = $stmt->fetch();

var_dump($result);

 if (!empty($_POST['u_email']) && !empty($_POST['u_password'])) {
    if ($result != false && password_verify($_POST['u_password'], $result["password"])) {
        $_SESSION['user'] = $result;
        header('Location:http://localhost/Corinne_2/user_exo/View/Profil.php');
        die();
    } else {
        header('Location:http://localhost/Corinne_2/user_exo/View/Connexion.html');
        die();
    }
 } else {
    header('Location:http://localhost/Corinne_2/user_exo/View/Connexion.html');
    die();
 }



 var_dump($_SESSION['user']);
 
var_dump ($_POST);
