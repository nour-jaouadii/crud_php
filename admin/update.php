<?php

require 'database.php';

if(!empty($_GET['id'])) 
{
    $id = checkInput($_GET['id']);
    
    $db = Database::connect(); 
    // retourne la connection ds la variable db
    $statement = $db->prepare('SELECT  id,nom,description,Prix,qualite  from  produit WHERE id = ? ');
    $statement->execute(array($id));

    // recuperation de lignes
    $item = $statement->fetch();
    Database::disconnect();

   
}
    $qualiteError  = $nameError = $descriptionError = $priceError = "";
     $name = $description = $price = $qualite = "";


    if(!empty($_POST)) 
     { 

        $name               = checkInput($_POST['name']);
        $description        = checkInput($_POST['description']);
        $price              = checkInput($_POST['price']);
        $qualite             = checkInput($_POST['qualite']);
        $isSuccess          = true;


             if(empty($name)) 
                {
                    $nameError = 'Ce champ ne peut pas être vide';
                    $isSuccess = false;
                }
                if(empty($description)) 
                {
                    $descriptionError = 'Ce champ ne peut pas être vide';
                    $isSuccess = false;
                } 
                if(empty($price)) 
                {
                    $priceError = 'Ce champ ne peut pas être vide';
                    $isSuccess = false;
                } 
                if(empty($qualite)) 
                {
                    $qualiteError = 'Ce champ ne peut pas être vide';
                    $isSuccess = false;
                } 
               
                if($isSuccess){
                    $db = Database::connect(); 
                    $statement = $db->prepare("UPDATE produit  set  nom = ?, description = ?, Prix = ?, qualite = ? WHERE id = ?");
					$statement->execute(array($name,$description,$price,$qualite,$id));
			
				Database::disconnect();
				header("Location: index.php");


                }

            }// end $_post

function checkInput($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
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
                    <h1><strong>Modifier un item</strong></h1>
                                      
                    <br>
                    <form class="form" action="<?php echo 'update.php?id='.$id;?>" role="form" method="post" >

                       
                      
                       <div class="form-group">
                        <label>Nom:</label>
                        <input type="text" class="form-control" name="name" id="" value="<?php echo '  '.$item['nom'];?>">
                      </div>
                      <div class="form-group"> 
                        <label>Description:</label>
                        <input type="text" class="form-control" name="description" id="" value="<?php echo '  '.$item['description'];?>">

                      </div>
                      <div class="form-group">
                        <label>Prix:</label>
                        <input type="text" class="form-control" name="price" id="" value="<?php echo '  '.number_format((float)$item['Prix'], 2, '.', ''). ' €';?>">

                      </div>
                      <div class="form-group">
                        <label>qualité:</label>
                        <input type="text" class="form-control" name="qualite" id="" value="<?php echo '  '.$item['qualite'];?>">
                      </div>
                      <br>
                      <div class="form-actions">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                            <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                       </div>
                    </form>
                   
                </div> 
                
                
            </div>
        </div>   
    </body>
</html>

