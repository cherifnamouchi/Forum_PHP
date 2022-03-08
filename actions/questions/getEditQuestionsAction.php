<?php

require 'actions/database.php';
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $idOfQuestion = $_GET['id'];
    $checkIfQuestionExists = $bdd->prepare('SELECT * FROM questions WHERE id = ?');
    $checkIfQuestionExists->execute(array($idOfQuestion));

    if($checkIfQuestionExists->rowCount() > 0) {
        $questionInfos = $checkIfQuestionExists->fetch();
        if($questionInfos['id_auteur'] == $_SESSION['id']) {
            $questionTitle = $questionInfos['titre'];
            $questionDescription = $questionInfos['description'];
            $questionContent = $questionInfos['contenu'];
            $questionDate = $questionInfos['date_publication'];

            $questionDescription = str_replace('<br />', '', $questionDescription);
            $questionContent = str_replace('<br />', '', $questionContent);

        } else {
            $errorMsg = "Vous n'êtes pas l'auteur de la question.";
        }
    } else {
        $errorMsg = "Aucune question n'a été trouvée.";
    }
} else {
    $errorMsg = "Aucune question n'a été trouvée.";
}