
<section class="container-fluid bg-dark">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark container sticky-top">
  <a class="navbar-brand" href="index.php">SSTV</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
      <?php 
        $aktivnaStranka=basename(dirname($_SERVER['SCRIPT_NAME']));
        
        $menu = [];

        $riadky = file('../../assets/menu.txt',FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($riadky as $riadok) {
          list($k,$h) = explode('::', $riadok);
          $menu[$k] = $h;
        }

          foreach ($menu as $odkaz => $hodnota) {
            ?> 
            <li class= "nav-item">
            <a class="nav-link <?php echo ($aktivnaStranka==$odkaz?"active":'')?>" href= " ../<?php echo $odkaz ?>/"> <?php echo $hodnota ?><a/>
            </li>;
          <?php
          }
        ?>


    </ul>
    </div>
  </nav>    
  </section>

 
