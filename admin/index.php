	
<!DOCTYPE html>

<html>
  <head>
    <title>Crud</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Holtwood+One+SC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
      h1{
        text-align: center;
      }
    </style>

    </head> 
 <body> 
     <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span>Crud php <span class="glyphicon glyphicon-cutlery"></span></h1>
    <div class="container admin">
       <div class="row"> 
         <h1><strong>listes des Produits</strong><a  href="insert.php"  class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h1>
         
    <table class="table table-striped table-bordered">
    <thead>
      	<tr>
			<th>Id </th>
			<th>Nom </th>
			<th>Designation</th>
      <th>Prix</th>
      <th>Qualité</th>
      <th>valider</th>
       

		</tr>

    </thead>
    <tbody>

      <?php
        require 'database.php';
      $db = Database::connect(); 
        // retourne la connection ds la variable db
        $statement = $db->query('SELECT  id,nom,description,Prix,qualite  from  produit ');
        
        // recuperation de lignes
        while($item = $statement->fetch())
        { ?> 
        <tr>
        <td> <?php echo $item['id']; ?> </td>
        <td> <?php echo $item['nom']; ?> </td>
        <td> <?php echo $item['description']; ?> </td>
        <td> <?php echo $item['Prix']; ?> </td>
        <td> <?php echo $item['qualite']; ?> </td>
        


        <td width=300>
                         
          <a class="btn btn-default" href="views.php?id= <?php echo $item['id']; ?>"><span class="glyphicon glyphicon-eye-open"></span> Voir</a>
              
                <a class="btn btn-primary" href="update.php?id= <?php echo $item['id']; ?>"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>
              
          <a class="btn btn-danger" href="delete.php?id=<?php echo $item['id']; ?>"><span class="glyphicon glyphicon-remove"></span> Supprimer</a> 
        </td>
      </tr>
      <?php  } ?>             
    </tbody> 
           
     </table>
    </div>

    </div>
      
      
  </body>    
</html>