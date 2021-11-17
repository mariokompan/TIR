<?php 
date_default_timezone_get("Europe/Bratislava");
	include'js/hlavicka.php';
	include'js/navbar.php';

    session_start();
?>
<!--Left-orientated container-->
    <div class="container-fluid" style="padding: 1%">
    <div class="card" style="width:300px">
        <img class="card-img-top" src="images/user-image.png" alt="Card image" style="width:100%; padding: 3%">
        <div class="card-body">
        <h3 class="card-title" style="text-align: center"><?php echo $_SESSION['user'];?></h3>
        <h5 class="card-title" style="text-align: center"><?php echo $_SESSION['role'];?></h5>

        <div class="container">
            <ul style="list-style-type:none; text-decoration: none">
                <li><a href="#">Domov</a></li>
                <li><a href="#">Správy</a></li>
                <li><a href="#">O nás</a></li>
                <li><a href="#">Fotogaléria</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Kontakt</a></li>
            </ul>
        </div>
    </div>
        <form method="post">
            <input type="submit" value="Odhlásiť sa" name="signOut" style="margin-right:auto; margin-left:auto;
            display:block; margin-bottom:5%">
        </form>
    </div>

<?php
if(!(isset($_SESSION["user"]))){
    header('Location: index.php');
}
if(isset($_POST["signOut"]))
{
    unset($_SESSION["user"]);
    unset($_SESSION["check"]);
    unset($_SESSION["role"]);
    header('Location: index.php');
}
?> 