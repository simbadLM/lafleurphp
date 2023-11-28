<?php
session_start();
if (isset($_POST['cClient']) && isset($_POST['pw'])) 
    {
        try 
            {
                $cnx= new PDO("mysql:host=localhost;dbname=lafleurv2;charset=utf8", "rootard", "rootard");
                $request="SELECT  clt_code, clt_motPasse FROM lafleurv2.clientconnu WHERE clt_code = '".$_POST['cClient']."' AND clt_MotPasse = '".$_POST['pw']."';";
                $result=$cnx->prepare($request);
                $result->execute();
                $elem = $result->fetch(PDO::FETCH_ASSOC);
                $timestamp = time();
                //echo $request;


                if ($_POST['cClient'] == $elem['clt_code'] && $_POST['pw'] == $elem['clt_motPasse']) 
                    {
                        $count = count($_SESSION['refPdt']);
                        for ($i = 1; $i <= $count; $i++) 
                            {
                                $cnx= new PDO("mysql:host=localhost;dbname=lafleurv2;charset=utf8", "rootard", "rootard");
                                $request="INSERT INTO lafleurv2.contenir (cde_moment, cde_client, produit, quantite)
                                VALUES ('".$timestamp."', '".$_POST['cClient']."', '".$_SESSION['refPdt'][$i-1]."', '".$_SESSION['quantite'][$i-1]."' );";
                                $result=$cnx->prepare($request);
                                $result->execute();  
                                $flag=true;   
                                
                            }
                        if (isset($flag) && $flag == true) 
                            {
                                $request="SELECT  cde_moment, cde_client 
                                FROM lafleurv2.contenir 
                                WHERE cde_moment = '".$timestamp."';";
                                $result=$cnx->prepare($request);
                                $result->execute();
                                $elem = $result->fetch(PDO::FETCH_ASSOC);
                                echo "Commande enregistrée au n° ".$elem['cde_client']."/".$elem['cde_moment']."";
                                $_SESSION['refPdt'] = array();
                                $_SESSION['quantite'] = array();
                            }    
                             
                    }
                    else echo "Accès refusé";
                $cnx = null;
            }

        catch (PDOException $e) 
            {
            echo "Une exception a été attrapée : " . $e->getMessage();
            }
    }

    
    
    
?>