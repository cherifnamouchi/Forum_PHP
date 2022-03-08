<?php 
    require 'actions/users/securityAction.php'; 
    require 'actions/questions/publishQuestionAction.php'; 
?>
<!DOCTYPE html>
<html>
    <?php include 'includes/head.php'; ?>
    <body>
        <?php include 'includes/navbar.php'; ?>
        <br><br>
        <form class="container" method="POST">

            <?php if(isset($errorMsg)) : 
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $errorMsg . 
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
                  elseif(isset($successMsg)) :
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . $successMsg . 
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                  endif;
            ?>
        
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Titre de la question</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Description de la question</label>
                <textarea class="form-control" name="description"></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Contenu de la question</label>
                <textarea class="form-control" name="content"></textarea>
            </div>
    
            <button type="submit" class="btn btn-primary" name="validate">Publier la question</button>
            <br><br>
        </form>
    </body>
</html>