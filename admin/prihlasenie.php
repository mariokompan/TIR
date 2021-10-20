<?php 
date_default_timezone_get("Europe/Bratislava");
	include'js/hlavicka.php';
	include'js/navbar.php';

    session_start();
?>
<form method="post">
    <input type="submit" value="Odhlásiť sa" name="signOut">
</form>
<?php
if(!(isset($_SESSION["user"]))){
    header('Location: index.php');
}
if(isset($_POST["signOut"]))
{
    unset($_SESSION["user"]);
    unset($_SESSION["check"]);
    header('Location: index.php');
}
?>
