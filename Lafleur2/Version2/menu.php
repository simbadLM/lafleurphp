<?php
session_start();

$cnx= new PDO("mysql:host=localhost;dbname=lafleurv2;charset=utf8", "rootard", "rootard");
$request="SELECT cat_code, cat_libelle FROM lafleurv2.categorie WHERE 1";
$result=$cnx->prepare($request);
$result->execute();
$cnx=null;



echo"
<!DOCTYPE html>
<html>
    <head>
        <meta utf=\"8\">
        <title>Menu</title>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"style/style.css\" />
    </head>
    <body>
        <h1>
            Sté LaFleur
        </h1>
        <a class=\"pages\" href=\"logo.php\" target=\"frameRight\">Accueil</a><br>
        <hr>
        <p><u>Nos produits<u></p>
";
foreach ($result as $row)
    {
echo"
        <a class=\"pages\" href=\"listPdt.php?categ=".$row['cat_code']."\" target=\"frameRight\">".$row['cat_libelle']."</a><br>
";  
    }   
echo" <hr>

<form action=\"panier.php\" target=\"menu\" method=\"get\">
<input type=\"submit\" name=\"action\" value=\"Vider le panier\" />
</form>

<form action=\"commande.php\" target=\"page\" method=\"get\">
<p><input type=\"submit\" value=\"Commander\" />
</form>



    </body>
</html>";

if (!isset($_SESSION["refPdt"]))
    	{
        		$_SESSION["refPdt"]=array();
        		$_SESSION["quantite"]=array();
    	}


?>