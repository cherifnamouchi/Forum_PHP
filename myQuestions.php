<?php 
    require 'actions/questions/myQuestionsAction.php'; 
    require 'actions/users/securityAction.php';
?>
<!DOCTYPE html>
<html>
    <?php include 'includes/head.php'; ?>
    <body>
        <?php include 'includes/navbar.php'; ?>
        <?php 
        
            while($question = $getAllMyQuestions->fetch()) {
        ?>
                <br><br>
                <div class="card" style="width: 70%; margin: auto">
                    <h5 class="card-header">
                        <a href="article.php?id=<?= $question['id']; ?>">
                            <?= $question['titre']; ?>
                        </a>
                    </h5>
                    <div class="card-body">
                        <p class="card-text">
                            <?= $question['description']; ?>
                        </p>
                        <a href="article.php?id=<?= $question['id']; ?>" class="btn btn-primary">Accéder à la question</a>
                        <a href="editQuestion.php?id=<?= $question['id']; ?>" class="btn btn-warning">Modifier la question</a>
                        <a href="actions/questions/deleteQuestionAction.php?id=<?= $question['id']; ?>" class="btn btn-danger">Supprimer la question</a>
                    </div>
                </div>
           <?php } ?>
    </body>
</html>