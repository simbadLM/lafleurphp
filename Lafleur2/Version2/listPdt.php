<?php
session_start();
try 
{
    $cnx= new PDO("mysql:host=localhost;dbname=lafleurv2;charset=utf8", "rootard", "rootard");
    $request="SELECT pdt_image, pdt_ref, pdt_designation, pdt_prix FROM lafleurv2.produit WHERE pdt_categorie = '".$_GET['categ']."';";
    $result=$cnx->prepare($request);
    $result->execute();
    

    echo "  <table border=\"1px\">";
               
    foreach ($result as $row) 
    {
        echo "      
            <tr>
                <td> <img src=\"../Images/".$row['pdt_image'].".jpg\"</td>
                <td>".$row['pdt_ref']."</td>
                <td>".$row['pdt_designation']."</td>
                <td>".$row['pdt_prix']." € </td>
            </tr>";
    }
    echo '<form action="panier.php" target="menu" method="get">';
    $result->execute();
    
        	echo '<select name="refPdt" size="1">';
            foreach ($result as $row) 
            {
                
                echo"<option value='".$row['pdt_ref']."'>".$row['pdt_designation']."</option>";       
            }
        	echo '</select>';
        	echo '&nbsp&nbsp&nbsp';
        	echo 'Quantité : ';
        	echo '<input type="number" name="quantite" step="1" size="5" value="1" />';
            echo"<input type=\"hidden\" name=\"categ\" value=\"".$_GET['categ']."\">";
        	echo '<p><input type="submit" name="action" value="Ajouter au panier" />';
        	echo '</form>';
$cnx=null;
}
catch (Exception $e) {
        echo "Une exception a été attrapée : " . $e->getMessage();
    }
?>