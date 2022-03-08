<?php

require '../database.php';
if(!isset($_SESSION['auth'])) {
    header('Location: ../../login.php');
}

if(isset($_GET['id']) AND !empty($_GET['id'])) {
    $idOfTheQuestion = $_GET['id'];
    $checkIfQuestionsExists = $bdd->prepare('SELECT id, id_auteur FROM questions WHERE id = ?');
    $checkIfQuestionsExists->execute(array($idOfTheQuestion));

    if($checkIfQuestionsExists->rowCount() > 0) {
        $usersInfos = $checkIfQuestionsExists->fetch();
        if($usersInfos['id_auteur'] == $_SESSION['id']) {
            $deleteThisQuestion = $bdd->prepare('DELETE FROM questions WHERE id = ?');
            $deleteThisQuestion->execute(array($idOfTheQuestion));
            header('Location: ../../myQuestions.php');
        } else {
            echo "Vous n'avez pas le droit de supprimer la question.";
        }
    } else {
        echo "Aucune question n'a été trouvée.";
    }
} else {
    echo "Aucune question n'a été trouvée.";
}