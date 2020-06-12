<?php

require 'database.php';

$id = $_GET['id']; //  creation d'une variable $id 

$db = Database::connect(); 
// retourne la connection ds la variable db
$statement = $db->prepare('SELECT  id,nom,description,Prix,qualite  from  produit WHERE id = ? ');
$statement->execute(array($id));

// recuperation de lignes
$item = $statement->fetch()
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Crud</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../css/styles.css">
    </head>
    
    <body>

        <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> CRUD PHP <span class="glyphicon glyphicon-cutlery"></span></h1>
         <div class="container admin">
            <div class="row">
               <div class="col-sm-6">
                    <h1><strong>Voir un item</strong></h1>
                                      
                    <br>
                    <form>
                        <div class="form-group">
                        <label>id:</label><?php echo '  '.$item['id'];?>
                        </div>
                      
                       <div class="form-group">
                        <label>Nom:</label><?php echo '  '.$item['nom'];?>
                      </div>
                      <div class="form-group"> 
                        <label>Description:</label><?php echo '  '.$item['description'];?>
                      </div>
                      <div class="form-group">
                        <label>Prix:</label><?php echo '  '.number_format((float)$item['Prix'], 2, '.', ''). ' €';?>
                      </div>
                      <div class="form-group">
                        <label>qualité:</label><?php echo '  '.$item['qualite'];?>
                      </div>
                      
                    </form>
                    <br>
                    <div class="form-actions">
                      <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    </div>
                </div> 
                
                
            </div>
        </div>   
    </body>
</html>

