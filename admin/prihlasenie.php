<?php 
date_default_timezone_get("Europe/Bratislava");
	include'js/hlavicka.php';
	include'js/navbar.php';
    session_start();

    if(!(isset($_SESSION["user"]))){
        header('Location: index.php');
    }

    
    $servername = "localhost";
    $username = "admin";
    $password = "vertrigoadmin";
    $dbname = "adminverification";
    $count = 1;
    $allID = [];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM prispevky order by id DESC";

    $result = $conn->query($sql);
?>
<style>
    th{
        padding-left: 10px;
        background-color: rgb(217, 217, 217);
        text-align: center;
    }
    #cas{
        vertical-align: middle;
        padding-left: 0.2%;
        text-align: center;
        width: 10%;
    }
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    #btn{
        color: red;
        margin-top: 5%;
    }
    td{
        text-align: left;
    }
    #name{
        width: 20%;
        text-align: center;
    }
    #text{
        width: 60%;
        vertical-align: top;
    }
</style>

<div style="margin: 0">
    <div class="container-fluid" style="padding: 1%; float: left; width: 25%; overflow: hidden">
    <div class="card" style="width:300px">
        <img class="card-img-top" src="images/user-image.png" alt="Card image" style="width:100%; padding: 3%">
        <div class="card-body">
        <h3 class="card-title" style="text-align: center"><?php echo $_SESSION['user'];?></h3>
        <h5 class="card-title" style="text-align: center"><small><?php echo $_SESSION['role'];?></small></h5>

        <div class="container">
            <ul style="list-style-type:none; text-decoration: none">
                <li><a href="prihlasenie.php?domov=domov">Domov</a></li>
                <li><a href="prihlasenie.php?spravy=spravy">Správy</a></li>
                <li><a href="prihlasenie.php?onas=onas">O nás</a></li>
                <li><a href="prihlasenie.php?fotogaleria=fotogaleria">Fotogaléria</a></li>
                <li><a href="prihlasenie.php?blog=blog">Blog</a></li>
                <li><a href="prihlasenie.php?kontakt=kontakt">Kontakt</a></li>
            </ul>
        </div>
    </div>
        <form method="post">
            <input type="submit" value="Odhlásiť sa" name="signOut" style="margin-right:auto; margin-left:auto;
            display:block; margin-bottom:5%">
        </form>
    </div>
</div>
<?php
        if (isset($_GET["domov"])){
            echo "domov";
        }

        else if (isset($_GET["spravy"])){
            echo "spravy";
        }

        else if (isset($_GET["onas"])){
            echo "onas";
        }

        else if (isset($_GET["fotogaleria"])){
            echo "fotogaleria";
        }

        else if (isset($_GET["blog"])){

            echo '<div style="float: left; overflow: hidden; width: 70%; margin-top: 1%">
            <table style="width:100%; float: right;">
            <tr>
                <th>Meno</th>
                <th>Príspevok</th>
                <th>Čas</th>
                <th></th>
            </tr>';


            	if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td id='name'> " . $row["meno"] . "</td>";
                        echo "<td id='text'><small>" . $row["prispevok"] . "</small></td>";
                        echo "<td id='cas'> " . $row["cas"] . "</td>";
                        echo "<td><form method='post'>
                        <input id='btn' type='submit' value='Odstrániť' name='remove" . $row["id"] . "' 
                        style='margin-right:auto; margin-left:auto;
                        display:block; margin-bottom:5%'></form></td></tr>";
                        $allID[$count] = $row["id"];
                        $count++;
                    }
                  } else {
                    echo "0 results";
                  }
                  $count--;
       echo "</table></div></div>";

        for ($i = $count; $i > 0; $i--){
            if(isset($_POST["remove".$allID[$i].""])){
                
                $sql = "DELETE FROM `prispevky` WHERE id=".$allID[$i].""; 
                $conn->query($sql);
                $conn->close();
                echo "<script type='text/javascript'> document.location = 'prihlasenie.php?blog=blog'; </script>";
            }
        }
}
else if (isset($_GET["kontakt"]))
{
    echo "kontakt";
}
else{
}
if(isset($_POST["signOut"]))
{
    unset($_SESSION["user"]);
    unset($_SESSION["check"]);
    unset($_SESSION["role"]);
    echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
}
else{
}
?>