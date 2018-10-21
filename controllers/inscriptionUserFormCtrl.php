<?php

$lastname = '';
$mail = '';
$formError = array();

if (!empty($_POST['lastname'])) {
    $lastname = htmlspecialchars($_POST['lastname']);
} else {
    $formError['lastname'] = '';
}

if (!empty($_POST['mail']) && filter_var($_POST['mail']) && FILTER_VALIDATE_EMAIL) {
    $mail = htmlspecialchars($_POST['lastname']);
}

if (!empty($_POST['password'])) {
    $password = $_POST['password'];
}
//si pas d'erreur on instancie l'objet
if (count($formError) == 0) {
    $user = new users();
    $user->lastname = $lastname;
}