<?php

require 'actions/database.php';
// Validation du formulaire
if(isset($_POST['validate'])) {
    // Verifier si l'utilisateur a bien complété les champs
    if(!empty($_POST['pseudo']) && 
       !empty($_POST['lastname']) &&
       !empty($_POST['firstname']) &&
       !empty($_POST['password'])) {

       // Les données récupérées 
       $user_pseudo = htmlspecialchars($_POST['pseudo']); 
       $user_lastname = htmlspecialchars($_POST['lastname']); 
       $user_firstname = htmlspecialchars($_POST['firstname']); 
       $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
       
       // Vérifier si user existe dans la base
       $checkIfUserAlreadyExists = $bdd->prepare('SELECT pseudo FROM users WHERE pseudo = ?');
       $checkIfUserAlreadyExists->execute(array($user_pseudo));
       if($checkIfUserAlreadyExists->rowCount() == 0) {
            $insertUserOnWebsite = $bdd->prepare('INSERT INTO users(pseudo, nom, prenom, mdp) VALUES(?, ?, ?, ?)');
            $insertUserOnWebsite->execute(array(
                $user_pseudo, $user_lastname,
                $user_firstname, $user_password
            ));
            // 
            $getInfosOfThisUserReq = $bdd->prepare('SELECT id, pseudo, nom, prenom FROM users WHERE nom = ? AND prenom = ? AND pseudo = ?');
            $getInfosOfThisUserReq->execute(array(
                $user_lastname, $user_firstname, 
                $user_pseudo
            ));
            $userInfo = $getInfosOfThisUserReq->fetch();
            // 
            $_SESSION['auth'] = true;
            $_SESSION['id'] = $userInfo['id'];
            $_SESSION['lastname'] = $userInfo['nom'];
            $_SESSION['firstname'] = $userInfo['prenom'];
            $_SESSION['pseudo'] = $userInfo['pseudo'];
            // Rediriger user vers la page d'accueil
            header('Location: index.php');
       } else {
            $errorMsg = "L'utilisateur existe déja dans le site.";
       }

    } else {
        $errorMsg = "Veuillez compléter les champs.";
    }
}