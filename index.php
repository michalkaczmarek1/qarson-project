<?php require_once('views/layouts/header.html.php'); ?>

<h1>Witaj w mojej aplikacji</h1>



<?php 

if(isset($_SESSION['error_app'])){
    echo "<div class='alert alert-danger'>".$_SESSION['error_app']."</div>";
    unset($_SESSION['error_app']);
}


require_once('views/layouts/footer.html.php'); 


?>