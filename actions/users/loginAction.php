<?php

require 'actions/database.php';

// Validation du formulaire
if(isset($_POST['validate'])) {
    // Verifier si l'utilisateur a bien complété les champs
    if(!empty($_POST['pseudo']) && 
       !empty($_POST['password'])) {

       // Les données récupérées 
       $user_pseudo = htmlspecialchars($_POST['pseudo']); 
       $user_password = htmlspecialchars($_POST['password']);
       
       $checkIfUserExists = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
       $checkIfUserExists->execute(array($user_pseudo));
       if($checkIfUserExists->rowCount() > 0) {
            $usersInfos = $checkIfUserExists->fetch();
            if(password_verify($user_password, $usersInfos['mdp'])) {
                $_SESSION['auth'] = true;
                $_SESSION['id'] = $usersInfos['id'];
                $_SESSION['lastname'] = $usersInfos['nom'];
                $_SESSION['firstname'] = $usersInfos['prenom'];
                $_SESSION['pseudo'] = $usersInfos['pseudo'];
                // Rediriger user vers la page d'accueil
                header('Location: index.php');
            } else {
                $errorMsg = "Votre mot de passe est incorrecte."; 
            }
       } else {
            $errorMsg = "Votre pseudo est incorrecte.";
       }
    } else {
        $errorMsg = "Veuillez compléter les champs.";
    }
}