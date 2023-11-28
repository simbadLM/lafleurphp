<?php
session_start();

$count = count($_SESSION['refPdt']);



for ($i = 0; $i <= $count; $i++)
{
    if ($_GET['refPdt'] == $_SESSION['refPdt'][$i])
    {
        $_SESSION['quantite'][$i] = $_SESSION['quantite'][$i] + $_GET['quantite'];
        $_GET['quantite'] = 0;
        $_GET['refPdt'] = 0;

    }
}

$_SESSION['refPdt'][$count] = $_GET['refPdt'];
$_SESSION['quantite'][$count] = $_GET['quantite'];
header("Location: accueil.php?categ=".$_GET['categ']);

if (isset($_GET['action']) && $_GET['action'] == "Vider le panier") 
{   
    $_SESSION['refPdt'] = array();
    $_SESSION['quantite'] = array();
}

?>