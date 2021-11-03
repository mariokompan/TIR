<?php 
date_default_timezone_get("Europe/Bratislava");
	include'js/hlavicka.php';
	include'js/navbar.php';

    session_start();
    if(!(isset($_SESSION['check']))){
        unset($_SESSION["user"]);
        unset($_SESSION["role"]);
    }
    if(isset($_SESSION['user'])){
        header('Location: prihlasenie.php');
    }
    else{
    }
    unset($_SESSION["check"]);
?>          

<?php 
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$uzivatelS = $_POST['email-address'];

            $servername = "localhost";
            $username = "admin";
            $password = "vertrigoadmin";
            $dbname = "adminverification";
            $loginState = false;
            
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT id, login, heslo, meno, rola FROM uzivatelia";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                        if ($_POST["email-address"] == $row["login"]){
                            $loginState = true;
                            if (md5($_POST["password"]) == $row["heslo"]){
                                $_SESSION['user'] = $row["meno"];
                                $_SESSION['role'] = $row["rola"];
                                header('Location: prihlasenie.php');
                                ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Identita "<?php echo $uzivatelS; ?>" potvrdená</strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php
                            break;
                            }
                            else
                            {
                                ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Zlé heslo uživateľa "<?php echo $uzivatelS; ?>"</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php
                            break;
                            }
                        }
                }
                if ($loginState != true){
                    ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Uživateľ "<?php echo $uzivatelS; ?>" neexistuje.</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php
                }

            } 
            else {
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Žiadny riadok v databáze!</strong> <?php echo $chyba; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
            }
            $conn->close();
    }
 ?>


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center" ><h4>Prihlásenie</h4></div>
                    <div class="card-body">
                        <form action="index.php" method="POST">
                            <div class="form-group row was-validated">
                                <small id="emailHelp" class="form-text text-dark mb-2" ><b>Meno</b></small>
                                <div class="col-lg-12 input-container">
                                   
                                    <input type="text" id="email_address" class="form-control" name="email-address" required pattern="\S.{2,9}.[^()/><\][,;*_|]+"> 
                                    
                                    <div class="invalid-feedback">
                                      Prosím zadaj meno!
                                    </div>
                                </div>
                               
                            </div>

                            <div class="form-group row was-validated">
                                 <small id="emailHelp" class="form-text text-dark mb-2"><b>Heslo</b></small>
                                <div class="col-lg-12">
                                    <input type="password" id="password" class="form-control" name="password" required pattern="(?=.*\d).{6,}" >
                                    <div class="invalid-feedback">
                                      Prosím zadaj heslo! (Musí obsahovať najmenej 6 znakov.)
                                    </div>
                                </div>
                                
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 ">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Zapamätať heslo
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center"> 
                                <button type="submit" class="btn btn-light mb-4">
                                    Prihlásiť sa
                                </button>
                            </div>
                            <?php
                            if (isset($_POST["remember"])){
                                $_SESSION['check'] = 'true';
                            }
                            ?>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
