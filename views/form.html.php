<?php require_once('layouts/header.phtml'); ?>

<form action="<?php echo APP_PATH; ?>api/api.php" method="post" enctype="multipart/form-data">
<input type="file" name="file_json" id="file_json">
<input type="submit" value="Wyślij" class="btn btn-success">
</form>

<?php require_once('layouts/footer.phtml'); ?>