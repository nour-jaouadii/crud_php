<?php

    require 'database.php';
    $qualiteError = $idError = $nameError = $descriptionError = $priceError = "";
       $id = $name = $description = $price = $qualite = "";
      

    if(!empty($_POST)) 
   {  
    // on recrute  une input de type file avec $_file 
        $id                 = checkInput($_POST['id']);
        $name               = checkInput($_POST['name']);
        $description        = checkInput($_POST['description']);
        $price              = checkInput($_POST['price']);
        $qualite             = checkInput($_POST['qualite']);


        $isSuccess          = true;


                if(empty($id)) 
                {
                    $idError = 'Ce champ ne peut pas être vide';
                    $isSuccess = false;
                } 
                if (isset($_POST['id'])) {

                    $id2 = $_POST['id'];
                // Le produit est-il déja présent dans la base ?
                    $db = Database::connect();
 
                    $sql = " SELECT  * FROM  produit WHERE id =?";
                    $stmt = $db->prepare($sql);

                    $stmt->execute([$id2]);
                    $resultat = $stmt->fetch();

                        if ($resultat) {
                             // L'aliment existe dans la base, on ne l'enregistre donc pas : 
                            $idError = 'Le produit '. $id2 . ' fait déjà parti de la base de données !';
                            $isSuccess = false;
                        }
                }

                         

                    
                // }

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
               
               
    
    
       if($isSuccess ) 
        {
            $db = Database::connect();

            $statement = $db->prepare("INSERT INTO produit (id,nom,description,Prix,qualite) values(?, ?, ?, ?, ?)");
            $statement->execute(array($id,$name,$description,$price,$qualite));
            Database::disconnect();
            header("Location: index.php");
        }
  }// final 


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
        <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Crud <span class="glyphicon glyphicon-cutlery"></span></h1>

         <div class="container admin">
            <div class="row">
                
                
                  <h1><strong>Voir un item</strong></h1>
<!--   encrytion type = psk il a  telecharger une image  -->

                      <form class ="form" role="form" action="insert.php" method="post"  >
                        
                      <div class="form-group">
                          <label for="name">id:</label>
                          <input type="text" class="form-control" id="id" placeholder="ecrire votre id" name="id" value="<?php echo $id; ?>">
                            <span class='hel-inline'><?php echo $idError; ?></span>
                        </div>

                        <div class="form-group">
                          <label for="name">Nom:</label>
                          <input type="text" class="form-control" id="name" placeholder="ecrire votre nom" name="name" value="<?php echo $name; ?>">
                            <span class='hel-inline'><?php echo $nameError; ?></span>
                        </div>
                        <div class="form-group">
                          <label for="description">Description:</label>
                          <input type="text" class="form-control" id="description" placeholder="description" name="description" value="<?php echo $description; ?>">
                          <span class='hel-inline'><?php echo $descriptionError; ?></span>

                        </div>

                         <div class="form-group">
                          <label for="price">prix en "€":</label>
                          <input type="number" step="0.01" class="form-control" id="price" placeholder="price" name="price" value="<?php echo $price; ?>" >
                          <span class='hel-inline'><?php echo $priceError; ?></span>

                          </div>

                        <div class="form-group">
                          <label for="qualite">Qualité:</label>
                          <input type="text" class="form-control" id="qualite " placeholder="qualite " name="qualite" value="<?php echo $qualite; ?>">
                          <span class='hel-inline'><?php echo $qualiteError; ?></span>

                        </div>
                    
                          
                        
                        <br>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Ajouter</button>
                        <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                       </div>                           
                   </form>
               
             
             </div>     
			 
            
        </div>   
    </body>
</html>

