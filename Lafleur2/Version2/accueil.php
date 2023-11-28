<?php
session_start();
if (isset($_GET['categ']) && !empty($_GET['categ'])) {
    echo"
<!DOCTYPE html>
<html>
    <head>
        <title>Accueil - Site de Lafleur</title>
        <meta lang=\"fr\" charset=\"utf-8\">        
    </head>
    <frameset cols=\"25%, 75%\">
        <!--Summary's frame-->
        <frame src=\"menu.php\" name=\"frameLeftSummary\"></frame>

        <!--Index's frame-->
        <frame src=\"listPdt.php?categ=".$_GET['categ']."\" name=\"frameRight\"></frame>
        
    </frameset>
</html>
";
}
else {
echo"
<!DOCTYPE html>
<html>
    <head>
        <title>Accueil - Site de Lafleur</title>
        <meta lang=\"fr\" charset=\"utf-8\">        
    </head>
    <frameset cols=\"25%, 75%\">
        <!--Summary's frame-->
        <frame src=\"menu.php\" name=\"frameLeftSummary\"></frame>

        <!--Index's frame-->
        <frame src=\"logo.php\" name=\"frameRight\"></frame>
    </frameset>
</html>
";
}
?>