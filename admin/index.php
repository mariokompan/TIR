<?php 
date_default_timezone_get("Europe/Bratislava");
	include'js/hlavicka.php';
	include'js/navbar.php';

    session_start();
    if(!(isset($_SESSION['check']))){
        unset($_SESSION["user"]);
    }
    if(isset($_SESSION['user'])){
        header('Location: prihlasenie.php');
    }
    else{
    }
?>

<?php 
$chyba ="";

if($_SERVER['REQUEST_METHOD'] === 'POST'){

     $uzivatelia = file('uzivatelia.csv', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
     $prihlasenie = [];
        foreach ($uzivatelia as $uzivatel) {
            list($k,$h) = explode('::', $uzivatel);
            $prihlasenie[$k] = $h;
                   }
	$uzivatelS = $_POST['email-address'];
        if($_POST['password'] === $prihlasenie[$_POST['email-address']])
        {
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
 <strong>Identita "<?php echo $uzivatelS; ?>" potvrdená</strong> <?php echo $chyba; 

 $_SESSION['user'] = 'admin';
 header('Location: prihlasenie.php');?>

  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php
        } 
        else if (!$prihlasenie[$_POST['email-address']])
        {
            ?>

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
			 <strong>Užívateľ "<?php echo $uzivatelS; ?>" neexistuje</strong> <?php echo $chyba; ?>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>

            <?php
        }
        else {
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
 <strong>Chyba autorizácie uživateľa "<?php echo $uzivatelS; ?>"</strong> <?php echo $chyba; ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php
        }
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
