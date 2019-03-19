<?php require_once('layouts/header.html.php'); 

// display the statements
if(isset($_SESSION['error_empty'])){
    echo "<div class='alert alert-danger'>".$_SESSION['error_empty']."</div>";
    unset($_SESSION['error_empty']);
} else {
    if(isset($_SESSION['error_upload'])){
        echo "<div class='alert alert-danger'>".$_SESSION['error_upload']."</div>";
        unset($_SESSION['error_upload']);
    } else {
        if(isset($_SESSION['error_upload_exist'])){
            echo "<div class='alert alert-danger'>".$_SESSION['error_upload_exist']."</div>";
            unset($_SESSION['error_upload_exist']);
        }
        
    }
}

if(isset($_SESSION['success_upload'])){
    echo "<div class='alert alert-success'>".$_SESSION['success_upload']."</div>";
    unset($_SESSION['success_upload']);
}





?>



<form action="<?php echo APP_PATH; ?>api/api.php" method="post" enctype="multipart/form-data">
<input type="file" name="file_json" id="file_json">
<input type="submit" value="Wyślij" class="btn btn-success">
</form>

<?php require_once('layouts/footer.html.php'); ?>