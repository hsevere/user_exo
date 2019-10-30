<?php
session_start();
require_once '../Modele/connect.php';
$stmt = $bdd->prepare("SELECT * FROM user WHERE email=:mail");
$stmt->bindparam("mail", $_POST['u_email']);
$stmt->execute();
$result = $stmt->fetch();
var_dump($result);
if ($result['email'] == $_POST['u_email']) {
    $_SESSION['user'] = $result;
 }
 if (!empty($_POST['u_email']) && !empty($_POST['u_password'])) {
    if ($result != false && password_verify($_POST['u_password'], $result["password"])) {
        $_SESSION['user'] = $result;
        header('Location:http://localhost/user_exo/Vue/profil.php');
        die();
    } else {
        header('Location:http://localhost/user_exo/Vue/connexion.html');
        die();
    }
 } else {
    header('Location:http://localhost/user_exo/Vue/connexion.html');
    die();
 }