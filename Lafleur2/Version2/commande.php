<?php
session_start();
try 
{
 
    
    echo "  <p align =\"center\" ><b>Récapitulatif des articles commandés</b></p>
    <table align=\"center\" border=\"1px\"> 

    <tr>        
                <td><b>Réf</b></td>
                <td><b>Désignation</b></td>
                <td><b>Px Unit.</b></td>
                <td><b>Qté</b></td>   
                <td><b>Montant</b></td>
            </tr>";  
            $total=0;      
            $count = count($_SESSION['refPdt']);    

    for ($i = 1; $i <= $count; $i++)
    {
        if ($_SESSION['refPdt'][$i-1] != 0) {
        $cnx= new PDO("mysql:host=localhost;dbname=lafleurv2;charset=utf8", "rootard", "rootard");
        $request="SELECT  pdt_designation, pdt_prix FROM lafleurv2.produit WHERE pdt_ref = '".$_SESSION['refPdt'][$i-1]."';";
        $result=$cnx->prepare($request);
        $result->execute();
        $elem = $result->fetch(PDO::FETCH_ASSOC);
        $prix = $elem['pdt_prix'];
  
        $total = $total + $prix * $_SESSION['quantite'][$i-1];

        echo "     

            <tr>
                <td>".$_SESSION['refPdt'][$i-1]."</td>
                <td>".$elem['pdt_designation']."</td>
                <td>".$elem['pdt_prix']."</td>
                <td>".$_SESSION['quantite'][$i-1]."</td>   
                <td>"; echo $prix * $_SESSION['quantite'][$i-1];echo"  € </td>
            </tr>"; 
        }           
    }
    echo '<tr><td colspan="4">Total</td><td>'.$total.' €</td> 
    </table><br><br><br>

    <table  align="center">
        <form method="POST" action ="envoyer.php">
            <td>Code client : <input type="text" name="cClient"></td>
            <td>Mot de passe : <input type="password" name="pw"><td>
            <tr><td><br><input type="submit" value="Envoyer la commande">
        </form>
    </table>';
    

    
$cnx=null;
}
catch (Exception $e) {
        echo "Une exception a été attrapée : " . $e->getMessage();
    }
?>